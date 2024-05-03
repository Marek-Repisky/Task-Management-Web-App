<?php
    $conn = mysqli_connect("localhost", "root", "", "ListDatabase");
        
    if($conn === false) die("ERROR: Could not connect. " .mysqli_connect_error());
        
    // Taking values from the form data
    $tit =  $_REQUEST['title'];
    $des = $_REQUEST['description'];
    $ls =  $_REQUEST['listItem'];
    
    $sql = "INSERT INTO ListTable (Title, Description, ListItem) VALUES ('$tit', '$des', '$ls')"; 
        
    if(mysqli_query($conn, $sql)) {
        echo "<h3>data stored in a database successfully."
            . " Please browse your localhost php my admin"
            . " to view the updated data</h3>"; 

        echo nl2br("\n$tit\n $des\n " . "$ls");
    } else echo "ERROR: Hush! Sorry $sql. " .mysqli_error($conn);
    
        
    mysqli_close($conn);
    header('Location: ../index.php');
    exit;
?>