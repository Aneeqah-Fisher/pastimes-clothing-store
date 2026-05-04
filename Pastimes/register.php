<?php
// =========================================
// FILE: register.php
// PURPOSE: Allows new users to register
// RUBRIC: New users must be added as pending
// until verified by administrator
// =========================================

// Include database connection
include 'DBConn.php';

// Message variable
$message = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form values
    $fullName = trim($_POST["fullName"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirmPassword"]);

    // Check if password is exactly 8 characters
    if (strlen($password) != 8) {
        $message = "Password must be exactly 8 characters.";
    }
    // Check if passwords match
    elseif ($password != $confirmPassword) {
        $message = "Passwords do not match.";
    }
    else {

        // Hash password before saving
        $hashedPassword = md5($password);

        // New users are pending until admin verifies them
        $status = "pending";

        // Insert new user into database
        $sql = "INSERT INTO tblUser 
                (full_name, email, username, password_hash, status) 
                VALUES (?, ?, ?, ?, ?)";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Bind values
        $stmt->bind_param("sssss", $fullName, $email, $username, $hashedPassword, $status);

        // Execute and check result
        if ($stmt->execute()) {
            $message = "Registration successful. Please wait for admin verification before logging in.";
        } else {
            $message = "Registration failed. Username or email may already exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pastimes Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-container">

    <h2>Register for Pastimes</h2>

    <p class="error"><?php echo $message; ?></p>

    <form method="POST" action="register.php">

        <label>Full Name</label>
        <input type="text" name="fullName" required>

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" maxlength="8" minlength="8" required>

        <label>Confirm Password</label>
        <input type="password" name="confirmPassword" maxlength="8" minlength="8" required>

        <button type="submit">Register</button>

    </form>

    <a href="login.php" class="link">Already registered? Login here</a>

</div>

</body>
</html>