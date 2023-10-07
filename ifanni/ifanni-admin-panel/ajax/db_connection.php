<?php
// Database configuration
$hostname = "localhost"; // Replace with your MySQL server hostname (e.g., "localhost")
$username = "auzziech_ifanni"; // Replace with your MySQL username
$password = "ifanni1234567890!"; // Replace with your MySQL password
$database = "auzziech_ifanni"; // Replace with your MySQL database name

// Create a database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8 (optional, adjust as needed)
if (!$conn->set_charset("utf8")) {
    die("Error setting charset to UTF-8: " . $conn->error);
}
?>
