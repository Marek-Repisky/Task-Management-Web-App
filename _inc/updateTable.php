<?php
    $conn = mysqli_connect("localhost", "root", "", "List_Database");
    if($conn === false) die("ERROR: Could not connect. " .mysqli_connect_error());
    
    $updTit =  $_REQUEST['UpdatedTitle'];
    $tit =  $_REQUEST['title'];
    $des = $_REQUEST['description'];
    $ls =  $_REQUEST['listItem'];
    
    $sql = "UPDATE List_Table SET Title= '$tit', Description= '$des', ListItem= '$ls' WHERE Title= '$updTit'";
        
    if(mysqli_query($conn, $sql)) {
        /*echo "<h3>data stored in a database successfully."
            . " Please browse your localhost php my admin"
            . " to view the updated data</h3>"; 

        echo nl2br("\n$tit\n $des\n " . "$ls");*/
    } else echo "ERROR: Hush! Sorry $sql. " .mysqli_error($conn);
        
    mysqli_close($conn);
    header('Location: ../templates/Update.php');
    exit;
?>