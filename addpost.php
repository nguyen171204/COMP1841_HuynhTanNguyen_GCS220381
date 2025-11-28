<?php
if (isset($_POST['posttext'])) {
    try {

        include 'includes/DatabaseConnection.php';
        include 'includes/DatabaseFunctions.php';
        insertpost($pdo, $_POST['posttext'], $_FILES['fileToUpload']['name'], $_POST['users'], $_POST['modulen']);
        include 'includes/upload.php';
        // $sql = 'INSERT INTO post SET
        // posttext = :posttext,
        // postdate = CURDATE(),
        // userid = :userid,
        // moduleid = :moduleid';   
        // $stmt = $pdo->prepare($sql);
        // $stmt->bindValue(':posttext', $_POST['posttext']);
        // $stmt->bindValue(':userid', $_POST['users']);
        // $stmt->bindValue(':moduleid', $_POST['modulen']);
        // $stmt->execute();
        header('location: posts.php');
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';
    $title = 'Add a new post';
    // $sql_a = 'SELECT * FROM user';
    $users = allusers($pdo);
    // $sql_c = 'SELECT * FROM module';
    $modulen = allmodulen($pdo);
    ob_start();
    include 'templates/addpost.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
