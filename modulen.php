<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_module'])) {
            // Add new module
            if (!empty($_POST['name'])) {
                $sql = 'INSERT INTO module (moduleName) VALUES (:name)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['name' => $_POST['name']]);
                header('location: modulen.php');
                exit();
            }
        } else if (isset($_POST['update_module'])) {
            // Update module
            if (!empty($_POST['name']) && !empty($_POST['id'])) {
                $sql = 'UPDATE module SET moduleName = :name WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'name' => $_POST['name'],
                    'id' => $_POST['id']
                ]);
                header('location: modulen.php');
                exit();
            }
        } else if (isset($_POST['delete_module'])) {
            // Check if module is in use
            $checkSql = 'SELECT COUNT(*) FROM post WHERE moduleid = :id';
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute(['id' => $_POST['id']]);
            $count = $checkStmt->fetchColumn();

            if ($count == 0) {
                // Delete module if not in use
                $sql = 'DELETE FROM module WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['id' => $_POST['id']]);
            } else {
                $error = "Cannot delete module because it is being used by {$count} post(s).";
            }
            header('location: modulen.php' . (isset($error) ? '?error=' . urlencode($error) : ''));
            exit();
        } else if (isset($_POST['edit_module'])) {
            // Get module details for editing
            $sql = 'SELECT * FROM module WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $_POST['id']]);
            $editmodule = $stmt->fetch();
        }
    }

    // Get all modulen
    $modulen = allmodulen($pdo);
    $title = 'Manage modulen';

    ob_start();
    include 'templates/modulen.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
