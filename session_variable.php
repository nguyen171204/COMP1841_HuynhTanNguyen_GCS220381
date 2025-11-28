<?php session_start();
//store session date//
$_SESSION['views'] = 1;
//retrieve session data//
echo "Pageview=". $_SESSION['views'];
?>