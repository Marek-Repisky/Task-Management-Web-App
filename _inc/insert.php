<?php
    /*require_once('../config.php');
    global $conn, $dbname, $tbname;
        
    // Sanitize user inputs
    $tit = $conn->real_escape_string($_REQUEST['title']);
    $des = $conn->real_escape_string($_REQUEST['description']);
    $ls = $conn->real_escape_string($_REQUEST['listItem']);
    $user_id = $_COOKIE['User_Id'];
    
    // Prepare an SQL statement for execution
    $stmt = $conn->prepare("INSERT INTO $tbname (Title, Description, ListItem) VALUES (?, ?, ?)");
    if ($stmt === false) die("ERROR: Could not prepare SQL statement. " . $conn->error);
    // Bind parameters to the SQL statement
    $stmt->bind_param("sss", $tit, $des, $ls);
        
    if ($stmt->execute()) {
        //echo "<h3>Data stored in the database successfully.</h3>";
        //echo nl2br("\n$tit\n $des\n $ls");
    }
    else echo "ERROR: Could not execute query. " . $stmt->error;

    $stmt->close();
    $conn->close();
    header('Location: ../templates/Create.php');
    exit;*/
?>

<?php
require_once('../config.php');
global $conn, $tbname;

if (isset($_COOKIE['User_Id'])) {
    if (isset($_REQUEST['title'])) $title = $conn->real_escape_string($_REQUEST['title']);
    else {
        echo "Title is not set.";
        exit;
    }

    $description = isset($_REQUEST['description']) ? $conn->real_escape_string($_REQUEST['description']) : '';
    $listItem = isset($_REQUEST['listItem']) ? $conn->real_escape_string($_REQUEST['listItem']) : '';
    $user_id = $_COOKIE['User_Id'];

    $sql = "INSERT INTO List_Table (Title, Description, ListItem, User_Id) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssi", $title, $description, $listItem, $user_id);
        
        if ($stmt->execute()) echo "List created successfully.";
        else echo "Error: " . $stmt->error;
        $stmt->close();
    }

    $conn->close();
    header('Location: ../templates/Create.php');
    exit;
}
else echo "Please log in to create a list.";
?>