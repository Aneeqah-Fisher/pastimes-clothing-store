<?php
// =========================================
// FILE: verifyUser.php
// PURPOSE: Changes a pending user to verified
// =========================================

session_start();
include 'DBConn.php';

// Only admin can verify users
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminLogin.php");
    exit();
}

// Get user ID from URL
$userId = $_GET["id"];

// Update user status to verified
$sql = "UPDATE tblUser SET status = 'verified' WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

// Return to admin dashboard
header("Location: adminDashboard.php");
exit();
?>