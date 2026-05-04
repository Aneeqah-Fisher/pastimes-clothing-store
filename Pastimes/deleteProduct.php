<?php
// =========================================
// FILE: deleteProduct.php
// PURPOSE: Allows admin to delete a clothing item
// =========================================

session_start();
include 'DBConn.php';

// Only admin can delete products
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminLogin.php");
    exit();
}

// Get product ID from URL
$itemId = $_GET["id"];

// Delete selected product
$sql = "DELETE FROM tblClothes WHERE item_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $itemId);
$stmt->execute();

// Return to manage products page
header("Location: manageProducts.php");
exit();
?>