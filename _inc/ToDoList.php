<?php
require_once('Database.php');

class ToDoList {
    private $db;
    private $tbname;

    public function __construct($db, $tbname) {
        $this->db = $db;
        $this->tbname = $tbname;
    }

    public function createList($title, $description, $listItem, $userId) {
        $sql = "INSERT INTO $this->tbname (Title, Description, ListItem, User_Id) VALUES (?, ?, ?, ?)";
        $params = [$title, $description, $listItem, $userId];
        $this->db->executeQuery($sql, $params, "sssi");
    }

    public function readLists($userId) {
        $sql = "SELECT Title, Description, ListItem FROM $this->tbname WHERE User_Id = ?";
        $params = [$userId];
        $stmt = $this->db->executeQuery($sql, $params, "i");
        return $this->db->fetchResults($stmt);
    }

    public function updateList($title, $description, $listItem, $updatedTitle, $userId) {
        $sql = "UPDATE $this->tbname SET Title=?, Description=?, ListItem=? WHERE Title=? AND User_Id=?";
        $params = [$title, $description, $listItem, $updatedTitle, $userId];
        $this->db->executeQuery($sql, $params, "ssssi");
    }

    public function deleteList($title, $userId) {
        $sql = "DELETE FROM $this->tbname WHERE Title=? AND User_Id=?";
        $params = [$title, $userId];
        $this->db->executeQuery($sql, $params, "si");
    }

    public function getTitles($userId) {
        $sql = "SELECT Title FROM $this->tbname WHERE User_Id = ?";
        $params = [$userId];
        $stmt = $this->db->executeQuery($sql, $params, "i");
        return $this->db->fetchResults($stmt);
    }
}
?>
