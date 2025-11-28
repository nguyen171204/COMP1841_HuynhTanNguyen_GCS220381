<?php 
include 'includes/DatabaseConnection.php';

function totalPosts($pdo) {
    $stmt = $pdo->query('SELECT COUNT(*) FROM post');
    return $stmt->fetchColumn();
}

echo totalPosts($pdo);
?>
