<?php
    require_once('../config.php');
    global $conn, $dbname, $tbname;
    
    $sql = "UPDATE $tbname SET Title=?, Description=?, ListItem=? WHERE Title=?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $tit, $des, $ls, $updTit);
        
        $tit = $_REQUEST['title'];
        $des = $_REQUEST['description'];
        $ls = $_REQUEST['listItem'];
        $updTit = $_REQUEST['UpdatedTitle'];
        
        if (mysqli_stmt_execute($stmt)) {
            /*echo "<h3>data stored in a database successfully.</h3>"; 
            echo nl2br("\n$tit\n $des\n " . "$ls");*/
        }
        else echo "ERROR: Could not execute $sql. " .mysqli_error($conn);
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    else echo "ERROR: Could not prepare $sql. " .mysqli_error($conn);
    
    // Close connection
    mysqli_close($conn);
    header('Location: ../templates/Update.php');
    exit;
?>
