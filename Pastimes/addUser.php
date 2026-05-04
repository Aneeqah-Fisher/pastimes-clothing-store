<?php
// =========================================
// FILE: addUser.php
// PURPOSE: Allows admin to add a new user
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

    // Get form data
    $fullName = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $status = $_POST["status"];

    // Hash password before saving
    $passwordHash = md5($password);

    // Insert user into database
    $sql = "INSERT INTO tblUser (full_name, email, username, password_hash, status)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $fullName, $email, $username, $passwordHash, $status);

    if ($stmt->execute()) {
        $message = "User added successfully.";
    } else {
        $message = "Error adding user.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
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

    <h2>Add New User</h2>

    <p class="error"><?php echo $message; ?></p>

    <form method="POST" action="addUser.php">

        <label>Full Name</label>
        <input type="text" name="full_name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Status</label>
        <select name="status">
            <option value="pending">Pending</option>
            <option value="verified">Verified</option>
        </select>

        <button type="submit">Add User</button>

    </form>

    <a href="adminDashboard.php" class="link">Back to Admin Dashboard</a>

</div>

</body>
</html>