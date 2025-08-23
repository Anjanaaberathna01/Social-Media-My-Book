<?php
session_start(); // Start the session
if (isset($_SESSION['nextnet_userid'])) {
    $_SESSION['nextnet_userid'] = null; // Clear the session variable
    unset($_SESSION['nexnet_userid']);
} // Unset the session variable

header("Location: ../login/login.php"); // Redirect to login page
die;
?>