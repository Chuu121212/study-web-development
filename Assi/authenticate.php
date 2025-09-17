<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        session_regenerate_id(true);
                        $_SESSION['loggedin'] = true;
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $username;
                        header("location: welcome.php");
                        exit;
                    } else {
                        $_SESSION['error'] = 'Invalid username or password.';
                        header('Location: login.php');
                        exit;
                    }
                }
            } else {
                $_SESSION['error'] = 'Invalid username or password.';
                header('Location: login.php');
                exit;
            }
        } else {
            $_SESSION['error'] = 'Oops! Something went wrong.';
            header('Location: login.php');
            exit;
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>