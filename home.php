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
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY pid DESC LIMIT 6');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    
        <script src = 'Home Page JS.js' defer></script>
            
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
    
                        <a href="#category">
    
                            Categories
                        
                        </a>
                    
                    </li>
                     <li>
                        
                        <a href="products.php">
                            
                            products
                        
                        </a>
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
    
                        <span>
                            
                            2
                        
                        </span>
    
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
                    <h1>Order Your Groceries,All you need </h1>
    

                <form class="search-box" method="post" action="search_results.html">

                    <!--icon------>
                    <i class="fas fa-search"></i>

                    <!--input----->
                    <input type="text" class="search-input" placeholder="Search" name="search" size="80px" required>

                    <!--btn------->
                    <input name="submit" type="submit" class="search-btn" value="Search">

                </form>
    
                    <br>
    
                    <h3>
    
                        <a href = 'Best Deals HTML.html' style = 'color: #40aa54'>
    
                            Click here to learn about today's best deals
    
                        </a>
    
                    </h3>

    
            <!--search-banner-end--------------->
    
            <h2 class = 'sale-heading'>
    
                Republic Day Sale is Live For
    
            </h2>
    
            <div class="countdown-container">
    
                <div class="countdown-el days-c">
                    <p class="big-text" id="days">0</p>
                    <span>Days</span>
                </div>
                <div class="countdown-el hours-c">
                    <p class="big-text" id="hours">0</p>
                    <span>Hours</span>
                </div>
                <div class="countdown-el mins-c">
                    <p class="big-text" id="mins">0</p>
                    <span>Min</span>
                </div>
                <div class="countdown-el seconds-c">
                    <p class="big-text" id="seconds">0</p>
                    <span>Seconds</span>
                </div>
            </div>
            <!--==category=========================================-->
            <section id="category">
    
                <!--heading---------------->
                <div class="category-heading">
    
                    <h2>
                        
                        Category
                    
                    </h2>
    
                    <span>
                        
                        All
                    
                    </span>
    
                </div>
    
                <!--box-container---------->
                <div class="category-container">
    
                    <!--box---------------->
                    <a class="category-box" href = 'Fruits Category Page HTML.html'>
                        <img alt="Fruits and Vegetables" src="https://p1.hiclipart.com/preview/593/493/164/fruits-vegetable-logo-fruits-vegetable-fruit-vegetable-food-nut-bowl-png-clipart.jpg">
                        <span>Fruits & <br> Vegetables</span>
                    </a>
                    <!--box---------------->
                    <a class="category-box" href = 'Chicken Category Page HTML.html'>
                        <img alt="Chicken" src="https://banner2.cleanpng.com/20180528/lro/kisspng-roast-chicken-fried-chicken-barbecue-chicken-hoho-5b0c72bb14ac07.7537007015275424590847.jpg">
                        <span>Chicken</span>
                    </a>
                    <!--box---------------->
                    <a class="category-box" href="Meat Category Page HTML.html">
                        <img alt="Meat" src="https://i.pinimg.com/originals/10/e0/56/10e056e59cd128c9eeeeccf0327c6b39.png">
                        <span>Meat</span>
                    </a>
                    <!--box---------------->
                    <a class="category-box" href = 'Fish Category Page HTML.html'>
                        <img alt="Fish" src="https://image.similarpng.com/very-thumbnail/2022/01/Fish-logo-template-on-transparent-background-PNG.png">
                        <span>Fish</span>
                    </a>
                    <!--box---------------->
                    <a class="category-box" href = 'Cheese Category Page HTML.html'>
                        <img alt="Cheese" src="https://i.etsystatic.com/26743355/r/il/5bbd59/2981450570/il_fullxfull.2981450570_eeck.jpg">
                        <span>Cheese</span>
                    </a>
                </div>
                
            </section>
            <!--category-end----------------------------------->
            <!--==Products====================================-->
            <section id="popular-product">
            <!-- Heading -->
            <div class="product-heading">
                <h3>Explore Popular Products</h3>
                <span>View All</span>
            </div>
            <!-- Product Container -->
            <div class="product-container">
                <!-- Product Boxes -->
                <?php foreach ($recently_added_products as $product): ?>
                    <div class="product-box">
                        <a href="index.php?page=product&pid=<?=$product['pid']?>" class="product-link">
                            <img src="imgs/<?=$product['img']?>" alt="<?=$product['name']?>" class="product-image">
                            <span class="product-name"><?=$product['name']?></span>
                            <span class="product-price">
                                L.E <?=$product['price']?>
                                <?php if ($product['discount'] > 0): ?>
                                    <span class="discount-price">L.E <?=$product['discount']?></span>
                                <?php endif; ?>
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


                </div>
            </section>
            <!--popular-product-end--------------------->
            <!--Popular-bundle-pack===================================-->
            <section id="popular-bundle-pack">
                <!--heading-------------->
                <div class="product-heading">
                    <h3>Popular Bundle Pack</h3>
                </div>
                <!--box-container------>
                <div class="product-container">
                    <!--box---------->
                    <div class="product-box">
                        <img alt="pack" src="https://i.imgur.com/Zm8Xo2j.png">
                        <strong>Big Pack</strong>
                        <span class="quantity">Lemon, Tomato, Potato,+4</span>
                        <span class="price">LE. 500</span>
                        <!--cart-btn------->
                        <a href="Shopping Cart HTML.html" class="cart-btn">
                            <i class="fas fa-shopping-bag"></i> Add to Cart
                        </a>
                        <!--like-btn------->
                        <a class="like-btn">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    <!--box---------->
                    <div class="product-box">
                        <img alt="apple" src="https://i.imgur.com/vMA9mRm.jpg">
                        <strong>Large Pack</strong>
                        <span class="quantity">Lemon, Tomato, Potato,+2</span>
                        <span class="price">LE. 800</span>
                        <!--cart-btn------->
                        <a href="Shopping Cart HTML.html" class="cart-btn">
                            <i class="fas fa-shopping-bag"></i> Add to Cart
                        </a>
                        <!--like-btn------->
                        <a class="like-btn">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    <!--box---------->
                    <div class="product-box">
                        <img alt="apple" src="https://i.imgur.com/CeVqxe2.png">
                        <strong>Small Pack</strong>
                        <span class="quantity">Lemon, Tomato, Potato</span>
                        <span class="price">LE. 300</span>
                        <!--cart-btn------->
                        <a href="Shopping Cart HTML.html" class="cart-btn">
                            <i class="fas fa-shopping-bag"></i> Add to Cart
                        </a>
                        <!--like-btn------->
                        <a class="like-btn">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    <!--box---------->
                    <div class="product-box">
                        <img alt="pack" src="https://i.imgur.com/Zm8Xo2j.png">
                        <strong>Big Pack</strong>
                        <span class="quantity">Lemon, Tomato, Potato,+4</span>
                        <span class="price">LE. 900</span>
                        <!--cart-btn------->
                        <a href="Shopping Cart HTML.html" class="cart-btn">
                            <i class="fas fa-shopping-bag"></i> Add to Cart
                        </a>
                        <!--like-btn------->
                        <a class="like-btn">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    <!--box---------->
                    <div class="product-box">
                        <img alt="apple" src="https://i.imgur.com/vMA9mRm.jpg">
                        <strong>Large Pack</strong>
                        <span class="quantity">Lemon, Tomato, Potato,+2</span>
                        <span class="price">LE. 700</span>
                        <!--cart-btn------->
                        <a href="Shopping Cart HTML.html" class="cart-btn">Add to Cart
                       
  
                        </a>
                        
                        <!--like-btn------->
                        <a class="like-btn">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    <!--box---------->
                    <div class="product-box">
                        <img alt="apple" src="https://i.imgur.com/CeVqxe2.png">
                        <strong>Small Pack</strong>
                        <span class="quantity">Lemon, Tomato, Potato</span>
                        <span class="price">Rs. 400</span>
                        <!--cart-btn------->
                        <a href="Shopping Cart HTML.html" class="cart-btn">
                            <i class="fas fa-shopping-bag"></i> Add to Cart
                        </a>
                        <!--like-btn------->
                        <a class="like-btn">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                </div>
            </section>
            <!--popular-bundle-pack-end-------------------------------->
            <!--==Footer=============================================-->
            <footer>
                <div class="footer-container">
                    <!--logo-container------>
                    <div class="footer-logo">
                        <a href="file:///C:/Users/RAGHAV/Desktop/Coding/Grocery/Logo.png"><span>RO</span>NO</a>
                    </div>
                    <!--links------------------------->
                <div class="footer-links">
                    <strong>Product</strong>
                    <ul>
                        <li><a href="#">Grocery</a></li>
                        <li><a href="#">Popular</a></li>
                        <li><a href="#">New</a></li>
                    </ul>
                </div>
                <!--links------------------------->
                <div class="footer-links">
                    <strong>Category</strong>
                    <ul>
                        <li><a href="#">Chicken</a></li>
                        <li><a href="#">Vegetables and fruits</a></li>
                        <li><a href="#">Meat</a></li>
                        <li><a href="#">Fish</a></li>
                        <li><a href="#">Cheese</a></li>
                    </ul>
                </div>
                <!--links-------------------------->
                <div class="footer-links">
                    <strong>Contact</strong>
                    <ul>
                        <li><a href="#">Email : RONOgrocery@gmail.com</a></li>
                    </ul>
                    <br><p style="color: rgb(112, 134, 153);">Copyright ©2022 | All Rights Reserved</p>
                </div>
                </div>
            </footer>
        </body>
</html>
    
