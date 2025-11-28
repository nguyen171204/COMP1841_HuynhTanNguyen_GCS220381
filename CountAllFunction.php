<?php 
include 'includes/DatabaseConnection.php';

function totalPosts($pdo) {
    $query = $pdo->prepare('SELECT COUNT(*) FROM post');
    $query->execute();
    $row = $query->fetch();
    return $row[0];
}

echo totalPosts($pdo);
?>
