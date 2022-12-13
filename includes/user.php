<?php

include('user_permissions.php');

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
  public $channel;
  public $status;

  function getPermissions()
  {
    return $GLOBALS['_permissions'][$this->type];
  }
}

class UserController
{
  function getCurrentUser()
  {
    if(!isset($_SESSION['user']))
      return null;
      
    $escapedId = databaseEscapeString($_SESSION['user']);
    return databaseFillObject("SELECT * FROM `user` WHERE `id` = $escapedId", function () {
      return new User();
    });
  }

  function getUsersByIds($ids)
  {
    $idsImploded = implode(",", $ids);
    return databaseFillObjects("SELECT * FROM `user` WHERE `id` IN ({$idsImploded})", function () {
      return new User();
    });
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

    $_SESSION['user'] = $selectedUser->id;
    return $selectedUser;
  }
}

$_userController = new UserController();
