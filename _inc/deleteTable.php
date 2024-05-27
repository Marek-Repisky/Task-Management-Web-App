<?php
    require_once('../config.php');
    require_once('App.php');

    // Load the configuration settings
    $config = include('../config.php');
    // Create a new instance of the ToDoApp with the configuration settings
    $app = new ToDoApp($config);
    $userAuth = $app->getUserAuth();
    $toDoList = $app->getToDoList();

    // Check if the user is authenticated
    if ($userAuth->isAuthenticated()) {
        $userId = $userAuth->getUserId();
        $updatedTitle = $_REQUEST['UpdatedTitle'];

        // Delete the to-do list with the given title for the authenticated user
        $toDoList->deleteList($updatedTitle, $userId);
        echo "List úspešne vymazaný.";
    } 
    else echo "Prosím prihláste sa aby ste mohli vymazať list.";

    // Redirect to the Delete.php
    header('Location: ../templates/Delete.php');
    exit;
?>
