<?php
// Enable error reporting for debugging (remove or disable in production)
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$title = 'Student Forum';
ob_start();
include __DIR__ . '/templates/home.html.php';
$output = ob_get_clean();
include __DIR__ . '/templates/layout.html.php';
?>
