<?php
    class Database {
        private $servername;
        private $username;
        private $password;
        private $dbname;
        private $tbname;
        private $tb2name;
        private $conn;

        public function __construct($servername, $username, $password, $dbname, $tbname, $tb2name) {
            $this->servername = $servername;
            $this->username = $username;
            $this->password = $password;
            $this->dbname = $dbname;
            $this->tbname = $tbname;
            $this->tb2name = $tb2name;
            // Connect to the database
            $this->connect();
            $this->initializeDatabase();
        }

        // Establish a connection to the MySQL server
        private function connect() {
            $this->conn = new mysqli($this->servername, $this->username, $this->password);
            if ($this->conn->connect_error) die("Connection failed: " . $this->conn->connect_error);
        }

        // Initialize the database and the tables if they don't exist
        private function initializeDatabase() {
            $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
            if ($this->conn->query($sql) === FALSE) die("Error creating database: " . $this->conn->error);

            $this->conn->select_db($this->dbname);

            $createListTable = "CREATE TABLE IF NOT EXISTS $this->tbname (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                Title VARCHAR(255) NOT NULL,
                Description TEXT,
                ListItem TEXT,
                User_Id INT(6) UNSIGNED NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            if ($this->conn->query($createListTable) === FALSE) die("Error creating table: " . $this->conn->error);

            $createUsersTable = "CREATE TABLE IF NOT EXISTS $this->tb2name (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL,
                email VARCHAR(50) NOT NULL,
                password VARCHAR(255) NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            if ($this->conn->query($createUsersTable) === FALSE) die("Error creating table: " . $this->conn->error);
        }

        // Get the database connection
        public function getConnection() {
            return $this->conn;
        }

        // Execute a prepared SQL query
        public function executeQuery($sql, $params, $types) {
            $stmt = $this->conn->prepare($sql);
            if ($stmt === false) die("Error preparing statement: " . $this->conn->error);

            // Bind the parameters
            $stmt->bind_param($types, ...$params);
            if (!$stmt->execute()) die("Error executing statement: " . $stmt->error);

            // Return the statement object for further processing
            return $stmt;
        }

        // Fetch results from a executed statement
        public function fetchResults($stmt) {
            // Get the result set from the statement
            $result = $stmt->get_result();
            // Fetch all rows as an associative array
            $data = $result->fetch_all(MYSQLI_ASSOC);
            
            $stmt->close();
            return $data;
        }
    }
?>
