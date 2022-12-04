<?php
enum ChannelUserStatus: string {
  case Online = 'Online';
  case Writing = 'Writing';
  case Blocked = 'Blocked';
}

class ChannelUser {
  public $id;
  public $name;
  public $status;
  public $avatar_src;

  public static function init($id, $name, $status, $avatar_src) {
    $instance = new self();
    $instance->id = $id;
    $instance->name = $name;
    $instance->status = $status;
    $instance->avatar_src = $avatar_src;
    return $instance;
  }
}

class ChannelMessage {
  public $user;
  public $message;
  public $time;

  public static function init($user, $message, $time) {
    $instance = new self();
    $instance->user = $user;
    $instance->message = $message;
    $instance->time = $time;
    return $instance;
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

  private static $last_id = 0;

  public static function withoutTimesAndDescription($name, $max_users, $current_users, $creator) {
    $instance = new self();
    $instance->name = $name;
    $instance->max_users = $max_users;
    $instance->current_users = $current_users;
    $instance->creator = $creator;
    $instance->id = $instance::$last_id++;
    return $instance;
  }

  public function getUsers() {
    return array(ChannelUser::init(1, "moonrayer", ChannelUserStatus::Online, "https://www.phpbb.com/customise/db/download/133111"),
      ChannelUser::init(2, "rokas", ChannelUserStatus::Blocked, "https://www.onetap.com/data/avatars/o/230/230519.jpg?1605411773"),
      ChannelUser::init(3, "test_user", ChannelUserStatus::Writing, "https://gif-avatars.com/img/200x200/gif-1-1.gif"));
  }

  public function getMessages() {
    return array(ChannelMessage::init($this->getUsers()[0], "Ką tu", "10:23"),
      ChannelMessage::init($this->getUsers()[2], "Nieko", "10:23"),
      ChannelMessage::init($this->getUsers()[0], "O dabar", "10:25"));
  }
}

class ChannelController {
  function getChannels($page = 0) {
    $channels = [Channel::withoutTimesAndDescription("Amazing Channel", 50, 3, 1), 
      Channel::withoutTimesAndDescription("Game of Thrones fans", 20, 1, 1),
      Channel::withoutTimesAndDescription("Anime suggestions", 50, 3, 1),
      Channel::withoutTimesAndDescription("Come here to share your favourite movies :)", 100, 95, 2),
      Channel::withoutTimesAndDescription("New spooderman movie review talk", 50, 20, 2),
      Channel::withoutTimesAndDescription("Spongebob meme finders", 69, 69, 2)];
    return $channels;
  }

  function getChannelById($id) {
    return $this->getChannels()[$id];
  }
}

$_channelController = new ChannelController();