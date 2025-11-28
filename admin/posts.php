<?php
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    $posts = allPosts($pdo);
    $title = 'Post list';
    $totalPosts = totalPosts($pdo);

    ob_start();
    include '../templates/adminposts.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/admin_layout.html.php';
?>
