<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $channel = $GLOBALS['_channelController']->getChannelById($_POST['id']);
  $currentUser = $GLOBALS['_userController']->getCurrentUser();
  if(!$currentUser->getPermissions()->removeAllChannels && $currentUser->id != $channel->creator)
    die();

  $newChannelId = $GLOBALS['_channelController']->removeChannel((object) $_POST);
  $result = array('success' => 'success');

  echo json_encode($result);
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");  
  die();
} else {
  $result = array('error' => 'Bad request method');
}