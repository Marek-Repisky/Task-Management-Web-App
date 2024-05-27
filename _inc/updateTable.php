<?php
require_once('../config.php');
require_once('App.php');

$config = include('../config.php');
$app = new ToDoApp($config);
$userAuth = $app->getUserAuth();
$toDoList = $app->getToDoList();

if ($userAuth->isAuthenticated()) {
    $userId = $userAuth->getUserId();
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $listItem = $_REQUEST['listItem'];
    $updatedTitle = $_REQUEST['UpdatedTitle'];

    $toDoList->updateList($title, $description, $listItem, $updatedTitle, $userId);
    echo "List úspešne aktualizovaný.";

    header('Location: ../templates/Update.php');
    exit;
} else {
    echo "Prosím prihláste sa aby ste mohli aktualizovať vaše listy.";
}
?>
