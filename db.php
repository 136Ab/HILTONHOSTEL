<?php
// show clear errors (turn off in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ==== your actual credentials ====
$servername = "localhost";        // change if cPanel shows different host
$username   = "uvr4xjng8qjzg";
$password   = "xj9uwxc8g9xg";
$dbname     = "dbb7zmkeel4p7g";

// ==== connect safely ====
$conn = mysqli_connect($servername, $username, $password, $dbname);

// ==== check connection ====
if (!$conn) {
    echo "<h3 style='color:red'>❌ Database Connection Failed</h3>";
    echo "<b>Error:</b> " . mysqli_connect_error();
    exit();
}

// ==== set charset ====
mysqli_set_charset($conn, "utf8mb4");
?>
