<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_user'])) {
            // Add new user
            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sql = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $hashedPassword
                ]);
                header('location: users.php');
                exit();
            }
        } else if (isset($_POST['update_user'])) {
            // Update user
            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['id'])) {
                $sql = 'UPDATE user SET name = :name, email = :email';
                $parameters = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'id' => $_POST['id']
                ];

                // Only update password if a new one is provided
                if (!empty($_POST['password'])) {
                    $sql .= ', password = :password';
                    $parameters['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                }

                $sql .= ' WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute($parameters);
                header('location: users.php');
                exit();
            }
        } else if (isset($_POST['delete_user'])) {
            // Check if user has any posts
            $checkSql = 'SELECT COUNT(*) FROM post WHERE userid = :id';
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute(['id' => $_POST['id']]);
            $count = $checkStmt->fetchColumn();

            if ($count == 0) {
                // Delete user if they have no posts
                $sql = 'DELETE FROM user WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['id' => $_POST['id']]);
            } else {
                $error = "Cannot delete user because they have {$count} post(s).";
            }
            header('location: users.php' . (isset($error) ? '?error=' . urlencode($error) : ''));
            exit();
        } else if (isset($_POST['edit_user'])) {
            // Get user details for editing
            $sql = 'SELECT * FROM user WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $_POST['id']]);
            $edituser = $stmt->fetch();
        }
    }

    // Get all users
    $users = allusers($pdo);
    $title = 'Manage Users';

    ob_start();
    include 'templates/users.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
