<?php
// Connect to the database
include 'dp.php';

// Check if the search button is clicked
if(isset($_GET['search'])) {
    // Get the search query from the user
    $search_query = $_GET['search'];

    // Check if the connection is successful
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Construct the SQL query
    $sql = "SELECT * FROM products WHERE name LIKE '%$search_query%'";

    // Execute the query
    $result = mysqli_query($con, $sql);

    // Check if there are any results 
    if(mysqli_num_rows($result) > 0) {
        // Display the results
        while($row = mysqli_fetch_assoc($result)) {
            echo "<p>" . $row['name'] . "</p>";
        }
    } else {
        echo "No results found.";
    }

    // Close the database connection
    mysqli_close($con);
}
?>
