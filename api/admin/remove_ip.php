<?php
// if($_SERVER['REQUEST_METHOD'] == 'POST') {
//   $newChannelId = $GLOBALS['_channelController']->addChannel((object) $_POST);
//   $result = array('success' => 'success', 'payload' => ['createdId' => $newChannelId]);

//   echo json_encode($result);
//   header("Content-Type: application/json; charset=UTF-8");
//   header("Access-Control-Allow-Origin: *");  
//   die();
// } else {
//   $result = array('error' => 'Bad request method');
// }
// session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    var_dump($_POST);
    $idd = $_POST['id'];
    // $bs = $_POST['bs'];
    // $comment = $_POST['comment'];

    databaseQuery("DELETE FROM ip_blacklist WHERE id_IP_blacklist = '$idd'");
    // $ip_blacklist = mysqli_fetch_all($ip_blacklist, MYSQLI_ASSOC);
    // $testing();
    // header("Location: /index");
    // session_start();
    // // $GLOBALS["ttest"] = "WORKED!";
    // $_SESSION["test"] = "workdedddd!";
    // header("Content-Type: application/json; charset=UTF-8");
    // header("Access-Control-Allow-Origin: *");  
    // die();

    // databaseQuery("INSERT INTO `test` (`id`) VALUES (12)");
} else {
    // session_start();
    // $_SESSION["test"] = "workdedddd!";
}