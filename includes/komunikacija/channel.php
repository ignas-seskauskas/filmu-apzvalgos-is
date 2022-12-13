<?php
enum ChannelUserStatus: string {
  case Online = 'Online';
  case Writing = 'Writing';
  case Blocked = 'Blocked';
}

class ChannelMessage {
  public $id;
  public $sender;
  public $text;
  public $send_time;
  public $channel;

  public function getTimeString() {
    $h = sprintf('%02d', $this->send_time / 3600 % 24);
    $m = sprintf('%02d', $this->send_time / 60 % 60); 
    return "{$h}:{$m}";
  }
}

class Channel {
  public $name;
  public $description;
  public $max_users;
  public $create_time;
  public $last_active_time;
  public $current_users;
  public $creator;
  public $id;
  public $online_users;

  public function getCurrentUsers() {
    return 0;
  }

  public function getUsers() {
    $escapedId = databaseEscapeString($this->id);
    $users = databaseFillObjects("SELECT * FROM `user`", function () {return new User();});
    foreach($users as &$user) {
      $user->status = ChannelUserStatus::Online;
    }
    return $users;
  }

  public function getMessages() {
    $escapedId = databaseEscapeString($this->id);
    return databaseFillObjects("SELECT * FROM `channel_message` WHERE `channel` = {$escapedId}", function () {return new ChannelMessage();});
  }

  public function addMessage(ChannelMessage $channelMessage) {
    $channelMessage = databaseEscapeObject($channelMessage);
    databaseQuery("INSERT INTO `channel_message` (`sender`, `text`, `send_time`, `channel`) 
                   VALUES ({$channelMessage->sender}, '{$channelMessage->text}', {$channelMessage->send_time}, {$channelMessage->channel})");
    return databaseInsertId();
  }
}

class ChannelController {
  function resetOnlineUsers() {
    return databaseQuery("UPDATE `channel` SET `online_users` = 0");
  }

  function setChannelOnlineUsers($id, $online_users) {
    $escapedOnlineUsers = databaseEscapeString($online_users);
    $escapedId = databaseEscapeString($id);
    return databaseQuery("UPDATE `channel` SET `online_users` = {$escapedOnlineUsers} WHERE `id` = {$escapedId}");
  }

  function getChannels($page = 0) {
    return databaseFillObjects("SELECT * FROM `channel`", function () {return new Channel();});
  }

  function getChannelById($id) {
    $escapedId = databaseEscapeString($id);
    return databaseFillObject("SELECT * FROM `channel` WHERE `id` = {$escapedId}", function () {return new Channel();});
  }

  function writeMessage($data) {
    $channelId = $data->channelId;
    $message = $data->message;
  }

  function addChannel($channel) {
    $currentUser = $GLOBALS['_userController']->getCurrentUser();
    $channel = databaseEscapeObject($channel);
    databaseQuery("INSERT INTO `channel` (`name`, `description`, `max_users`, `create_time`, `last_active_time`, `creator`) 
                   VALUES ('{$channel->name}', '{$channel->description}', {$channel->max_users}, NOW(), NOW(), {$currentUser->id})");
    return databaseInsertId();
  }

  function removeChannel($data) {
    $escapedId = databaseEscapeString($data->id);
    databaseQuery("DELETE FROM `channel_message` WHERE `channel` = $escapedId");
    databaseQuery("UPDATE `user` SET `channel` = NULL WHERE `channel` = $escapedId");
    return databaseQuery("DELETE FROM `channel` WHERE `id` = $escapedId");
  }

  function editChannel($channel) {
    $channel = databaseEscapeObject($channel);
    return databaseQuery("UPDATE `channel` SET 
      `name` = '{$channel->name}',
      `description` = '{$channel->description}',
      `max_users` = {$channel->max_users} 
      WHERE `id` = {$channel->id}");
  }

  function filterByName($name) {
    $escapedName = databaseEscapeString($name);
    return databaseFillObjects("SELECT * FROM `channel` WHERE `name` LIKE '%$escapedName%'", function () {return new Channel();});
  }
}

$_channelController = new ChannelController();