<?php
class Database {
    private $host = "localhost";        // MySQL host
    private $db_name = "cosmo_airlines"; // Database name
    private $username = "root";         // Database username (default for XAMPP)
    private $password = "";             // Database password (default for XAMPP is empty)
    public $conn;                       // Connection variable

    // Function to get the database connection
    public function getConnection() {
        $this->conn = null;

        // Try to establish the database connection
        try {
            // Establish a PDO connection with utf8 encoding
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");

            // Set PDO error mode to exception for better error handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            // Log the error to a file (change 'error_log.txt' to a secure path)
            error_log("Database connection error: " . $exception->getMessage(), 3, '/path/to/your/error_log.txt');
            
            // Show a user-friendly message (avoid displaying detailed errors in production)
            die("An error occurred while connecting to the database. Please try again later.");
        }

        // Return the database connection
        return $this->conn;
    }
}
?>
