<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';

    $posts = allposts($pdo);
    $title = 'post list';
    $totalposts = totalposts($pdo);

    ob_start();
    include 'templates/posts.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Database error:' . $e->getMessage();
}
include 'templates/layout.html.php';
