<?php
session_start();
include_once 'functions.php';

$pdo = pdo_connect_mysql();
// Include functions and connect to the database using PDO MySQL
// The amounts of products to show on each page
$num_products_on_each_page = 8;
// The current page - in the URL, will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products  
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY pid DESC LIMIT ?,?');
// bindValue will allow us to use an integer in the SQL statement, which we need to use for the LIMIT clause
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_products = $pdo->query('SELECT * FROM products')->rowCount(); 
?>


<?=template_header('Products')?>
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
        width: 50%;
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
        color: white;
        background-color: green;
        border-radius: 5px;
        transition: background-color 0.3s;
        font-size: 1em;
        margin: 0 10px;
    }

    .buttons a:hover {
        background-color: white;
    }
</style>
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
                     <div class="right-nav">
    
                    
                    <!--cart----->
                    <a href="index.php?page=cart" class="cart">
    
                        <i class="fas fa-shopping-cart"></i>
    
    
                    </a>
    
    
                </div>

    
            </nav>

        <div class="content-wrapper">
            <h1>Explore Our Products</h1>
            <div class="products">
                <?php foreach ($products as $product): ?>
                    <a href="index.php?page=product&pid=<?= $product['pid'] ?>" class="product">
                        <img src="imgs/<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
                        <span class="name"><?= $product['name'] ?></span>
                        <span class="brand_name"><?= $product['brand_name'] ?></span>
                        <span class="brand_nationality"><?= $product['brand_nationality'] ?></span>
                        <span class="price">
                            L.E <?= $product['price'] ?>
                            <?php if ($product['discount'] > 0): ?>
                                <span class="discount">L.E <?= $product['discount'] ?></span>
                            <?php endif; ?>
                        </span>


                    </a>

                <?php endforeach; ?>
            </div>
            <div class="buttons">
                <?php if ($current_page > 1): ?>
                    <a href="index.php?page=products&p=<?= $current_page-1 ?>">Previous</a>
                <?php endif; ?>
                <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)):?>
                    <a href="index.php?page=products&p=<?= $current_page+1 ?>">Next</a>
                <?php endif; ?>
            </div>
        </div>

<?=template_footer()?>



