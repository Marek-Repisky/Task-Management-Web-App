<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "List_Database";
$tbname = "List_Table";
$tb2name = "Users";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>
