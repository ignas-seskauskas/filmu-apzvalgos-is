<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $newChannelId = $GLOBALS['_channelController']->addChannel((object) $_POST);
  $result = array('success' => 'success', 'payload' => ['createdId' => $newChannelId]);

  echo json_encode($result);
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");  
  die();
} else {
  $result = array('error' => 'Bad request method');
}