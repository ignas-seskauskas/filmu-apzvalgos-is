<?php
enum UserType: string {
  case Moderator = 'Moderator';
  case Critic = 'Critic';
  case Default = 'Default';
  case LoggedOut = 'LoggedOut';
}

class UserPermissions {
  public $editAllChannels;
  public $removeAllChannels;
}

$_permissions = array();

$_permissions[UserType::Moderator->value] = new UserPermissions();
$_permissions[UserType::Moderator->value]->editAllChannels = true;
$_permissions[UserType::Moderator->value]->removeAllChannels = true;

$_permissions[UserType::Default->value] = new UserPermissions();
$_permissions[UserType::Default->value]->editAllChannels = false;
$_permissions[UserType::Default->value]->removeAllChannels = false;

$_permissions[UserType::Critic->value] = $_permissions[UserType::Default->value];
$_permissions[UserType::LoggedOut->value] = $_permissions[UserType::Default->value];