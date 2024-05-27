// _inc/Database.php
<?php
class Database {
    private $conn;

    public function __construct($servername, $username, $password) {
        $this->conn = new mysqli($servername, $username, $password);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function executeQuery($sql, $params, $types) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $this->conn->error);
        }
        $stmt->bind_param($types, ...$params);
        if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
        }
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
