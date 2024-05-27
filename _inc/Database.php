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
            $this->connect();
            $this->initializeDatabase();
        }

        private function connect() {
            $this->conn = new mysqli($this->servername, $this->username, $this->password);
            if ($this->conn->connect_error) die("Connection failed: " . $this->conn->connect_error);
        }

        private function initializeDatabase() {
            // Create database if not exists
            $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
            if ($this->conn->query($sql) === FALSE) die("Error creating database: " . $this->conn->error);

            // Select the database
            $this->conn->select_db($this->dbname);

            // Create tables if not exists
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

        public function getConnection() {
            return $this->conn;
        }

        public function executeQuery($sql, $params, $types) {
            $stmt = $this->conn->prepare($sql);
            if ($stmt === false) die("Error preparing statement: " . $this->conn->error);

            $stmt->bind_param($types, ...$params);
            if (!$stmt->execute()) die("Error executing statement: " . $stmt->error);
            
            return $stmt;
        }

        public function fetchResults($stmt) {
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $data;
        }
    }
?>
