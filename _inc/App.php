// _inc/App.php
<?php
class ToDoApp {
    private $db;
    private $userAuth;
    private $toDoList;

    public function __construct($dbConfig) {
        $this->db = new Database($dbConfig['servername'], $dbConfig['username'], $dbConfig['password']);
        $this->createDatabaseAndTables();
        $this->userAuth = new UserAuth($this->db);
        $this->toDoList = new ToDoList($this->db, 'List_Table');
    }

    private function createDatabaseAndTables() {
        $conn = $this->db->getConnection();
        $dbname = 'List_Database';
        $tbname = 'List_Table';
        $tb2name = 'Users';

        // Create database if not exists
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $conn->query($sql);

        // Use database
        $conn->select_db($dbname);

        // Create List_Table if not exists
        $sql = "CREATE TABLE IF NOT EXISTS $tbname (
            Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Title TEXT NOT NULL,
            Description TEXT NOT NULL,
            ListItem TEXT,
            User_Id INT(6) UNSIGNED NOT NULL
        )";
        $conn->query($sql);

        // Create Users table if not exists
        $sql = "CREATE TABLE IF NOT EXISTS $tb2name (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";
        $conn->query($sql);
    }

    public function run() {
        // Main logic for running the application
    }

    public function getUserAuth() {
        return $this->userAuth;
    }

    public function getToDoList() {
        return $this->toDoList;
    }
}
?>
