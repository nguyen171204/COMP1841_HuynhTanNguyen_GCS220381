<?php
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';
    $row = getpost($pdo, $_POST['id']);
    unlink('../uploads/' . $row['image']);
    deletepost($pdo, $_POST['id']);
    header('location: posts.php');
} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Unable to connect to delete post: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';
