<?php
// =========================================
// FILE: checkout.php
// PURPOSE: Checkout cart, save order to database,
// reduce stock quantity, show order reference,
// and empty cart after checkout
// =========================================

// Start session so cart and user data can be used
session_start();

// Include database connection
include 'DBConn.php';

// If cart does not exist or is empty, stop checkout
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Your cart is empty. <a href='products.php'>Continue Shopping</a>");
}

// If user is not logged in, send them to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please login before checkout");
    exit();
}

// Get logged-in user ID
$userId = $_SESSION['user_id'];

// Create order reference number
$orderRef = "ORD" . time();

// Set total amount to zero before calculation
$grandTotal = 0;

// First calculate total amount
foreach ($_SESSION['cart'] as $itemId => $quantity) {

    // Get item price from database
    $sql = "SELECT sell_price FROM tblClothes WHERE item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    // Add item total to grand total
    $grandTotal += $item['sell_price'] * $quantity;
}

// Insert order into tblOrder
$sqlOrder = "INSERT INTO tblOrder (user_id, total_amount, status) VALUES (?, ?, 'Pending')";
$stmtOrder = $conn->prepare($sqlOrder);
$stmtOrder->bind_param("id", $userId, $grandTotal);
$stmtOrder->execute();

// Get newly created order ID
$orderId = $conn->insert_id;

// Insert each cart item into tblOrderLine
foreach ($_SESSION['cart'] as $itemId => $quantity) {

    // Get item price
    $sqlItem = "SELECT sell_price, quantity FROM tblClothes WHERE item_id = ?";
    $stmtItem = $conn->prepare($sqlItem);
    $stmtItem->bind_param("i", $itemId);
    $stmtItem->execute();
    $resultItem = $stmtItem->get_result();
    $item = $resultItem->fetch_assoc();

    // Store price at purchase time
    $price = $item['sell_price'];

    // Insert order line
    $sqlLine = "INSERT INTO tblOrderLine (order_id, item_id, quantity, price)
                VALUES (?, ?, ?, ?)";
    $stmtLine = $conn->prepare($sqlLine);
    $stmtLine->bind_param("iiid", $orderId, $itemId, $quantity, $price);
    $stmtLine->execute();

    // Decrease clothing quantity after purchase
    $sqlUpdateQty = "UPDATE tblClothes 
                     SET quantity = quantity - ? 
                     WHERE item_id = ?";
    $stmtQty = $conn->prepare($sqlUpdateQty);
    $stmtQty->bind_param("ii", $quantity, $itemId);
    $stmtQty->execute();
}

// Empty cart after checkout
$_SESSION['cart'] = [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout Complete</title>
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

<section class="checkout-section">

    <div class="checkout-card">

        <h2>Checkout Complete</h2>

        <p class="success-message">Your order has been placed successfully.</p>

        <div class="checkout-details">
            <p><strong>Order Number:</strong> <?php echo $orderId; ?></p>
            <p><strong>Reference Number:</strong> <?php echo $orderRef; ?></p>
            <p><strong>Session ID:</strong> <?php echo session_id(); ?></p>
            <p><strong>Total Paid:</strong> R<?php echo number_format($grandTotal, 2); ?></p>
        </div>

        <a href="products.php" class="checkout-btn-link">Continue Shopping</a>

    </div>

</section>

</body>
</html>