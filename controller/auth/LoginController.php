<?php
global $conn;
session_start();

require_once __DIR__ . '/../../config/DbConnection.php';

$name_error = '';
$password_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username)) {
        $name_error = 'Name is required';
    }
    if (empty($password)) {
        $password_error = 'Password is required';
    }

    if (empty($name_error) && empty($password_error)) {
        $stmt = $conn->prepare("SELECT id, username, password, isadmin FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            $_SESSION['login_error'] = "Username not found.";
            $_SESSION['form_data'] = $_POST;
        } else {
            $stmt->bind_result($id, $username, $hashed_password, $isadmin);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['isadmin'] = $isadmin;

                $stmt->close();
                $conn->close();

                header('Location: ' . ($isadmin ? '/PHPjs/views/filmsView.php' : '/PHPjs/views/user_home.php'));
                exit;
            } else {
                $_SESSION['login_error'] = "Incorrect password.";
                $_SESSION['form_data'] = $_POST;
            }
        }
    } else {
        $_SESSION['form_data'] = $_POST;
    }


    $_SESSION['name_error'] = $name_error;
    $_SESSION['password_error'] = $password_error;

    $conn->close();
    $location = "/PHPjs/views/login.php";
    header("Location: " . $location);
    exit;

}

$conn->close();