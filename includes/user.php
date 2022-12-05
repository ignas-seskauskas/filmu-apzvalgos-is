<?php

include('user_permissions.php');

class User {
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

  function getPermissions() {
    return $GLOBALS['_permissions'][$this->type];
  }
}

class UserController {
  function getCurrentUser() {
    return databaseFillObject("SELECT * FROM `user` WHERE `id` = 2", function () {return new User();});
  }
}

$_userController = new UserController();

