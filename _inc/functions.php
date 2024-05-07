<?php
    function pridatFunc($poc) {
        echo '<section class="zoznam_riadok">';
        echo '<div class="poradie">'.$poc.'.</div>';
        echo '<textarea class="txtarea" name="ls" id="zoznam" cols="39" rows="1" placeholder="Prvok..."></textarea>';
        echo '</section>';  
    }
    function CreateTable($DbName, $TbName) {
        // Create connection
        $conn = new mysqli("localhost", "root");

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
    function ReadFromTable($DbName, $TbName) {
        $conn = new mysqli("localhost", "root", "", $DbName);

        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

        $sql = "SELECT Title, Description, ListItem FROM " .$TbName;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<article class="list">';
                echo '<div class="txtarea nadpis">';
                    echo $row["Title"]. "<br>";
                echo '</div>';

                echo '<div class="txtarea opis">';
                    echo $row["Description"]. "<br>";
                echo '</div>';

                echo '<section class="zoznam_riadok">';
                    echo '<div class="poradie">1.</div>';
                    echo '<div class="txtarea zoznam">';
                        echo $row["ListItem"]. "<br>";
                    echo '</div>';
                echo '</section>';
            echo '</article>';
        }
        } else echo "0 results";

        $conn->close();
    }

?>