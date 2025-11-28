<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';
    $edituser = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['add_user'])) {

            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {

                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $sql = 'INSERT INTO user (name, email, password) 
                        VALUES (:name, :email, :password)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'name'     => $_POST['name'],
                    'email'    => $_POST['email'],
                    'password' => $hashedPassword
                ]);

                header('Location: users.php');
                exit();
            }

        } elseif (isset($_POST['update_user'])) {

            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['id'])) {

                $sql = 'UPDATE user SET name = :name, email = :email';
                $parameters = [
                    'name'  => $_POST['name'],
                    'email' => $_POST['email'],
                    'id'    => $_POST['id']
                ];
                if (!empty($_POST['password'])) {
                    $sql .= ', password = :password';
                    $parameters['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                }

                $sql .= ' WHERE id = :id';

                $stmt = $pdo->prepare($sql);
                $stmt->execute($parameters);

                header('Location: users.php');
                exit();
            }
        }
    }
    $users = allusers($pdo);

    $title = 'Manage Users';

    ob_start();
    include 'templates/users.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title  = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/public_layout.html.php';