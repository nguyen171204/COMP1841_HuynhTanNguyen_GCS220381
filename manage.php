<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_user'])) {
            // Add new user
            if (!empty($_POST['name']) && !empty($_POST['password'])) {
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sql = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'name' => $_POST['name'],
                    'email' => $_POST['email'] ?? '',
                    'password' => $hashedPassword
                ]);
                header('location: manage.php');
                exit();
            }
        } else if (isset($_POST['update_user'])) {
            // Update user
            $sql = 'UPDATE user SET name = :name, email = :email';
            $parameters = [
                'name' => $_POST['name'],
                'email' => $_POST['email'] ?? '',
                'id' => $_POST['id']
            ];

            // Check if a new password was provided in the form
            if (!empty($_POST['password'])) {
                $sql .= ', password = :password';
                // Hash the password using PHP's secure hashing function
                // PASSWORD_DEFAULT uses the bcrypt algorithm
                // This automatically:
                // 1. Generates a random salt
                // 2. Uses a strong hashing algorithm
                // 3. Includes the salt in the hash
                $parameters['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }

            $sql .= ' WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($parameters);
            header('location: manage.php');
            exit();
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
            header('location: manage.php' . (isset($error) ? '?error=' . urlencode($error) : ''));
            exit();
        } else if (isset($_POST['edit_user'])) {
            // Get user details for editing
            $sql = 'SELECT * FROM user WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $_POST['id']]);
            $edituser = $stmt->fetch();
        }
    }

    $users = allusers($pdo);
    $title = 'user Management';

    ob_start();
    include 'templates/manage.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
