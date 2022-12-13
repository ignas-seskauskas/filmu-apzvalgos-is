<?php
$movieID = $_GET['moveid'];
$commentID = $_GET['id'];


$dbc = mysqli_connect($GLOBALS['_mysqlHost'], $GLOBALS['_mysqlUsername'], $GLOBALS['_mysqlPassword'], $GLOBALS['_mysqlDatabase']);
$sql = "DELETE FROM `komentaras` WHERE `id`=$commentID";
$result = mysqli_query($dbc, $sql);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
exit();