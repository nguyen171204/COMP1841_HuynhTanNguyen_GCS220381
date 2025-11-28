<?php
require 'includes/DatabaseConnection.php';
require 'includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $comment = trim(htmlspecialchars($_POST['comment'] ?? ''));
    
    // Input validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format');
    }
    
    if (empty($comment)) {
        die('Comment cannot be empty');
    }
    
    try {
        // Get user ID from session if logged in, otherwise use default
        session_start();
        $userId = $_SESSION['user_id'] ?? 1;

        // Save feedback to user_message table
        $query = 'INSERT INTO user_message (feedback_message, email, time, user_id) 
                 VALUES (:comment, :email, NOW(), :user_id)';
        $parameters = [
            ':comment' => $comment,
            ':email' => $email,
            ':user_id' => $userId
        ];
        query($pdo, $query, $parameters);

        // Redirect to thank you page
        header('Location: thank_you.php');
        exit();
    } catch (PDOException $e) {
        // Log error and show user-friendly message
        error_log('Database Error: ' . $e->getMessage());
        die('An error occurred while processing your feedback. Please try again later.');
    }
}
?>
