<?php
    require_once('../config.php');
    require_once('App.php');

    // Load the configuration
    $config = include('../config.php');
    $app = new ToDoApp($config);
    $userAuth = $app->getUserAuth();

    // Log out the user
    $userAuth->logoutUser();
    // Redirect to the index.php page after logging out
    header("Location: ../index.php");
    exit;
?>
