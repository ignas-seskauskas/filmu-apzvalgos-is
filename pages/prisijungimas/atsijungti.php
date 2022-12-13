<?php
session_start();
unset($_SESSION["_user"]);
header("location:index.php");
exit();
