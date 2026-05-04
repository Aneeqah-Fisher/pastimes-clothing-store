<?php
// =========================================
// FILE: deleteUser.php
// PURPOSE: Deletes a user from tblUser
// =========================================

session_start();
include 'DBConn.php';

// Only admin can delete users
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminLogin.php");
    exit();
}

// Get user ID from URL
$userId = $_GET["id"];

// Delete user
$sql = "DELETE FROM tblUser WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

// Return to admin dashboard
header("Location: adminDashboard.php");
exit();
?>