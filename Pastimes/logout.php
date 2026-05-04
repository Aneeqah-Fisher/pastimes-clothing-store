<?php
// =========================================
// FILE: logout.php
// PURPOSE: Logs the user out by clearing session
// =========================================

// Start session
session_start();

// Clear session data
session_unset();

// Destroy session
session_destroy();

// Redirect user back to login page
header("Location: login.php");
exit();
?>