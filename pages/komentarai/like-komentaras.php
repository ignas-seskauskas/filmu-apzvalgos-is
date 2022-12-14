<?php
$commentID = $_GET['id'];
$currentUser = $GLOBALS['_userController']->getCurrentUser();

$dbc = mysqli_connect($GLOBALS['_mysqlHost'], $GLOBALS['_mysqlUsername'], $GLOBALS['_mysqlPassword'], $GLOBALS['_mysqlDatabase']);
$sql = "INSERT INTO `komentaro_ivertinimas`(`patiko`, `id`, `fk_Komentaras`, `fk_user`) VALUES (1, '', $commentID, $currentUser->id)";
$result = mysqli_query($dbc, $sql);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
exit();