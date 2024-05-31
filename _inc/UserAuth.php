<?php
    require_once('Database.php');

    //  Managing user authentication
    class UserAuth {
        private $db;

        // Initialize the database connection
        public function __construct($db) {
            $this->db = $db;
        }

        // Register a new user
        public function registerUser($username, $email, $password) {
            // Hash the password using bcrypt algorithm
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // SQL query to insert a new user into the database
            $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
            // Parameters for the query
            $params = [$username, $email, $hashed_password];
            // Execute the query with the provided parameters and data types
            $this->db->executeQuery($sql, $params, "sss");
        }

        // Authenticate the user
        public function loginUser($email, $password) {
            $sql = "SELECT id, password FROM Users WHERE email = ?";
            $params = [$email];
            $stmt = $this->db->executeQuery($sql, $params, "s");
            $users = $this->db->fetchResults($stmt);

            // Check if a user with the provided email exists and verify the password
            if (count($users) === 1) {
                $user = $users[0];
                if (password_verify($password, $user['password'])) {
                    // Set a cookie with the user ID for authentication
                    setcookie("User_Id", $user['id'], time() + (86400 * 30), "/");
                    return true;
                }
            }
            return false;
        }

        // Log out the user by clearing the authentication cookie
        public function logoutUser() {
            setcookie('User_Id', '', time() - 3600, '/');
        }

        // Check if a user is authenticated
        public function isAuthenticated() {
            return isset($_COOKIE['User_Id']);
        }

        // Get the user ID
        public function getUserId() {
            return $_COOKIE['User_Id'] ?? null;
        }
    }
?>
