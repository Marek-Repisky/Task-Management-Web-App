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
        $userId = $userAuth->getUserId();
        // Retrieve the title, description, list item, and updated title
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $listItem = $_REQUEST['listItem'];
        $updatedTitle = $_REQUEST['UpdatedTitle'];

        // Update the to-do list
        $toDoList->updateList($title, $description, $listItem, $updatedTitle, $userId);
        echo "List úspešne aktualizovaný.";

        // Redirect to the Update.php
        header('Location: ../templates/Update.php');
        exit;
    } 
    else echo "Prosím prihláste sa aby ste mohli aktualizovať vaše listy.";
?>
