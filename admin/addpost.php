<?php
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['posttext'])) {
        $sql = 'INSERT INTO post SET
                posttext = :posttext,
                postdate = CURDATE(),
                userid = :userid,
                moduleid = :moduleid';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':posttext', $_POST['posttext'], PDO::PARAM_STR);
        $stmt->bindValue(':userid', $_POST['users'], PDO::PARAM_INT);
        $stmt->bindValue(':moduleid', $_POST['moduleid'], PDO::PARAM_INT);
        $stmt->execute();

        header('Location: posts.php');
        exit;
    }

    $title = 'Add a new question';
    $users= $pdo->query('SELECT * FROM user');
    $modules = $pdo->query('SELECT * FROM module');

    ob_start();
    include '../templates/addpost.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'Error adding post';
    $output = 'Database error: ' . $e->getMessage();
}

include '../templates/admin_layout.html.php';
?>
