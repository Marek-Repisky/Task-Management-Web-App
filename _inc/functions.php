<?php
    function redirect_homepage(){
        header("Location: templates/LoginForm.php");
        die("Nepodarilo sa nájsť Domovskú stránku");
    }
    function pridatFunc($poc) {
        echo '<section class="zoznam_riadok">';
        echo '<div class="poradie">'.$poc.'.</div>';
        echo '<textarea class="txtarea" name="ls" id="zoznam" cols="39" rows="1" placeholder="Prvok..."></textarea>';
        echo '</section>';  
    }
    function CreateTable() {
        require_once('../config.php');
        global $conn, $dbname, $tbname;

        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS " .$dbname;
        if ($conn->query($sql) === TRUE) ;//echo "Database" .$dbname. "created successfully";
        else echo "Error creating database " .$dbname. ": " . $conn->error;

        // Use database
        $sql = "USE " .$dbname;
        if ($conn->query($sql) === TRUE) ;//echo "Database " .$dbname. " used successfully";
        else echo "Error using database " .$dbname. ": " . $conn->error;

        // Create table
        $sql = "CREATE TABLE IF NOT EXISTS " .$tbname. " (
            Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Title TEXT NOT NULL,
            Description TEXT NOT NULL,
            ListItem TEXT,
            User_Id INT(6) UNSIGNED NOT NULL
        )";
        
        if ($conn->query($sql) === TRUE) ;//echo "Table" .$tbname. "created successfully";
        else echo "Error creating table " .$tbname. ": " .$conn->error;
        $conn->close();
    }
    function ReadFromTable() {
        require_once('../config.php');
        global $conn, $tbname;
    
        if (isset($_COOKIE['User_Id'])) {
            $user_id = $_COOKIE['User_Id'];
    
            $sql = "SELECT Title, Description, ListItem FROM $tbname WHERE User_Id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
    
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<article class="list">';
                        echo '<div class="txtarea nadpis">';
                        echo htmlspecialchars($row["Title"], ENT_QUOTES, 'UTF-8') . "<br>";
                        echo '</div>';
    
                        echo '<div class="txtarea opis">';
                        echo htmlspecialchars($row["Description"], ENT_QUOTES, 'UTF-8') . "<br>";
                        echo '</div>';
    
                        echo '<section class="zoznam_riadok">';
                        echo '<div class="poradie">1.</div>';
                        echo '<div class="txtarea zoznam">';
                        echo htmlspecialchars($row["ListItem"], ENT_QUOTES, 'UTF-8') . "<br>";
                        echo '</div>';
                        echo '</section>';
                        echo '</article>';
                    }
                }
                else echo "Žiadne listy";
                $stmt->close();
            } 
            else echo "Error: " . $conn->error;
        }
        else echo "Prihláste sa prosím aby ste videli vaše listy.";
        $conn->close();
    }
    function GetTitles() {
        require_once('../config.php');
        global $tbname;
    
        if (isset($_COOKIE['User_Id'])) {
            $user_id = $_COOKIE['User_Id'];
    
            $sql = "SELECT Title FROM $tbname WHERE User_Id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
    
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $title = htmlspecialchars($row["Title"], ENT_QUOTES, 'UTF-8');
                        echo '<option value="' . $title . '">';
                    }
                }
                else echo "Žiadne listy nenajdené.";
                $stmt->close();
            } 
            else echo "Error: " . $conn->error;
        }
        $conn->close();
    }
?>