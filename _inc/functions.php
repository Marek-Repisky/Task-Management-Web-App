<?php
    function pridatPrvok() {
        echo '<section class="zoznam_riadok">';
        echo '<div class="poradie">1.</div>';
        echo '<textarea class="txtarea" name="ls" id="zoznam" cols="39" rows="1" placeholder="Prvok..."></textarea>';
        echo '</section>';  
    }
    function CreateTable($DbName, $TbName) {
        $servername = "localhost";
        $username = "root";

        // Create connection
        $conn = new mysqli($servername, $username);

        // Check connection
        if ($conn->connect_error) die("Connection failed: " .$conn->connect_error);
        echo "Connected successfully\n";

        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS " .$DbName;
        if ($conn->query($sql) === TRUE) echo "Database" .$DbName. "created successfully";
        else echo "Error creating database " .$DbName. ": " . $conn->error;

        // Use database
        $sql = "USE " .$DbName;
        if ($conn->query($sql) === TRUE) echo "Database " . $DbName . " used successfully";
        else echo "Error using database " . $DbName . ": " . $conn->error;

        // Create table
        $sql = "CREATE TABLE IF NOT EXISTS " .$TbName. " (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Title TEXT NOT NULL,
        Description TEXT NOT NULL,
        ListItem TEXT)";
        
        if ($conn->query($sql) === TRUE) echo "Table" .$TbName. "created successfully";
        else echo "Error creating table " .$TbName. ": " .$conn->error;
        mysqli_close($conn);
    }
    function InsertData($DbName, $TbName) {
        $conn = mysqli_connect("localhost", "root", "", $DbName);
        
        if($conn === false) die("ERROR: Could not connect. " .mysqli_connect_error());
            
        // Taking values from the form data
        $tit =  $_REQUEST['title'];
        $des = $_REQUEST['description'];
        $ls =  $_REQUEST['listItem'];
        
        $sql = "INSERT INTO " .$TbName. " (Title, Description, ListItem) VALUES ('$tit', '$des', '$ls')"; 
            
        if(mysqli_query($conn, $sql)) {
            echo "<h3>data stored in a database successfully."
                . " Please browse your localhost php my admin"
                . " to view the updated data</h3>"; 
    
            echo nl2br("\n$tit\n $des\n " . "$ls");
        } else echo "ERROR: Hush! Sorry $sql. " .mysqli_error($conn);
            
        mysqli_close($conn);
    }

?>