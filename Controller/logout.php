<?php
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Delete cookies
setcookie('username', '', time() - 3600, '/');
setcookie('role', '', time() - 3600, '/');

// Redirect to index.php after logout
header("Location: ../View/login.html");
exit();
?>
