<?php
    function redirect_homepage(){
        header("Location: templates/Create.php");
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
            ListItem TEXT
        )";
        
        if ($conn->query($sql) === TRUE) ;//echo "Table" .$tbname. "created successfully";
        else echo "Error creating table " .$tbname. ": " .$conn->error;
        $conn->close();
    }
    function ReadFromTable() {
        require_once('../config.php');
        global $conn, $dbname, $tbname;

        $sql = "SELECT Title, Description, ListItem FROM " .$tbname;
        $result = $conn->query($sql);

        if ($result === false) echo "Error: " . $conn->error;
        else if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<article class="list">';
                echo '<div class="txtarea nadpis">';
                echo htmlspecialchars($row["Title"], ENT_QUOTES, 'UTF-8'). "<br>";
                echo '</div>';

                echo '<div class="txtarea opis">';
                echo htmlspecialchars($row["Description"], ENT_QUOTES, 'UTF-8'). "<br>";
                echo '</div>';

                echo '<section class="zoznam_riadok">';
                echo '<div class="poradie">1.</div>';
                echo '<div class="txtarea zoznam">';

                echo htmlspecialchars($row["ListItem"], ENT_QUOTES, 'UTF-8'). "<br>";
                echo '</div>';
                echo '</section>';
                echo '</article>';
            }
        }
        else echo "Žiadne listy";

        $conn->close();
    }
    function GetTitles() {
        require_once('../config.php');

        $sql = "SELECT Title FROM " .$tbName;
        $result = $conn->query($sql);

        if ($result === false) echo "Error: " . $conn->error;
        else if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $title = htmlspecialchars($row["Title"], ENT_QUOTES, 'UTF-8');
                echo '<option value='. $title  .'>';
            }
        }
        else echo "Žiadne listy";

        $conn->close();
    }
    /*function is_post_request(): bool {
        return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
    }
    function redirect_to(string $url): void {
        header('Location:' . $url);
        exit;
    }

    /**
     * Redirect to a URL with data stored in the items array
     * @param string $url
     * @param array $items
     */
    /*function redirect_with(string $url, array $items): void {
        foreach ($items as $key => $value) $_SESSION[$key] = $value;
        redirect_to($url);
    }*/

    /**
     * Redirect to a URL with a flash message
     * @param string $url
     * @param string $message
     * @param string $type
     */
    /*function redirect_with_message(string $url, string $message, string $type = FLASH_SUCCESS) {
        flash('flash_' . uniqid(), $message, $type);
        redirect_to($url);
    }*/

    /**
     * Flash data specified by $keys from the $_SESSION
     * @param ...$keys
     * @return array
     */
    /*function session_flash(...$keys): array {
        $data = [];
        foreach ($keys as $key) {
            if (isset($_SESSION[$key])) {
                $data[] = $_SESSION[$key];
                unset($_SESSION[$key]);
            }
            else $data[] = [];
        }

        return $data;
    }*/
?>