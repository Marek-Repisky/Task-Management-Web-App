<?php
session_start();
require_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    $agree = isset($_POST['agree']) ? $_POST['agree'] : '';

    // Error handling
    $errors = [];
    if (empty($username)) $errors[] = "Please enter a username.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Please enter a valid email address.";
    if (empty($password)) $errors[] = "Please enter a password.";
    if ($password !== $password2) $errors[] = "Passwords do not match.";
    if (empty($agree) || $agree !== 'yes') $errors[] = "You must agree to the terms of service.";

    $sql = "CREATE TABLE IF NOT EXISTS $tb2name (
        Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Username VARCHAR(50) NOT NULL UNIQUE,
        Email VARCHAR(50) NOT NULL UNIQUE,
        Password VARCHAR(255) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) ;//echo "Table" .$tbname. "created successfully";
    else echo "Error creating table " .$tbname. ": " .$conn->error;

    // Check if username or email already exists
    $sql = "SELECT id FROM $tb2name WHERE username = ? OR email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) $errors[] = "Username or email already taken.";

        $stmt->close();
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO $tb2name (username, email, password) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            if ($stmt->execute()) {
                header("Location: ../templates/LoginForm.php");
                exit;
            }
            else echo "Something went wrong. Please try again later.";
            
            $stmt->close();
        }
    }
    else foreach ($errors as $error) echo "<p>$error</p>";
}

$conn->close();
?>
