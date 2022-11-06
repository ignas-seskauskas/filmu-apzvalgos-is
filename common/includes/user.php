<?php

include('user_permissions.php');

class User {
  public $type;
  public $id;
  public $permissions;
}

class UserController {
  function getCurrentUser() {
    $user = new User();
    $user->type = UserType::Default;
    $user->id = 1;
    $user->permissions = $GLOBALS['_permissions'][$user->type->value];

    return $user;
  }
}

$_userController = new UserController();

