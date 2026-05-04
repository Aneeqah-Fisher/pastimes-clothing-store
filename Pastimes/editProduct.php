<?php
// =========================================
// FILE: editProduct.php
// PURPOSE: Allows admin to update clothing item details
// =========================================

session_start();
include 'DBConn.php';

// Only admin can access this page
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminLogin.php");
    exit();
}

// Get product ID from URL
$itemId = $_GET["id"];

// Get current product details
$sql = "SELECT * FROM tblClothes WHERE item_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $itemId);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

// Update product when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $itemName = trim($_POST["item_name"]);
    $description = trim($_POST["description"]);
    $brand = trim($_POST["brand"]);
    $size = trim($_POST["size"]);
    $condition = trim($_POST["clothing_condition"]);
    $sellPrice = trim($_POST["sell_price"]);
    $quantity = trim($_POST["quantity"]);
    $imageName = trim($_POST["image_name"]);

    $updateSql = "UPDATE tblClothes 
                  SET item_name = ?, description = ?, brand = ?, size = ?, 
                      clothing_condition = ?, sell_price = ?, quantity = ?, image_name = ?
                  WHERE item_id = ?";

    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param(
        "sssssdssi",
        $itemName,
        $description,
        $brand,
        $size,
        $condition,
        $sellPrice,
        $quantity,
        $imageName,
        $itemId
    );

    if ($updateStmt->execute()) {
        header("Location: manageProducts.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Edit Clothing Product</h2>

<form method="POST">

    <label>Item Name:</label><br>
    <input type="text" name="item_name" value="<?php echo $item['item_name']; ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required><?php echo $item['description']; ?></textarea><br><br>

    <label>Brand:</label><br>
    <input type="text" name="brand" value="<?php echo $item['brand']; ?>" required><br><br>

    <label>Size:</label><br>
    <input type="text" name="size" value="<?php echo $item['size']; ?>" required><br><br>

    <label>Condition:</label><br>
    <input type="text" name="clothing_condition" value="<?php echo $item['clothing_condition']; ?>" required><br><br>

    <label>Sell Price:</label><br>
    <input type="number" step="0.01" name="sell_price" value="<?php echo $item['sell_price']; ?>" required><br><br>

    <label>Quantity:</label><br>
    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" required><br><br>

    <label>Image File Name:</label><br>
    <input type="text" name="image_name" value="<?php echo $item['image_name']; ?>" required><br><br>

    <button type="submit">Update Product</button>

</form>

<br>
<a href="manageProducts.php">Back</a>

</body>
</html>