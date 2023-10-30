<?php
$allowed_ip_range = ""; // Replace with your Wi-Fi network's IP range.

// Get the user's IP address.
$user_ip = $_SERVER['REMOTE_ADDR'];

if (strpos($user_ip, $allowed_ip_range) !== 0) {
    // User's IP is not in the allowed range, deny access.
    die("Access denied. Please connect to the authorized Wi-Fi network.");
}
?>