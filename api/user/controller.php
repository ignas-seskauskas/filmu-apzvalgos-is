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
            // $_SESSION['_user'] = $userObj;
            $result = array('success' => 'logged in');
          } else {
            $result = array('error' => 'password not correct', 'val' => $userObj);
          }
        } else {
          $result = array('error' => 'user is not registered');
        }
        break;
      case 'logout':
        $GLOBALS['_userController']->logoutUser();
        $result = array('success' => 'test');
        break;
      case 'updateProfile':
        $isProfileUpdated = $GLOBALS['_userController']->updateUserProfile((object) $_POST['values']);
        if ($isProfileUpdated === true) {
          $result = array('success' => 'profile updated successfully');
        } else {
          $result = array('error' => 'profile update was unsuccessful');
        }
        break;
      case 'deleteProfile':
        $GLOBALS['_userController']->deleteUserProfile();
        $result = array('error' => 'profile deleted');
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
}
// else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//   if (isset($_POST['action'])) {
//     switch ($_POST['action']) {
//       case 'updateProfile':
//         break;
//         default:
//     }
//   }
//   echo json_encode($result);
//   header("Content-Type: application/json; charset=UTF-8");
//   header("Access-Control-Allow-Origin: *");
//   die();
// } 
else {
  $result = array('error' => 'Bad request method');
}
