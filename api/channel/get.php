<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $channels = [];
  if(isset($_POST['name_filter'])) {
    $channels = $GLOBALS['_channelController']->filterByName($_POST['name_filter']);
  } else {
    $channels = $GLOBALS['_channelController']->getChannels();
  }
  
  $result = array('success' => 'success', 'payload' => ['channels' => $channels]);

  echo json_encode($result);
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");  
  die();
} else {
  $result = array('error' => 'Bad request method');
}