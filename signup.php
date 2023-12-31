<?php
        include 'db.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];

            // Use prepared statement to prevent SQL injection
            $check_email_query = $conn->prepare("SELECT * FROM customer WHERE email = ?");
            $check_email_query->bind_param("s", $email);
            $check_email_query->execute();
            $check_result = $check_email_query->get_result();

            if ($check_result->num_rows > 0) {
                echo '<p>Email already exists. Please <a href="index.html">login</a>.</p>';
            } else {
                // Insert the user into the database
                $password = ($_POST['password']);
                $insert_query = $conn->prepare("INSERT INTO customer (email, password) VALUES (?, ?)");
                $insert_query->bind_param("ss", $email, $password);

                if ($insert_query->execute()) {
                   header("Location:index.html");
                } else {
                    echo '<p>Database error. Please try again later.</p>';
                }
            }
        }

        
?>