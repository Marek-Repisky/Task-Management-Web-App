<?php
    require_once('../config.php');
    require_once('App.php');

    $config = include('../config.php');
    $app = new ToDoApp($config);
    $userAuth = $app->getUserAuth();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if ($userAuth->loginUser($email, $password)) {
            header("Location: ../templates/Create.php");
            exit;
        } 
        else echo "Nesprávny email alebo heslo.";
    }
?>
