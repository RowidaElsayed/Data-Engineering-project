<?php
include 'db.php';
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
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
                        <a href="Home Page HTML.html" class="active">
                            
                            Home
    
                        </a>
                    
                    </li>
    
                    <li>
    
                        <a href="#category">
    
                            Categories
                        
                        </a>
                    
                    </li>
    
                    <li>
    
                        <a href="#popular-bundle-pack">
                            
                            Packages
                        
                        </a>
                    
                    </li>
    
                    <li>
                        
                        <a href="Contact Form HTML.html">
                            
                            Contact&nbsp;Us
                        
                        </a>
                    
                    </li>
                    
                    <li>
                        
                        <a href="Feedback Form HTML.html">
                            
                            Feedback
                        
                        </a>
                    
                    </li>
                    
                    <li>
    
                        <a href="About Us HTML.html">
    
                            About&nbsp;us
    
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
                    
                    </li>
    
                    </ul>
    
                <!--right-nav-(cart-like)-->
                <div class="right-nav">
    
                    <!--like----->
                    <a href="Wishlist HTML.html" class="like">
                       
                        <img src=" https://static.thenounproject.com/png/194932-200.png" style="width:30px;height:30px;">
                        <i class="fas fa-heart"></i>
              
                        <span>
                            
                            2
                        
                        </span>
    
                    </a>
    
                    <!--cart----->
                    <a href="index.php?page=cart" class="cart">
    
                        <i class="fas fa-shopping-cart"></i>
                        <img src="https://cdn-icons-png.flaticon.com/512/1413/1413908.png" style="width:30px;height:30px;">
    
                        <span>
                            
                            2
                        
                        </span>
    
                    </a>
    
                    <!--cart----->
                    <a href="Profile HTML.html" class="user-profile">
    
                        <i class="fas fa-user"></i>
                         <img src="data:image/png;base64,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" style="width:30px;height:30px;">
                         <span>
    
                            1
    
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
    
                    <h1>
                        
                        Order Your Groceries,All you need
                    
                    </h1>
    
    
                    <!--search-box------>
                    <form action="" class="search-box">
    
                        <!--icon------>
                        <i class="fas fa-search"></i>
    
                        <!--input----->
                        <input type="text" class="search-input" placeholder="Search" name="search" size = "80px" required>
    
                        <!--btn------->
                        <input type="submit" class="search-btn" value="Search">
    
                    </form>
    
                    <br>
    
                    <h3>
    
                        <a href = 'Best Deals HTML.html' style = 'color: #40aa54'>
    
                            Click here to learn about today's best deals
    
                        </a>
    
                    </h3>
    
                </div>
    
            </section>
    
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
                <!--heading----------->
                <div class="product-heading">
                    <h3>Popular Product</h3>
                    <span>All</span>
                </div>
                <!--box-container------>
                <div class="product-container">
                    <!--box---------->
                    <div class="product-container">
                    <?php foreach ($recently_added_products as $product): ?>
                        <div class="product-box">
                            <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
                            <img src="imgs/<?=$product['img']?>" alt="<?=$product['name']?>">
                <span class="name"><?=$product['name']?></span>
                <span class="price">
                    L.E;<?=$product['Price']?>
                    <?php if ($product['rrp'] > 0): ?>
                        <span class="rrp">L.E;<?=$product['rrp']?></span>
                    <?php endif; ?>
                </span>
            </a>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

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
                        <li><a href="#">Packages</a></li>
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
    