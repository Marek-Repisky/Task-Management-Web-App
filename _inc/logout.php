<?php
require_once('../config.php');
require_once('App.php');

$config = include('../config.php');
$app = new ToDoApp($config);
$userAuth = $app->getUserAuth();

$userAuth->logoutUser();
header("Location: ../index.php");
exit;
?>
