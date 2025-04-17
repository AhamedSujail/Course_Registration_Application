<?php
// Database connection
$servername = "localhost";
$username = "root"; // Adjust if different
$password = "";
$dbname = "ATIWEB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>