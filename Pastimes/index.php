<?php
// =========================================
// FILE: index.php
// PURPOSE: Homepage for the Pastimes second-hand clothing store
// =========================================

// Start session so we can check if a user is logged in
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Makes the website responsive on phones and tablets -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pastimes | Second-Hand Clothing Store</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigation bar -->
<header class="navbar">
    <div class="logo">Pastimes</div>

    <nav>
        <a href="index.php">Home</a>
        <a href="products.php">Shop</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="adminLogin.php">Admin</a>
    </nav>
</header>

<!-- Hero section -->
<section class="hero">
    <div class="hero-content">
        <h1>Give Fashion a Second Life</h1>

        <p>
            Pastimes is an online store for buying and selling quality pre-owned branded clothing.
            Shop affordable fashion while supporting sustainable choices.
        </p>

        <div class="hero-buttons">
            <a href="products.php" class="btn primary-btn">Shop Now</a>
            <a href="register.php" class="btn secondary-btn">Start Selling</a>
        </div>
    </div>
</section>

<!-- Website goals section -->
<section class="goals">
    <h2>Why Choose Pastimes?</h2>

    <div class="goal-container">

        <div class="goal-card">
            <h3>Affordable Fashion</h3>
            <p>Buy branded clothing at lower prices.</p>
        </div>

        <div class="goal-card">
            <h3>Sustainable Shopping</h3>
            <p>Reduce waste by giving clothes a second chance.</p>
        </div>

        <div class="goal-card">
            <h3>Easy Selling</h3>
            <p>Registered sellers can request to sell their clothing online.</p>
        </div>

    </div>
</section>

<!-- Featured categories section -->
<section class="categories">
    <h2>Popular Categories</h2>

    <div class="category-container">
        <div class="category-card">Jackets</div>
        <div class="category-card">Dresses</div>
        <div class="category-card">Shoes</div>
        <div class="category-card">Jeans</div>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2026 Pastimes Clothing Store. Created for WEDE6021 POE.</p>
</footer>

</body>
</html>