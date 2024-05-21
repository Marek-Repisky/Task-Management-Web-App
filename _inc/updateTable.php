<?php
    require_once('../config.php');
    global $conn, $tbname;

    // Check if User_Id cookie is set
    if (isset($_COOKIE['User_Id'])) {
        $user_id = $_COOKIE['User_Id'];
        
        // Prepare SQL query with WHERE clause to filter by title and user_id
        $sql = "UPDATE $tbname SET Title=?, Description=?, ListItem=? WHERE Title=? AND User_Id=?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            $tit = $_REQUEST['title'];
            $des = $_REQUEST['description'];
            $ls = $_REQUEST['listItem'];
            $updTit = $_REQUEST['UpdatedTitle'];
            
            mysqli_stmt_bind_param($stmt, "ssssi", $tit, $des, $ls, $updTit, $user_id);
            
            if (mysqli_stmt_execute($stmt)) echo "List updated successfully.";
            else echo "ERROR: Could not execute $sql. " .mysqli_error($conn);
            
            // Close statement
            mysqli_stmt_close($stmt);
        }
        else echo "ERROR: Could not prepare $sql. " .mysqli_error($conn);
    }
    else echo "Please log in to update your lists.";

    mysqli_close($conn);
    header('Location: ../templates/Update.php');
    exit;
?>

