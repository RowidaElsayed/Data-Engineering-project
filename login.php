<?php
// Include the database connection
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM customer WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Start a session and store user data
        session_start();
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user['user_id']; // replace 'id' with your actual column name for user id in your 'customer' table
        // Redirect to the home page or dashboard
        header('Location: index.php'); 
    } else {
            header('Location: signup.html'); 
    }
}

// Close the database connection
$conn->close();
?>