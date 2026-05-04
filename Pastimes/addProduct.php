<?php
// =========================================
// FILE: addProduct.php
// PURPOSE: Allows admin to add a new clothing item
// =========================================

session_start();
include 'DBConn.php';

// Only admin can access this page
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminLogin.php");
    exit();
}

$message = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get product details from form
    $itemName = trim($_POST["item_name"]);
    $description = trim($_POST["description"]);
    $brand = trim($_POST["brand"]);
    $size = trim($_POST["size"]);
    $condition = trim($_POST["clothing_condition"]);
    $sellPrice = trim($_POST["sell_price"]);
    $quantity = trim($_POST["quantity"]);
    $imageName = trim($_POST["image_name"]);

    // Insert product into tblClothes
    $sql = "INSERT INTO tblClothes 
            (item_name, description, brand, size, clothing_condition, sell_price, quantity, image_name)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // s = string, d = decimal, i = integer
    $stmt->bind_param(
        "ssssssis",
        $itemName,
        $description,
        $brand,
        $size,
        $condition,
        $sellPrice,
        $quantity,
        $imageName
    );

    // Check if product was added
    if ($stmt->execute()) {
        $message = "Product added successfully.";
    } else {
        $message = "Error adding product: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">Pastimes Admin</div>
    <nav>
        <a href="adminDashboard.php">Dashboard</a>
        <a href="manageProducts.php">Manage Products</a>
        <a href="adminLogout.php">Logout</a>
    </nav>
</header>

<div class="form-container">

    <h2>Add New Clothing Product</h2>

    <p class="error"><?php echo $message; ?></p>

    <form method="POST" action="addProduct.php">

        <label>Item Name</label>
        <input type="text" name="item_name" required>

        <label>Description</label>
        <textarea name="description" required></textarea>

        <label>Brand</label>
        <input type="text" name="brand" required>

        <label>Size</label>
        <input type="text" name="size" required>

        <label>Condition</label>
        <input type="text" name="clothing_condition" required>

        <label>Sell Price</label>
        <input type="number" step="0.01" name="sell_price" required>

        <label>Quantity</label>
        <input type="number" name="quantity" required>

        <label>Image File Name</label>
        <input type="text" name="image_name" placeholder="example: dress.jpg" required>

        <button type="submit">Add Product</button>

    </form>

    <a href="manageProducts.php" class="link">Back to Manage Products</a>

</div>

</body>
</html>