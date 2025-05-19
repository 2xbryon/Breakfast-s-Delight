<?php
// Database connection settings
$host = "peicloud.ca";  // Change this if using a live server
$user = "u188";       // Default for local servers (change if needed)
$pass = "u188";           // Leave empty for local servers (set a password for live servers)
$db = "db188";   // Your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Uncomment this line to test the connection
//echo "Connected successfully";
?>