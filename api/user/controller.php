<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['action'])) {
    if ($_POST['action'] === 'register') {
      $newUserId = $GLOBALS['_userController']->registerNewUser((object) $_POST['values']);
      $result = array('success' => $_POST['action']);
    } else {
      $result = array('error' => 'Action not found');
    }
  } else {
    $result = array('error' => 'Action not set');
  }
  echo json_encode($result);
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  die();
} else {
  $result = array('error' => 'Bad request method');
}
