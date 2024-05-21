<?php
    require_once('../config.php');
    global $conn, $dbname, $tbname;
        
    // Sanitize user inputs
    $tit = $conn->real_escape_string($_REQUEST['title']);
    $des = $conn->real_escape_string($_REQUEST['description']);
    $ls = $conn->real_escape_string($_REQUEST['listItem']);
    
    // Prepare an SQL statement for execution
    $stmt = $conn->prepare("INSERT INTO $tbname (Title, Description, ListItem) VALUES (?, ?, ?)");
    if ($stmt === false) die("ERROR: Could not prepare SQL statement. " . $conn->error);
    // Bind parameters to the SQL statement
    $stmt->bind_param("sss", $tit, $des, $ls);
        
    if ($stmt->execute()) {
        /*echo "<h3>Data stored in the database successfully.</h3>";
          echo nl2br("\n$tit\n $des\n $ls");*/
    }
    else echo "ERROR: Could not execute query. " . $stmt->error;

    $stmt->close();
    $conn->close();
    header('Location: ../templates/Create.php');
    exit;
?>