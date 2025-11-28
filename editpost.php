<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

try {
    if (isset($_POST['submit'])) {
        // Get current post data
        $currentPost = getpost($pdo, $_POST['postid']);
        $image = $currentPost['image']; // Keep existing image by default

        // Check if this is an admin edit
        $is_admin = false;
        if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
            $is_admin = true;
        }

        // Handle image upload if a new image is selected
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['size'] > 0) {
            $image = $_FILES['fileToUpload']['name'];
            $target_dir = "image/";
            $target_file = $target_dir . $image;

            // Delete old image if exists
            if (!empty($currentPost['image'])) {
                $oldFile = $target_dir . $currentPost['image'];
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            // Upload new image
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                // Image uploaded successfully
                updatepost($pdo, $_POST['postid'], $_POST['posttext'], $_POST['userid'], $_POST['moduleid'], $image, $is_admin);
                header('location: posts.php');
                exit();
            } else {
                throw new Exception("Failed to upload image.");
            }
        } else {
            // No new image uploaded, just update other fields
            updatepost($pdo, $_POST['postid'], $_POST['posttext'], $_POST['userid'], $_POST['moduleid'], $image, $is_admin);
            header('location: posts.php');
            exit();
        }
    } else {
        $post = getpost($pdo, $_GET['id']);
        $users = allusers($pdo);
        $modulen = allmodulen($pdo);
        $title = 'Edit post';

        ob_start();
        include 'templates/editpost.html.php';
        $output = ob_get_clean();
    }
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
