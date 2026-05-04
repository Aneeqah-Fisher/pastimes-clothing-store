<?php
// =========================================
// FILE: loadClothingStore.php
// PURPOSE:
// This script recreates all main tables for the ClothingStore database.
// It drops old tables first, then creates fresh tables and inserts sample data.
// =========================================

// Include the database connection file
include 'DBConn.php';

// Drop tables in the correct order because of foreign key relationships
$conn->query("DROP TABLE IF EXISTS tblOrderLine");
$conn->query("DROP TABLE IF EXISTS tblOrder");
$conn->query("DROP TABLE IF EXISTS tblClothes");
$conn->query("DROP TABLE IF EXISTS tblAdmin");
$conn->query("DROP TABLE IF EXISTS tblUser");

// Create tblUser table
$sqlUser = "
CREATE TABLE tblUser (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    status ENUM('pending', 'verified') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sqlUser);

// Create tblAdmin table
$sqlAdmin = "
CREATE TABLE tblAdmin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
)";
$conn->query($sqlAdmin);

// Create tblClothes table
$sqlClothes = "
CREATE TABLE tblClothes (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    brand VARCHAR(100),
    size VARCHAR(20),
    clothing_condition VARCHAR(50),
    sell_price DECIMAL(10,2) NOT NULL,
    quantity INT DEFAULT 1,
    image_name VARCHAR(255)
)";
$conn->query($sqlClothes);

// Create tblOrder table
$sqlOrder = "
CREATE TABLE tblOrder (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2),
    status VARCHAR(50) DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES tblUser(user_id)
)";
$conn->query($sqlOrder);

// Create tblOrderLine table
$sqlOrderLine = "
CREATE TABLE tblOrderLine (
    order_line_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES tblOrder(order_id),
    FOREIGN KEY (item_id) REFERENCES tblClothes(item_id)
)";
$conn->query($sqlOrderLine);

// Insert admin account
$conn->query("
INSERT INTO tblAdmin (full_name, email, password_hash)
VALUES ('Admin User', 'admin@pastimes.co.za', MD5('admin1234'))
");

// Insert sample users
$conn->query("
INSERT INTO tblUser (full_name, email, username, password_hash, status)
VALUES
('John Doe', 'john@example.com', 'johndoe', MD5('password'), 'verified'),
('Mary Smith', 'mary@example.com', 'marysmith', MD5('password'), 'pending'),
('Aisha Khan', 'aisha@example.com', 'aishak', MD5('password'), 'verified'),
('Thabo Mokoena', 'thabo@example.com', 'thabom', MD5('password'), 'pending'),
('Lisa Adams', 'lisa@example.com', 'lisaa', MD5('password'), 'verified')
");

// Insert sample clothing items
$conn->query("
INSERT INTO tblClothes 
(item_name, description, brand, size, clothing_condition, sell_price, quantity, image_name)
VALUES
('Denim Jacket', 'Blue denim jacket in good condition.', 'Levis', 'M', 'Good', 250.00, 3, 'denim.jpg'),
('Summer Dress', 'Floral summer dress, lightly worn.', 'Zara', 'S', 'Excellent', 180.00, 2, 'dress.jpg'),
('White Sneakers', 'Comfortable pre-owned sneakers.', 'Nike', '7', 'Good', 300.00, 4, 'shoes.jpg'),
('Black Jeans', 'Slim fit black jeans.', 'H&M', '32', 'Good', 200.00, 5, 'jeans.jpg'),
('Formal Shirt', 'Formal shirt suitable for work.', 'Cotton On', 'L', 'Excellent', 150.00, 3, 'shirt.jpg')
");

// Show success message
echo "<h2>ClothingStore tables created successfully.</h2>";
echo "<p>Sample users, admin account, and clothing items were inserted.</p>";
echo "<p><strong>Admin login:</strong> admin@pastimes.co.za / admin1234</p>";
echo "<p><strong>User login:</strong> johndoe / password</p>";
echo "<a href='index.php'>Go to Home Page</a>";

// Close database connection
$conn->close();
?>