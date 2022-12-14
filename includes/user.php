<?php

include('user_permissions.php');

class ChannelBlocking
{
  public $user_blocker;
  public $user_blocked;
}

class User
{
  public $id;
  public $name;
  public $surname;
  public $email;
  public $password;
  public $username;
  public $type;
  public $register_time;
  public $ip;
  public $last_visit_time;
  public $avatar_src;
  public $avatar_height;
  public $avatar_width;
  public $channel;
  public $status;

  function getPermissions()
  {
    return $GLOBALS['_permissions'][$this->type];
  }

  function isBlocked()
  {
    $currentUser = $GLOBALS['_userController']->getCurrentUser();
    if (!isset($currentUser))
      return false;
    $blocking = databaseFillObject("SELECT * FROM `channel_blocking` WHERE `user_blocker` = {$currentUser->id} AND `user_blocked` = {$this->id}", function () {
      return new ChannelBlocking();
    });
    return isset($blocking);
  }

  function toggleBlock()
  {
    $currentUser = $GLOBALS['_userController']->getCurrentUser();
    if (!isset($currentUser))
      return;
    if ($this->isBlocked()) {
      return databaseQuery("DELETE FROM `channel_blocking` WHERE `user_blocker` = {$currentUser->id} AND `user_blocked` = {$this->id}");
    } else {
      return databaseQuery("INSERT INTO `channel_blocking` (`user_blocker`,`user_blocked`) VALUES ({$currentUser->id}, {$this->id})");
    }
  }
}

class UserController
{
  function getCurrentUser()
  {
    if (!isset($_SESSION['user']))
      return null;

    $escapedId = databaseEscapeString($_SESSION['user']);
    return databaseFillObject("SELECT * FROM `user` WHERE `id` = $escapedId", function () {
      return new User();
    });
  }

  function getUsersByIds($ids, $filter)
  {
    $idsImploded = implode(",", $ids);
    if (isset($filter) && $filter != "") {
      $escapedFilter = databaseEscapeString($filter);
      return databaseFillObjects("SELECT * FROM `user` WHERE `id` IN ({$idsImploded}) AND `name` LIKE '%$filter%'", function () {
        return new User();
      });
    } else {
      return databaseFillObjects("SELECT * FROM `user` WHERE `id` IN ({$idsImploded})", function () {
        return new User();
      });
    }
  }

  function getUserById($id)
  {
    $escapedId = databaseEscapeString($id);
    return databaseFillObject("SELECT * FROM `user` WHERE `id` = $escapedId", function () {
      return new User();
    });
  }

  function registerNewUser($user)
  {
    $user = databaseEscapeObject($user);

    $user->type = UserType::Default->value;
    $user->ip = $_SERVER['REMOTE_ADDR'];
    $user->register_time = date("Y-m-d H:i:s");
    $user->last_visit_time = date("Y-m-d H:i:s");
    $user->avatar_src = "";

    databaseQuery("INSERT INTO `user` (`name`, `surname`, `email`, `password`, `username`, `type`, `register_time`, `ip`, `last_visit_time`, `avatar_src`)
     VALUES ('{$user->name}', '{$user->surname}', '{$user->email}', '{$user->password}', '{$user->username}', '{$user->type}', '{$user->register_time}', '{$user->ip}', '{$user->last_visit_time}', '{$user->avatar_src}')");

    return databaseInsertId();
  }

  function isUserRegistered($email)
  {
    $email = databaseEscapeString($email);
    $result = databaseQuery("SELECT * FROM `user` WHERE email='{$email}'");
    $num_rows = databaseNumOfRows($result);

    if ($num_rows > 0) {
      return true;
    } else {
      return false;
    }
  }

  function loginUser($user)
  {
    $user = databaseEscapeObject($user);

    $selectedUser = databaseFillObject("SELECT * FROM `user` WHERE email='{$user->email}' AND password='{$user->password}'", function () {
      return new User();
    });
    if ($selectedUser !== null) {
      $_SESSION['user'] = $selectedUser->id;
      return $selectedUser;
    }
    return null;
  }

  function updateUserProfile($user)
  {
    $user = databaseEscapeObject($user);

    // session_start();
    $id = $_SESSION['user'];

    databaseQuery("UPDATE `user` SET name='{$user->name}', surname='{$user->surname}', username='{$user->username}', avatar_src='{$user->avatar_src}', avatar_height='{$user->avatar_height}', avatar_width='{$user->avatar_width}'
    WHERE id='{$id}'");

    $num_of_rows = databaseRowsAffected();

    if ($num_of_rows > 0) {
      // $_SESSION['_user']->name = $user->name;
      // $_SESSION['_user']->surname = $user->surname;
      // $_SESSION['_user']->username = $user->username;
      // $_SESSION['_user']->avatar_src = $user->avatar_src;
      // $_SESSION['_user']->avatar_height = $user->avatar_height;
      // $_SESSION['_user']->avatar_width = $user->avatar_width;
      return true;
    } else {
      return false;
    }
  }

  function deleteUserProfile()
  {
    $id = $_SESSION['user'];
    databaseQuery("DELETE FROM `user` WHERE id='{$id}'");
  }

  function logoutUser()
  {
    $id = $_SESSION['user'];
    $currentTime = date("Y-m-d H:i:s");
    databaseQuery("UPDATE `user` SET last_visit_time='{$currentTime}' WHERE id='{$id}'");
  }
}

$_userController = new UserController();
