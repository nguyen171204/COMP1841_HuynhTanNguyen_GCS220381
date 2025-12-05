<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';
    deletepost($pdo, $_POST['id']);
    header('location: posts.php');
} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Unable to connect to delete post: ' . $e->getMessage();
}
include 'templates/layout.html.php';
