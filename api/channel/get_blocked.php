<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $potentially_blocked_id = $_POST['user_id'];
  $user = $GLOBALS['_userController']->getUserById($potentially_blocked_id);
  
  $result = array('success' => 'success', 'payload' => ['blocked' => $user->isBlocked() ? 1 : 0]);

  echo json_encode($result);
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");  
  die();
} else {
  $result = array('error' => 'Bad request method');
}