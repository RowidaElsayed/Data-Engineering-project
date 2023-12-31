<?php
include 'db.php';

// Start the session
// Check if the user is logged in

if (isset($_SESSION["user_id"])) {
    // Retrieve user data from the session
    $user_id = $_SESSION["user_id"];
} else {
    // Redirect the user to the login page if they are not logged in
    header('Location: index.html');
}
// Include functions and connect to the database using PDO MySQL
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM products LIMIT 6');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$max_discount = 0;

?>
<DOCTYPE html>

<html>
    
        <head>
    
        <meta charset="utf-8">
    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!--==Title==================================-->
        <title>
    
            RONO Grocery Store
    
        </title>
    
        <!--==Stylesheet=============================-->
        <link rel="stylesheet" type="text/css" href="Home Page CSS.css">
    
        <!--==Fav-icon===============================-->
        <link rel="shortcut icon" href="images/fav-icon.png"/>
    
        <!--==Using-Font-Awesome=====================-->
        <script src="https://kit.fontawesome.com/5471644867.js" crossorigin="anonymous"></script>
                
       <link rel="shortcut icon" type="image/jpg" href="C:\Users\hp\Desktop\College\First Semester\Introduction To Web Technologies\Notepad ++ Files\Project\favicon.ico"/>
    
        </head>
    
        <body>
    
            <!--==Navigation================================-->
            <nav class="navigation">
    
                <!--logo-------->
                <a href="#" class="logo">
    
                    <span>RO</span>NO
    
                </a>
    
                <!--menu-btn---->
                <input type="checkbox" class="menu-btn" id="menu-btn">
    
                <label for="menu-btn" class="menu-icon">
    
                    <span class="nav-icon"></span>
    
                </label>
    
                <!--menu-------->
                <ul class="menu">
    
                    <li>
                        <a href="index.php" class="active">
                            
                            Home
    
                        </a>
                    
                    </li>
    
                    <li>
    
                        <a href="products.php">
    
                            Products
                        
                        </a>
                    
                    </li>
                     <li>
    
                        <a href="Nationaility.php">
    
                            Egyptain Products
                        
                        </a>
                    
                    </li>
    
                    <li>
                    
                    </li>
    
                    <li>
                        
                        <a href="signup.html">
                                
                            Sign&nbsp;up
                            
                        </a>
                        
                    </li>
    
                    
                    <li>
                        
                        <a href="index.html">
                            
                            Login
                        
                        </a>
                    <li>
                    <li>
                        <a href="logout.php">
                            Logout
                        
                        </a>
                    
                    </li>
    
                    </ul>
    
                <!--right-nav-(cart-like)-->
                <div class="right-nav">
    
                    
                    <!--cart----->
                    <a href="index.php?page=cart" class="cart">
    
                        <i class="fas fa-shopping-cart"></i>
                        <img src="https://cdn-icons-png.flaticon.com/512/1413/1413908.png" style="width:30px;height:30px;">
    
    
                    </a>
    
    
                </div>
    
            </nav>
    
            <!--nav-end--------------------->
            <!--==Search-banner=======================================-->
            <section id="search-banner">
    
                <!--bg--------->
                <img alt="bg" class="bg-1" src="v.png">
    
                <img alt="bg" class="bg-1_rev" src="v.png" >
    
    
                <!--text------->
                <div class="search-banner-text">
    
                    <h1>
                        
                        Order Your Groceries,All you need
                    
                    </h1>
    
    
                    <!--search-box------>
                    <form action="search_results.php" class="search-box" >
    
                        <!--icon------>
                        <i class="fas fa-search"></i>
    
                        <!--input----->
                        <input type="text" class="search-input" placeholder="Search" name="search" size = "80px" required>
    
                        <!--btn------->
                        <input type="submit" class="search-btn" value="Search">
    
                    </form>

                    <br>
     			 <!--filter-box------>
                  <form action="filter.php" class="filter-box">
                  <input type="submit" class="filter-btn" style="
                    background-color: #90EE90; /* Green background */
                    color: white; /* White text */
                    border: none; /* Remove default border */
                    padding: 10px 20px; /* Adjust padding as needed */
                    text-align: center; /* Center text */
                    border-radius: 5px; /* Rounded corners */
                    cursor: pointer; /* Hand cursor on hover */
                  " value="Apply filters here">
                </form>
    
                </div>
 
    
            </section>
    
            <!--search-banner-end--------------->
    
        <h2 class = 'sale-heading'>
    
                Flash sale started In 
    
            </h2>
    
            <div class="countdown-container">
    
                <p class="big-text" id="countdown"></p>

                <script>
                // Set the date we're counting down to
                // Get today's date
                var now = new Date();
                var dayOfWeek = now.getDay();

                // Set the date we're counting down to
                var countDownDate = new Date();

                // If it's not Thursday or Friday, set countdown to the next Thursday
                if (dayOfWeek != 4 && dayOfWeek != 5) {
                    countDownDate.setDate(now.getDate() + ((4 + 7 - dayOfWeek) % 7));
                }

                // Set the countdown time
                countDownDate.setHours(23, 59, 59);

                // Update the count down every 1 second
                var countdownfunction = setInterval(function() {

                    // Get today's date and time
                    now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with id="countdown"
                    document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                    // If the count down is finished, write some text 
                    if (distance < 0) {
                        clearInterval(countdownfunction);
                        document.getElementById("countdown").innerHTML = "EXPIRED";
                    }
				}, 1000);
                </script>

                    
            </div>
            <!--==Products====================================-->
            <section id="popular-product">
            <!-- Heading -->
            <div class="product-heading">
                <h3>Don't miss our sales</h3>
            </div>
            <!-- Product Container -->
            <div class="product-container">
   <!-- Product Boxes -->
                <?php
                foreach ($products as $product) {
                    if ($product['discount'] >= $max_discount) {
                ?>
                        <div class="product-box">
                            <a href="index.php?page=product&pid=<?=$product['pid']?>" class="product-link">
                                <img src="imgs/<?=$product['img']?>" alt="<?=$product['name']?>" class="product-image">
                                <span class="product-name"><?=$product['name']?></span>
                                
                            </a>
                        </div>
                <?php
                    }
                }
                ?>
            </section>
  
            <!--==Footer=============================================-->
            <footer>
                <div class="footer-container">
                    <!--logo-container------>
                    <div class="footer-logo">
                        <a href="file:///C:/Users/RAGHAV/Desktop/Coding/Grocery/Logo.png"><span>RO</span>NO</a>
                  
                <!--links-------------------------->
                <div class="footer-links">
                    <strong>Contact</strong>
                    <ul>
                        <li><a href="#">Email : RONOgrocery@gmail.com</a></li>
                    </ul>
                    <br><p style="color: rgb(112, 134, 153);">Copyright ©2023 | All Rights Reserved</p>
                </div>
                </div>
            </footer>
        </body>
</html>
    
