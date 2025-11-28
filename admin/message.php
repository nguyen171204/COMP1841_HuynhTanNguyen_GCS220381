<?php
require "login/Check.php"; 

try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';


    $feedbacks = getAllFeedback($pdo);

    $title = 'User Feedback';
    ob_start();
    include '../templates/admin_feedback.html.php'; 
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/admin_layout.html.php'; 
?>
