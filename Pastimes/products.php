<?php
// =========================================
// FILE: products.php
// PURPOSE: Display clothing items from database
// RUBRIC: Must display items using table + array + images
// =========================================

// Start session (needed for cart later)
session_start();

// Include database connection
include 'DBConn.php';

// SQL query to get all clothing items
$sql = "SELECT * FROM tblClothes";

// Execute query
$result = $conn->query($sql);

// Create empty array to store items
$items = [];

// Fetch all rows into array (IMPORTANT for rubric)
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pastimes Shop</title>
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

<section class="shop-section">
    <h2>Available Clothing</h2>
    <p class="shop-intro">Browse quality pre-owned clothing and add your favourites to your cart.</p>

    <div class="product-grid">

        <?php foreach ($items as $item) { ?>

            <div class="product-card">

                <img 
                    src="images/<?php echo $item['image_name']; ?>" 
                    alt="<?php echo $item['item_name']; ?>"
                >

                <div class="product-info">
                    <h3><?php echo $item['item_name']; ?></h3>

<p><?php echo $item['description']; ?></p>

<p><strong>Size:</strong> <?php echo $item['size']; ?></p>

<p><strong>Condition:</strong> <?php echo $item['clothing_condition']; ?></p>

<p><strong>Brand:</strong> <?php echo $item['brand']; ?></p>

<p class="product-price">
    R<?php echo number_format($item['sell_price'], 2); ?>

</p>

                    <form method="POST" action="cart.php" 
                          onsubmit="alert('Item added to cart. Price: R<?php echo number_format($item['sell_price'], 2); ?>');">

                        <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">

                        <button type="submit" name="add_to_cart">
                            Add To Cart
                        </button>

                    </form>
                </div>

            </div>

        <?php } ?>

    </div>

    <a href="cart.php" class="cart-link">Show Cart</a>
</section>

</body>
</html>

<script>
// =========================================
// FUNCTION: showPrice()
// PURPOSE: Show price popup (rubric requirement)
// =========================================
function showPrice(price) {
    alert("Item added to cart. Price: R" + price);
}
</script>

</body>
</html>