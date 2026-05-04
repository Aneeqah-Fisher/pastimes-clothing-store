<?php
// =========================================
// FILE: manageProducts.php
// PURPOSE: Allows admin to view, edit and delete clothing items
// =========================================

session_start();
include 'DBConn.php';

// Protect page so only admin can access it
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminLogin.php");
    exit();
}

// Get all clothing items from database
$sql = "SELECT * FROM tblClothes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">Pastimes Admin</div>
    <nav>
        <a href="adminDashboard.php">Dashboard</a>
        <a href="addProduct.php">Add Product</a>
        <a href="adminLogout.php">Logout</a>
    </nav>
</header>

<section class="admin-section">

    <h2>Manage Clothing Products</h2>
    <p class="admin-intro">View, update, add or delete clothing items from the store.</p>

    <div class="admin-card">

        <div class="admin-actions-top">
            <a href="addProduct.php" class="cart-btn checkout-btn">Add New Product</a>
        </div>

        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Item Name</th>
                <th>Brand</th>
                <th>Size</th>
                <th>Condition</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>

            <?php while ($item = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $item["item_id"]; ?></td>

                <td>
                    <img class="admin-product-img" 
                         src="images/<?php echo $item["image_name"]; ?>" 
                         alt="<?php echo $item["item_name"]; ?>">
                </td>

                <td><?php echo $item["item_name"]; ?></td>
                <td><?php echo $item["brand"]; ?></td>
                <td><?php echo $item["size"]; ?></td>
                <td><?php echo $item["clothing_condition"]; ?></td>
                <td>R<?php echo number_format($item["sell_price"], 2); ?></td>
                <td><?php echo $item["quantity"]; ?></td>

                <td class="action-links">
                    <a class="edit-link" href="editProduct.php?id=<?php echo $item["item_id"]; ?>">Edit</a>

                    <a class="delete-link"
                       href="deleteProduct.php?id=<?php echo $item["item_id"]; ?>"
                       onclick="return confirm('Are you sure you want to delete this product?');">
                       Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <br>
        <a href="adminDashboard.php" class="cart-btn">Back to Admin Dashboard</a>

    </div>

</section>

</body>
</html>