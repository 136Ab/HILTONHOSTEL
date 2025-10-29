<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";   // Replace with your correct host
$username   = "unuw9ry46la8t";  // Replace with your correct user
$password   = "4cgdhp7dokz1";   // Replace with your correct password
$dbname     = "dbhcpehmopilyy"; // Replace with your correct database

$conn = @new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Database connected successfully!";
}
?>
