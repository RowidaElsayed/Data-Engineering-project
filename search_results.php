<?php
// Connect to the database
include 'db.php';
session_start();

include_once 'functions.php';
$pdo = pdo_connect_mysql();

// Define $products as an empty array
$products = array();


// Search part
if(isset($_GET['search'])) {
    $search_query = $_GET['search'];
    
    $sql = "SELECT * FROM products 
            WHERE name LIKE :name 
               OR brand_name LIKE :brand_name
               OR brand_nationality LIKE :brand_nationality
               OR price LIKE :price";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', '%' . $search_query . '%');
    $stmt->bindValue(':brand_name', '%' . $search_query . '%');
    $stmt->bindValue(':brand_nationality', '%' . $search_query . '%');
    $search_query_numeric = filter_var($search_query, FILTER_VALIDATE_FLOAT);
    $stmt->bindValue(':price', $search_query_numeric !== false ? $search_query_numeric : -1);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--==Title==================================-->
    <title>RONO Grocery Store</title>
    <!--==Stylesheet=============================-->
    <link rel="stylesheet" type="text/css" href="Home Page CSS.css">
    <!--==Fav-icon===============================-->
    <link rel="shortcut icon" href="images/fav-icon.png" />
    <!--==Using-Font-Awesome=====================-->
    <script src="https://kit.fontawesome.com/5471644867.js" crossorigin="anonymous"></script>
    <script src='Home Page JS.js' defer></script>

    <link rel="shortcut icon" type="image/jpg"
        href="C:\Users\hp\Desktop\College\First Semester\Introduction To Web Technologies\Notepad ++ Files\Project\favicon.ico" />
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

        <img alt="bg" class="bg-1_rev" src="v.png">


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
                <input type="text" class="search-input" placeholder="Search" name="search" size="80px" required>

                <!--btn------->
                <input type="submit" class="search-btn" value="Search">

            </form>

            <br>

            <h3>

                <a href='Best Deals HTML.html' style='color: #40aa54'>

                    Click here to learn about today's best deals

                </a>

            </h3>     

        </div>

    </section>

    <!--search-banner-end--------------->
<!--Display--->

    <div class="header"></div>
            <div class="container">
            <div class="container">
            <h1>Search Results</h1>
            <div id="search-results">
            <?php if(is_array($products) && count($products) > 0): ?>
            <div class="product-grid">
                <?php foreach ($products as $result): ?>
                    <a href="index.php?page=product&pid=<?= $result['pid'] ?>" class="product">
                        <img src="imgs/<?= $result['img'] ?>" alt="<?= $result['name'] ?>">
                        <span class="name"><?= $result['name'] ?></span>
                        <span class="brand_name"><?= $result['brand_name'] ?></span>
                        <span class="brand_nationality"><?= $result['brand_nationality'] ?></span>
                        <span class="price">
                            L.E <?= $result['price'] ?>
                            <?php if ($result['discount'] > 0): ?>
                                <span class="discount">L.E <?= $result['discount'] ?></span>
                            <?php endif; ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .content-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        color: #333;
        text-align: center;
    }

    .products {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px auto;
    }

    .product {
        flex: 1 1 calc(20% - 10px);
        margin: 10px;
        padding: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.5s;
        text-decoration: none;
        color: #333;
        background-color: #fff;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: hidden;
    }

    .product:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    .product img {
        width: 25%;
        height: auto;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .product .name {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 1.2em;
    }

    .product .price {
        font-size: 1.1em;
        margin-bottom: 10px;
    }

    .product .discount {
        color: #e44d26;
        margin-left: 5px;
        font-size: 1.1em;
    }
    
         .product .brand_name {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 1.2em;
    }
    
         .product .brand_nationality {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 1.2em;
    }

    .buttons {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    .buttons a {
        text-decoration: none;
        padding: 10px 20px;
        color: #fff;
        background-color: #007bff;
        border-radius: 5px;
        transition: background-color 0.3s;
        font-size: 1em;
        margin: 0 10px;
    }

    .buttons a:hover {
        background-color: #0056b3;
    }
</style>

</body>

</html>