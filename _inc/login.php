<?php
require_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT id, password FROM Users WHERE Email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                setcookie("User_Id", $id, time() + (86400 * 30), "/"); // 30-day expiration
                header("Location: ../templates/Create.php");
                exit;
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No account found with that email.";
        }
        $stmt->close();
    }
    $conn->close();
}
?>
