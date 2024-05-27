<?php
require_once('../config.php');
require_once('App.php');

$config = include('../config.php');
$app = new ToDoApp($config);
$userAuth = $app->getUserAuth();
$toDoList = $app->getToDoList();

if ($userAuth->isAuthenticated()) {
    $userId = $userAuth->getUserId();
    $updatedTitle = $_REQUEST['UpdatedTitle'];

    $toDoList->deleteList($updatedTitle, $userId);
    echo "List úspešne vymazaný.";
} else {
    echo "Prosím prihláste sa aby ste mohli vymazať list.";
}

header('Location: ../templates/Delete.php');
exit;
?>
