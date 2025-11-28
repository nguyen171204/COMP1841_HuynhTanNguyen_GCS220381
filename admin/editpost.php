<?php
include __DIR__ . '/../includes/DatabaseConnection.php';

if (isset($_POST['posttext'])) {
    $sql = 'UPDATE post SET posttext = :posttext WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':posttext', $_POST['posttext']);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
    header('location: post.php');
} else {
    $sql = 'SELECT * FROM post WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $post = $stmt->fetch();

    $title = 'Edit question';
    ob_start();
    include __DIR__ . '/../templates/editpost.html.php';
    $output = ob_get_clean();
    include __DIR__ . '/../templates/admin_layout.html.php';
}
?>