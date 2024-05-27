<?php
    require_once('../config.php');
    require_once('App.php');

    $config = include('../config.php');
    $app = new ToDoApp($config);
    $userAuth = $app->getUserAuth();
    $toDoList = $app->getToDoList();

    if ($userAuth->isAuthenticated()) {
        $title = $_REQUEST['title'] ?? null;
        $description = $_REQUEST['description'] ?? '';
        $listItem = $_REQUEST['listItem'] ?? '';
        $userId = $userAuth->getUserId();

        if ($title) {
            $toDoList->createList($title, $description, $listItem, $userId);
            echo "List úspešne vytvorený.";
        }
        else echo "Nadpis nie je zadaný.";

        header('Location: ../templates/Create.php');
        exit;
    } 
    else echo "Prosím prihláste sa aby ste mohli vytvoriť list.";
?>
