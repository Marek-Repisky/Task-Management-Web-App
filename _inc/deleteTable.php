<?php
    require_once('../config.php');
    global $conn, $dbname, $tbname;
    
    // Sanitize user input
    $updTit = mysqli_real_escape_string($conn, $_REQUEST['UpdatedTitle']);
    
    $sql = "DELETE FROM $tbname WHERE Title=?";
    
    if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $updTit);
        
        if(mysqli_stmt_execute($stmt)) {
            /*echo "<h3>Data deleted from the database successfully.</h3>";*/
        }
        else echo "ERROR: Could not execute $sql. " .mysqli_error($conn);
        
        mysqli_stmt_close($stmt);
    }
    else echo "ERROR: Could not prepare $sql. " .mysqli_error($conn);
    
    mysqli_close($conn);
    header('Location: ../templates/Delete.php');
    exit;
?>
