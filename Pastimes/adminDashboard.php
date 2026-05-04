<?php
// =========================================
// FILE: adminDashboard.php
// PURPOSE: Admin dashboard to verify, view and delete users
// RUBRIC: Admin must verify users and manage users
// =========================================

session_start();
include 'DBConn.php';

// Protect page from non-admin users
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminLogin.php");
    exit();
}

// Get all users from database
$sql = "SELECT * FROM tblUser ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pastimes Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">Pastimes Admin</div>

    <nav>
        <a href="index.php">Home</a>
        <a href="manageProducts.php">Manage Products</a>
        <a href="addUser.php">Add User</a>
        <a href="adminLogout.php">Logout</a>
    </nav>
</header>

<section class="admin-section">

    <h2>Admin Dashboard</h2>
    <p class="admin-intro">Welcome, <?php echo $_SESSION["admin_name"]; ?>. Manage users and verify new customer registrations.</p>

    <div class="admin-card">

        <h3>User Management</h3>

        <table class="admin-table">
           <?php while ($user = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $user["user_id"]; ?></td>
    <td><?php echo $user["full_name"]; ?></td>
    <td><?php echo $user["email"]; ?></td>
    <td><?php echo $user["username"]; ?></td>

    <td>
        <span class="<?php echo $user["status"] == 'verified' ? 'status-verified' : 'status-pending'; ?>">
            <?php echo ucfirst($user["status"]); ?>
        </span>
    </td>

    <td class="action-links">
        <?php if ($user["status"] == "pending") { ?>
            <a class="verify-link" href="verifyUser.php?id=<?php echo $user["user_id"]; ?>">Verify</a>
        <?php } ?>

        <a class="edit-link" href="editUser.php?id=<?php echo $user["user_id"]; ?>">Edit</a>

        <a class="delete-link"
           href="deleteUser.php?id=<?php echo $user["user_id"]; ?>"
           onclick="return confirm('Are you sure?');">
           Delete
        </a>
    </td>
</tr>
<?php } ?>
        
        </table>

    </div>

</section>

</body>
</html>