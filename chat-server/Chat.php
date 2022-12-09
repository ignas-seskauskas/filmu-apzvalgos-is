<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require "./settings.php";
require "./includes/database.php";
require "./includes/user.php";
require "./includes/komunikacija/channel.php";

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Client {
    public ConnectionInterface $conn;
    public int $userId;
    public int $channelId;
}

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $querystring = $conn->httpRequest->getUri()->getQuery();
        parse_str($querystring, $queryArray);

        if(!isset($queryArray['channel']) || !isset($queryArray['user'])) {
            echo "Rejected: Connection was not established because of wrong parameters\n";
            $conn->close();
            return;
        }

        $channelId = intval($queryArray['channel']);
        $userId = intval($queryArray['user']);
        $channel = $GLOBALS['_channelController']->getChannelById($channelId);

        if(!isset($channel)) {
            echo "Rejected: Tried to establish connection to non existent channel\n";
            $conn->close();
            return;
        }

        $user = $GLOBALS['_userController']->getUserById($userId);
        

        if(!isset($user)) {
            echo "Rejected: Tried to establish connection with non existent user\n";
            $conn->close();
            return;
        }

        $userJson = json_encode($user);

        //TODO: Check if user id is authenticated

        $channel = $GLOBALS['_channelController']->getChannelById($channelId);
        if($this->getChannelUserCount($channel->id) >= $channel->max_users) {
            echo "Rejected: User {$userId} tried to connect to the channel {$channelId} which was full\n";
            $conn->close();
            return;
        }
        
        $client = new Client();
        $client->conn = $conn;
        $client->userId = $userId;
        $client->channelId = $channelId;
        $this->clients->attach($client);
        
        echo "New connection! ({$conn->resourceId}, userId: {$userId}, channelId: {$channelId})\n";

        foreach ($this->clients as $currentClient) {
            if ($conn !== $currentClient->conn && $currentClient->channelId == $channelId) {
                $currentClient->conn->send("~~~connect~~~{$userJson}");
            }
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $client = null;
        foreach ($this->clients as $currentClient) {
            if ($from == $currentClient->conn) {
                $client = $currentClient;
            }
        }

        if(!preg_match('/^~~~(.*)~~~(.*)$/', $msg, $matches)) {
            echo "User {$client->userId} used wrong message format\n";
        }
        $command = $matches[1];
        $args = $matches[2];
        echo "User {$client->userId} send a command {$command} with args {$args}\n";

        if($command == "get_users") {
            $channelId = $client->channelId;
            $userIds = [];
            foreach ($this->clients as $currentClient) {
                if($currentClient->channelId == $channelId) {
                    $userIds[] = $currentClient->userId;
                }
            }

            $users = $GLOBALS['_userController']->getUsersByIds($userIds);
            $usersJson = json_encode($users);
            $client->conn->send("~~~get_users~~~{$usersJson}");
            echo "User {$client->userId} asked for online users for channel {$client->channelId}\n";
        } else if($command == "message") {
            $message = $args;
            //TODO: get current timezone
            $currentTime = time() + 3600 * 2;
            $channel = $GLOBALS['_channelController']->getChannelById($client->channelId);

            $channelMessage = new ChannelMessage();
            $channelMessage->sender = $client->userId;
            $channelMessage->text = $message;
            $channelMessage->send_time = $currentTime;
            $channelMessage->channel = $client->channelId;
            echo($channel->addMessage($channelMessage));

            foreach ($this->clients as $currentClient) {
                if ($currentClient->channelId == $client->channelId) {
                    $currentClient->conn->send("~~~message~~~{$client->userId}~&~{$currentTime}~&~{$message}");
                }
            }

            echo "User {$client->userId} sent a message to channel {$client->channelId}: {$message}\n";
        } else if($command == "users_count") {
            $usersCount = $this->getChannelUserCount($client->channelId);
            $from->send("~~~users_count~~~$usersCount");
        }
    }

    public function onClose(ConnectionInterface $conn) {
        foreach ($this->clients as $client) {
            if ($conn == $client->conn) {
                $this->clients->detach($client);
                echo "Connection {$conn->resourceId} has disconnected\n";

                if($this->getCountOfSameUserInChannel($client->channelId, $client->userId) < 1) {
                    foreach ($this->clients as $currentClient) {
                        if ($currentClient->channelId == $client->channelId) {
                            $currentClient->conn->send("~~~disconnect~~~{$client->userId}");
                        }
                    }
                }

                $usersCount = $this->getChannelUserCount($client->channelId);
                foreach ($this->clients as $currentClient) {
                    if ($currentClient->channelId == $client->channelId) {
                        $currentClient->conn->send("~~~users_count~~~{$usersCount}");
                    }
                }

                return;
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }

    private function getChannelUserCount(int $channelId) {
        $count = 0;
        foreach ($this->clients as $client) {
            if($client->channelId == $channelId) {
                $count++;
            }
        }

        return $count;
    }

    private function getCountOfSameUserInChannel(int $channelId, int $userId) {
        $count = 0;
        foreach ($this->clients as $client) {
            if($client->channelId == $channelId && $client->userId == $userId) {
                $count++;
            }
        }

        return $count;
    }
}