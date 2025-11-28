<?php
$ActualPassword = "secret";
if ($_POST["password"] == $ActualPassword) {
    session_start();
    $_SESSION["Authorised"] = "Y";
    header("Location:../posts.php");
} else {
    header("Location:wrong_password.php");
}