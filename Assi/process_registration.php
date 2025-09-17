<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Username and password are required.';
        header('Location: register.php');
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
        $param_username = $username;
        $param_password = $hashed_password;

        if (mysqli_stmt_execute($stmt)) {
            header("location: login.php");
            exit;
        } else {
            if(mysqli_errno($link) == 1062){
                $_SESSION['error'] = 'This username is already taken.';
            } else {
                 $_SESSION['error'] = 'Oops! Something went wrong. Please try again later.';
            }
            header('Location: register.php');
            exit;
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>