<?php
    require_once('Database.php');

    class UserAuth {
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }
        public function registerUser($username, $email, $password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
            $params = [$username, $email, $hashed_password];
            $this->db->executeQuery($sql, $params, "sss");
        }
        public function loginUser($email, $password) {
            $sql = "SELECT id, password FROM Users WHERE email = ?";
            $params = [$email];
            $stmt = $this->db->executeQuery($sql, $params, "s");
            $users = $this->db->fetchResults($stmt);

            if (count($users) === 1) {
                $user = $users[0];
                if (password_verify($password, $user['password'])) {
                    setcookie("User_Id", $user['id'], time() + (86400 * 30), "/");
                    return true;
                }
            }
            return false;
        }
        public function logoutUser() {
            setcookie('User_Id', '', time() - 3600, '/');
        }
        public function isAuthenticated() {
            return isset($_COOKIE['User_Id']);
        }
        public function getUserId() {
            return $_COOKIE['User_Id'] ?? null;
        }
    }
?>
