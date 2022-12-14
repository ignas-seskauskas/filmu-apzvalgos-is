<?php

$ip = $_SERVER['REMOTE_ADDR'];

$ip_blacklist = databaseQuery("SELECT IP_adresas FROM IP_blacklist");
$ip_blacklist = mysqli_fetch_all($ip_blacklist, MYSQLI_ASSOC);

$ip_blacklist = array_map(function($x) {return $x['IP_adresas'];}, $ip_blacklist);

// echo "SETUP ECHO";
// echo $ip;
// var_dump($ip_blacklist);

if (in_array($ip, $ip_blacklist)) {
    header("Location: blocked.php");
} else {
    // echo "NOT BLOCKED";
}

?>