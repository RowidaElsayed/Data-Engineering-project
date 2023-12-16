<?php
// Include the database connection
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform a simple query (you should use prepared statements to prevent SQL injection)
    $sql = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        header('Location: index.php'); 
        // Redirect to the dashboard or home page
    } else {
        echo "Login failed. Invalid email or password.";
    }
}

// Close the database connection
$conn->close();
?>
