<?php
// =========================================
// FILE: createTable.php
// PURPOSE:
// 1. Drop tblUser if it exists
// 2. Recreate tblUser
// 3. Load data from userData.txt
// =========================================

// Include database connection
include 'DBConn.php';

// Step 1: Drop table if exists
$conn->query("DROP TABLE IF EXISTS tblUser");

// Step 2: Create table again
$createTable = "
CREATE TABLE tblUser (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100),
    username VARCHAR(50),
    password_hash VARCHAR(255),
    status VARCHAR(20)
)";

$conn->query($createTable);

// Step 3: Open text file
$file = fopen("userData.txt", "r");

// Check if file opened successfully
if ($file) {

    // Loop through each line
    while (($line = fgets($file)) !== false) {

        // Split line by comma
        $data = explode(",", trim($line));

        // Assign variables
        $fullName = $data[0];
        $email = $data[1];
        $username = $data[2];
        $passwordHash = $data[3];
        $status = $data[4];

        // Insert into database using prepared statement
        $stmt = $conn->prepare(
            "INSERT INTO tblUser 
            (full_name, email, username, password_hash, status) 
            VALUES (?, ?, ?, ?, ?)"
        );

        // Bind parameters
        $stmt->bind_param("sssss", $fullName, $email, $username, $passwordHash, $status);

        // Execute insert
        $stmt->execute();
    }

    // Close file
    fclose($file);

    echo "User data loaded successfully.";
} else {
    echo "Error opening file.";
}

// Close connection
$conn->close();
?>