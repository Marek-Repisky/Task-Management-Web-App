<?php
    require_once('../config.php');
    require_once('App.php');

    // Load the configuration settings
    $config = include('../config.php');
    $app = new ToDoApp($config);
    $userAuth = $app->getUserAuth();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // // Retrieve and trim the email and password
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Attempt to log in
        if ($userAuth->loginUser($email, $password)) {
            // If login is successful, redirect to the Create.php
            header("Location: ../templates/Create.php");
            exit;
        }
        else echo "Nesprávny email alebo heslo.";
    }
?>
