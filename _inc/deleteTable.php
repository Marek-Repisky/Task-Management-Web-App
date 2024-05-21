<?php
require_once('../config.php');
global $conn, $tbname;

if (isset($_COOKIE['User_Id'])) {
    $user_id = $_COOKIE['User_Id'];
    $updTit = mysqli_real_escape_string($conn, $_REQUEST['UpdatedTitle']);
    
    $sql = "DELETE FROM $tbname WHERE Title=? AND User_Id=?";
    
    if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "si", $updTit, $user_id);
        
        if(mysqli_stmt_execute($stmt)) echo "List deleted successfully.";
        else echo "ERROR: Could not execute $sql. " .mysqli_error($conn);
        
        mysqli_stmt_close($stmt);
    }
    else echo "ERROR: Could not prepare $sql. " .mysqli_error($conn);
}
else echo "Please log in to delete your lists.";

mysqli_close($conn);
header('Location: ../templates/Delete.php');
exit;
?>
