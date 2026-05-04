<?php
// =========================================
// FILE: adminLogout.php
// PURPOSE: Logs admin out
// =========================================

session_start();
session_unset();
session_destroy();

header("Location: adminLogin.php");
exit();
?>