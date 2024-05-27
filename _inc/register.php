<?php
require_once('../config.php');
require_once('App.php');

$config = include('../config.php');
$app = new ToDoApp($config);
$userAuth = $app->getUserAuth();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    $agree = isset($_POST['agree']) ? $_POST['agree'] : '';

    $errors = [];
    if (empty($username)) $errors[] = "Please enter a username.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Please enter a valid email address.";
    if (empty($password)) $errors[] = "Please enter a password.";
    if ($password !== $password2) $errors[] = "Passwords do not match.";
    if (empty($agree) || $agree !== 'yes') $errors[] = "You must agree to the terms of service.";

    if (empty($errors)) {
        $userAuth->registerUser($username, $email, $password);
        header("Location: ../templates/LoginForm.php");
        exit;
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>
