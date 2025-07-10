<?php
session_start(); // Start or resume the session
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session completely

// Optionally redirect to login or home page
header("Location: index.php");
exit;
?>