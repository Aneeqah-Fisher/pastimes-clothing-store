<?php
// =========================================
// FILE: adminLogin.php
// PURPOSE: Allows admin to login using email and hashed password
// =========================================

session_start();
include 'DBConn.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get admin input
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Hash password using MD5 to match database
    $hashedPassword = md5($password);

    // Check admin details
    $sql = "SELECT * FROM tblAdmin WHERE email = ? AND password_hash = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $hashedPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    // If admin exists, create session
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        $_SESSION["admin_id"] = $admin["admin_id"];
        $_SESSION["admin_name"] = $admin["full_name"];

        header("Location: adminDashboard.php");
        exit();
    } else {
        $message = "Incorrect admin email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pastimes Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-container">

    <h2>Admin Login</h2>

    <p class="error"><?php echo $message; ?></p>

    <form method="POST" action="adminLogin.php">

        <label>Admin Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login as Admin</button>

    </form>

    <a href="index.php" class="link">Back to Home</a>

</div>

</body>
</html>