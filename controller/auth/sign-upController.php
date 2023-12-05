<?php
global $conn;
session_start();
require_once __DIR__ . '/../../config/DbConnection.php';

$name_error = '';
$password_error = '';
$re_enter_password_error = '';
$username_taken_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $re_enter_password = $_POST['re_enter_password'] ?? '';

    if (empty($username)) {
        $name_error = 'Name is required';
    } else {
        $stmt = $conn->prepare("SELECT id FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $username_taken_error = 'Username is already taken';
        }
        $stmt->close();
    }

    if (empty($password)) {
        $password_error = 'Password is required';
    } elseif (strlen($password) < 8) {
        $password_error = 'Password must be at least 8 characters';
    }

    if (empty($re_enter_password)) {
        $re_enter_password_error = 'Re-enter your password';
    } elseif ($password !== $re_enter_password) {
        $re_enter_password_error = 'Passwords must match';
    }

    if (empty($name_error) && empty($password_error) && empty($re_enter_password_error) && empty($username_taken_error)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_stmt = $conn->prepare("INSERT INTO user (username, password, isadmin) VALUES (?, ?, FALSE)");
        $insert_stmt->bind_param("ss", $username, $hashed_password);
        $insert_stmt->execute();
        $insert_stmt->close();

        header("Location: /PHPjs/views/login.php");
    } else {
        $_SESSION['form_data'] = $_POST;
        $_SESSION['name_error'] = $name_error;
        $_SESSION['password_error'] = $password_error;
        $_SESSION['re_enter_password_error'] = $re_enter_password_error;
        $_SESSION['username_taken_error'] = $username_taken_error;

        header("Location: /PHPjs/views/sign-up.php");
    }
    exit;
}
