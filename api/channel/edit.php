<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $channel = $GLOBALS['_channelController']->getChannelById($_POST['id']);
  $currentUser = $GLOBALS['_userController']->getCurrentUser();
  if(!$currentUser->getPermissions()->editAllChannels && $currentUser->id != $channel->creator)
    die();

  $GLOBALS['_channelController']->editChannel((object) $_POST);
  $result = array('success' => 'success');

  echo json_encode($result);
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");  
  die();
} else {
  $result = array('error' => 'Bad request method');
}