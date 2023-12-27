<?php
// Check if the search button is clicked
if(isset($_POST['search'])) {
    // Get the search query from the user
    $search_query = $_POST['search_query'];
    
    // Connect to the database
    $conn = mysqli_connect("localhost", "username", "password", "database_name");
    
    // Check if the connection is successful
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Construct the SQL query
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_query%'";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);
    
    // Check if there are any results
    if(mysqli_num_rows($result) > 0) {
        // Display the results
        while($row = mysqli_fetch_assoc($result)) {
            echo "<p>" . $row['product_name'] . "</p>";
        }
    } else {
        echo "No results found.";
    }
    
    // Close the database connection
    mysqli_close($conn);
}
?>

<!-- HTML form for the search input -->
<form method="post" action="search_results.php">
    <input type="text" name="search_query" placeholder="Search for products...">
    <button type="submit" name="search">Search</button>
</form>
