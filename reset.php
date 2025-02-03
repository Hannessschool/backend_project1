<?php
session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Clear cookies
if (isset($_COOKIE['first_visit'])) {
    setcookie('first_visit', '', time() - 3600, '/'); // Set the cookie expiration date to a past time
}

// Redirect to the login page or home page
header("Location: projlogin.php");
exit();
?>