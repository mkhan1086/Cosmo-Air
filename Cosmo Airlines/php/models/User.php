<?php
class User {
    private $conn;
    private $table_name = "users";

    public $userID;
    public $name;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        // Check if the email already exists
        $checkQuery = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(":email", $this->email);
        $checkStmt->execute();

        if ($checkStmt->rowCount() > 0) {
            // Email already exists
            return false;
        }

        // Proceed with user creation
        $query = "INSERT INTO " . $this->table_name . " SET name = :name, email = :email, password = :password";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);  // Hash password

        // Bind parameters
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>