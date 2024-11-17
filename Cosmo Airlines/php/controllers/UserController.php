<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Include the necessary files
include_once '../config/database.php';  // Path to database.php
include_once '../models/User.php';      // Path to User.php

// Create a new database connection
$database = new Database();
$db = $database->getConnection();

// Initialize User class
$user = new User($db);

// Get form data safely
$user->name = isset($_POST['name']) ? $_POST['name'] : null;
$user->email = isset($_POST['email']) ? $_POST['email'] : null;
$user->password = isset($_POST['password']) ? $_POST['password'] : null;

// Validate input data
if (empty($user->name) || empty($user->email) || empty($user->password)) {
    echo json_encode(array("error" => "All fields (name, email, password) are required."));
    exit;
}

// Create the user and return response
if ($user->create()) {
    echo json_encode(array("success" => "User created successfully"));
} else {
    echo json_encode(array("error" => "Email already exists or could not create user"));
}
?>
