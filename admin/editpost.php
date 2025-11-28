<?php
session_start();
if (!isset($_SESSION['userised']) || $_SESSION['userised'] != 'Y') {
    header('Location: login/login.html.php');
    exit();
}

include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

try {
    if (isset($_POST['posttext'])) {
        updatepost($pdo, $_POST['postid'], $_POST['posttext']);
        header('location: posts.php');
    } else {
        $post = getpost($pdo, $_GET['id']);
        $title = 'Edit post';

        ob_start();
        include '../templates/editpost.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'error has occurred';
    $output = 'Error editing post: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';
                        