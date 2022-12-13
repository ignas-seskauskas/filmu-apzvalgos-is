<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['action'])) {
    switch ($_POST['action']) {
      case 'register':
        $email = $_POST['values']['email'];
        $isRegistered = $GLOBALS['_userController']->isUserRegistered($email);
        if ($isRegistered === true) {
          $result = array('error' => 'user with this email already exists');
          break;
        }
        $newUserId = $GLOBALS['_userController']->registerNewUser((object) $_POST['values']);
        $result = array('success' => 'registered sucessfully');
        break;
      case 'login':
        $email = $_POST['values']['email'];
        $isRegistered = $GLOBALS['_userController']->isUserRegistered($email);
        if ($isRegistered === true) {
          $userObj = $GLOBALS['_userController']->loginUser((object) $_POST['values']);
          if ($userObj !== null) {
            $_SESSION['_user'] = $userObj;
            $result = array('success' => 'logged in');
          } else {
            $result = array('error' => 'password not correct');
          }
        } else {
          $result = array('error' => 'user is not registered');
        }
        break;
      default:
        $result = array('error' => 'Action not implemented');
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
