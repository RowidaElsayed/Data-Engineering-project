<?php
// Replace 'your_database_name', 'your_username', 'your_password' with your actual database details
include 'config.php';
$servername = "localhost";
$email = "root";
$password = "";
$dbname = "groceryw_project";

// Create connection
$conn = new mysqli($servername, $email, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
