<?php
// =========================================
// FILE: cart.php
// PURPOSE: Session-based shopping cart
// RUBRIC: AddItem, RemoveItem, ShowCart,
// quantity increase, continue shopping
// =========================================

// Start session to store cart data
session_start();

// Include database connection
include 'DBConn.php';

// Create cart array if it does not exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add item to cart
if (isset($_POST['add_to_cart'])) {

    // Get item ID from products page
    $itemId = $_POST['item_id'];

    // If item already exists, increase quantity
    if (isset($_SESSION['cart'][$itemId])) {
        $_SESSION['cart'][$itemId]++;
    } else {
        // If item is new, add quantity as 1
        $_SESSION['cart'][$itemId] = 1;
    }

    // Redirect back to cart page
    header("Location: cart.php");
    exit();
}

// Remove item from cart
if (isset($_GET['remove'])) {

    // Get item ID to remove
    $removeId = $_GET['remove'];

    // Remove item from session cart
    unset($_SESSION['cart'][$removeId]);

    // Refresh cart page
    header("Location: cart.php");
    exit();
}

// Empty cart
if (isset($_GET['empty'])) {

    // Clear all cart items
    $_SESSION['cart'] = [];

    // Refresh cart page
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pastimes Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">Pastimes</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="products.php">Shop</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section class="cart-section">

    <h2>Your Shopping Cart</h2>
    <p class="cart-intro">Review your selected items before checking out.</p>

    <?php
    if (empty($_SESSION['cart'])) {
        echo "<div class='cart-empty'>";
echo "<p>Your cart is empty.</p>";
echo "<a href='products.php' class='cart-btn'>Continue Shopping</a>";
echo "</div>";
    } else {
    ?>

    <div class="cart-box">

        <table class="cart-table">
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>

            <?php
            $grandTotal = 0;

            foreach ($_SESSION['cart'] as $itemId => $quantity) {

                $sql = "SELECT * FROM tblClothes WHERE item_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $itemId);
                $stmt->execute();
                $result = $stmt->get_result();
                $item = $result->fetch_assoc();

                $lineTotal = $item['sell_price'] * $quantity;
                $grandTotal += $lineTotal;
            ?>

            <tr>
                <td><?php echo $item['item_name']; ?></td>
                <td>R<?php echo number_format($item['sell_price'], 2); ?></td>
                <td><?php echo $quantity; ?></td>
                <td>R<?php echo number_format($lineTotal, 2); ?></td>
                <td>
                    <a class="remove-link" href="cart.php?remove=<?php echo $itemId; ?>">
                        Remove
                    </a>
                </td>
            </tr>

            <?php } ?>

            <tr class="total-row">
                <td colspan="3">Total</td>
                <td>R<?php echo number_format($grandTotal, 2); ?></td>
                <td></td>
            </tr>
        </table>

        <div class="cart-actions">
            <a href="products.php" class="cart-btn">Continue Shopping</a>
            <a href="cart.php?empty=true" class="cart-btn secondary-cart-btn">Empty Cart</a>
            <a href="checkout.php" class="cart-btn checkout-btn">Checkout</a>
        </div>

    </div>

    <?php } ?>

</section>

</body>
</html>