<?php
    require_once('../config.php');
    require_once('App.php');

    // Load the configuration settings
    $config = include('../config.php');
    $app = new ToDoApp($config);
    $userAuth = $app->getUserAuth();
    $toDoList = $app->getToDoList();

    // Check if the user is authenticated
    if ($userAuth->isAuthenticated()) {
        // Retrieve the title, description, and listItem with default values
        $title = $_REQUEST['title'] ?? null;
        $description = $_REQUEST['description'] ?? '';
        $listItem = $_REQUEST['listItem'] ?? '';
        // Get the authenticated user's ID
        $userId = $userAuth->getUserId();

        // Check if the title is provided
        if ($title) {
            // Create a new to-do list for the user
            $toDoList->createList($title, $description, $listItem, $userId);
            echo "List úspešne vytvorený.";
        } 
        else echo "Nadpis nie je zadaný.";

        header('Location: ../templates/Create.php');
        exit;
    } 
    else echo "Prosím prihláste sa aby ste mohli vytvoriť list.";
?>
