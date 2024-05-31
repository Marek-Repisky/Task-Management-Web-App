<?php
    require_once('Database.php');

    // Managing to-do list operations
    class ToDoList {
        private $db;
        private $tbname;

        public function __construct($db, $tbname) {
            $this->db = $db;
            $this->tbname = $tbname;
        }

        // Create a new to-do list
        public function createList($title, $description, $listItem, $userId) {
            $sql = "INSERT INTO $this->tbname (Title, Description, ListItem, User_Id) VALUES (?, ?, ?, ?)";
            $params = [$title, $description, $listItem, $userId];
            $this->db->executeQuery($sql, $params, "sssi");
        }

        // Read all to-do lists
        public function readLists($userId) {
            $sql = "SELECT Title, Description, ListItem FROM $this->tbname WHERE User_Id = ?";
            $params = [$userId];
            $stmt = $this->db->executeQuery($sql, $params, "i");
            
            return $this->db->fetchResults($stmt);
        }

        // Update an existing to-do list
        public function updateList($title, $description, $listItem, $updatedTitle, $userId) {
            $sql = "UPDATE $this->tbname SET Title=?, Description=?, ListItem=? WHERE Title=? AND User_Id=?";
            $params = [$title, $description, $listItem, $updatedTitle, $userId];
            $this->db->executeQuery($sql, $params, "ssssi");
        }

        // Delete a to-do list
        public function deleteList($title, $userId) {
            $sql = "DELETE FROM $this->tbname WHERE Title=? AND User_Id=?";
            $params = [$title, $userId];
            $this->db->executeQuery($sql, $params, "si");
        }

        // Get the titles of the to-do lists for a specific user
        public function getTitles($userId) {
            $sql = "SELECT Title FROM $this->tbname WHERE User_Id = ?";
            $params = [$userId];
            $stmt = $this->db->executeQuery($sql, $params, "i");

            return $this->db->fetchResults($stmt);
        }
    }
?>
