<?php
// =========================================
// FILE: login.php
// PURPOSE: Allows verified users to login
// RUBRIC: Checks username/email and hashed password,
// sticky form, associative fetch, and verified login
// =========================================

// Start session so logged-in user data can be stored
session_start();

// Include database connection
include 'DBConn.php';

// Variables for sticky form and messages
$usernameOrEmail = "";
$message = "";

// Check if login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input from form
    $usernameOrEmail = trim($_POST["usernameOrEmail"]);
    $password = trim($_POST["password"]);

    // Convert entered password to MD5 hash
    // This must match the password_hash stored in tblUser
    $hashedPassword = md5($password);

    // SQL query checks username OR email and password hash
    $sql = "SELECT * FROM tblUser 
            WHERE (username = ? OR email = ?) 
            AND password_hash = ?";

    // Prepare query to prevent SQL injection
    $stmt = $conn->prepare($sql);

    // Bind values to the query
    $stmt->bind_param("sss", $usernameOrEmail, $usernameOrEmail, $hashedPassword);

    // Execute query
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {

        // Fetch user using associative array
        $user = $result->fetch_assoc();

        // Check if admin has verified the user
        if ($user["status"] == "verified") {

            // Store user info in session
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["full_name"] = $user["full_name"];
            $_SESSION["username"] = $user["username"];

            // Success message required by rubric
            $message = "User " . $user["full_name"] . " is logged in";

        } else {
            // User exists but is still pending
            $message = "Your account is pending admin verification.";
        }

    } else {
        // Sticky form works because username/email stays in textbox
        $message = "Incorrect username/email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pastimes Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-container">

    <h2>Pastimes User Login</h2>

    <p class="error"><?php echo $message; ?></p>

    <form method="POST" action="login.php">

        <label>Username or Email</label>
        <input 
            type="text" 
            name="usernameOrEmail" 
            value="<?php echo htmlspecialchars($usernameOrEmail); ?>" 
            required
        >

        <label>Password</label>
        <input 
            type="password" 
            name="password" 
            required
        >

        <button type="submit">Login</button>

    </form>

    <a href="register.php" class="link">Register New Account</a>

</div>

</body>
</html>