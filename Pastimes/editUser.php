<?php
// =========================================
// FILE: editUser.php
// PURPOSE: Allows admin to update user details
// =========================================

session_start();
include 'DBConn.php';

// Only admin can access this page
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminLogin.php");
    exit();
}

// Get user ID from URL
$userId = $_GET["id"];

// Get current user details
$sql = "SELECT * FROM tblUser WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$message = "";

// Update user when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullName = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $status = $_POST["status"];

    $updateSql = "UPDATE tblUser 
                  SET full_name = ?, email = ?, username = ?, status = ?
                  WHERE user_id = ?";

    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssi", $fullName, $email, $username, $status, $userId);

    if ($updateStmt->execute()) {
        header("Location: adminDashboard.php");
        exit();
    } else {
        $message = "Error updating user.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Edit User</h2>

<p><?php echo $message; ?></p>

<form method="POST">
    <label>Full Name:</label><br>
    <input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="pending" <?php if ($user['status'] == 'pending') echo 'selected'; ?>>Pending</option>
        <option value="verified" <?php if ($user['status'] == 'verified') echo 'selected'; ?>>Verified</option>
    </select><br><br>

    <button type="submit">Update User</button>
</form>

<br>
<a href="adminDashboard.php">Back</a>

</body>
</html>