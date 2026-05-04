<?php
// =========================================
// FILE: DBConn.php
// PURPOSE: Connect PHP to MySQL database
// =========================================

// Database server details
$host = "localhost";   // Server name
$user = "root";        // Default XAMPP username
$password = "";        // Default password is empty
$database = "ClothingStore"; // Database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check if connection failed
if ($conn->connect_error) {
    // Stop execution if connection fails
    die("Connection failed: " . $conn->connect_error);
}

// If successful
// echo "Connected successfully"; // (optional for testing)
?>