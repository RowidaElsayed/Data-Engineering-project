<?php
// Include functions and connect to the database using PDO MySQL
include_once 'functions.php';
// Include functions and connect to the database using PDO MySQL
$pdo = pdo_connect_mysql();
if (isset($_GET['pid'])) {
        
    $stmt = $pdo->prepare('SELECT * FROM products WHERE pid = ?');
    $stmt->execute([$_GET['pid']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
    if (!$product) {
        exit('Product does not exist!');
    }
} else {
    exit('Product does not exist!');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Retrieve the product price and image
    $stmt = $pdo->prepare('SELECT price, img FROM products WHERE pid = ?');
    $stmt->execute([$product_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $price = $result['price'];
    $img = $result['img'];

    

    if ($result) {
        header('Location: index.php?page=cart'); // Redirect to the cart page or any other desired page
        exit;
    } else {
        $error = $stmt->errorInfo();
        echo "Error: " . $error[2];
    }
}
?>
<?=template_header('Product Details')?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .content-wrapper {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h1 {
        color: #333;
        text-align: center;
    }

    .product {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product img {
        max-width: 50%;
        height: auto;
        border-radius: 8px;
        margin-right: 20px;
    }

    .product-details {
        flex: 1;
    }

    .product-details h1 {
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .product-details .price {
        font-size: 1.2em;
        color: #e44d26;
        margin-bottom: 15px;
    }

    .product-details .discount {
        text-decoration: line-through;
        color: #777;
        margin-left: 10px;
    }

    .quantity-form {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .quantity-form input[type="number"] {
        width: 60px;
        padding: 8px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .add-to-cart-btn {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .add-to-cart-btn:hover {
        background-color: #218838;
    }

    .navigation {
        text-align: center;
        margin-top: 20px;
    }

    .navigation a {
        text-decoration: none;
        color: #007bff;
        margin: 0 10px;
        font-weight: bold;
        font-size: 1.1em;
        display: inline-block;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .navigation a:hover {
        background-color: #e6f7ff;
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
    <h1><?=$product['name']?></h1>
      <!--no of users-------->
    <div class='row'>
            <?php
        include 'db.php';

        $pdo = pdo_connect_mysql();

        $pid = $_GET['pid'];

        // Prepare the SQL statement
        $total_purchases_sql = "SELECT COUNT(user_id) AS total_purchases FROM orders WHERE pid = $pid";
        $result = $pdo->query($total_purchases_sql);

        // Fetch the result as an associative array
        $row = $result->fetch(PDO::FETCH_ASSOC);

        // Access the 'total_purchases' value from the array
        $total_purchases = $row['total_purchases'];

echo '<h2 style="font-size: 20px;">Total number of users that purchased the product: ' . $total_purchases . '</h2>';
            ?>    
    </div>

  <!--no of users in last 24hr-------->
    <div class='row'>
            <?php
        include 'db.php';

        $pdo = pdo_connect_mysql();

        $pid = $_GET['pid'];

        // Prepare the SQL statement
        $total_purchases_sql_24hrs = "SELECT COUNT(DISTINCT user_id) AS total_purchases_24hrs FROM orders WHERE pid = $pid AND order_time >= DATE_SUB(NOW(), INTERVAL 1 DAY);
; ";
        $result = $pdo->query($total_purchases_sql_24hrs);

        // Fetch the result as an associative array
        $row = $result->fetch(PDO::FETCH_ASSOC);

        // Access the 'total_purchases' value from the array
        $total_purchases_24hrs = $row['total_purchases_24hrs'];

echo '<h2 style="font-size: 20px;">Total number of users that purchased the productin last 24 hrs: ' . $total_purchases_24hrs . '</h2>';
            ?>    
    </div>

    <div class="product">
        <img src="imgs/<?=$product['img']?>" alt="<?=$product['name']?>">
        <div class="product-details">
            <span class="price">
                L.E <?=$product['price']?>
                <?php if ($product['discount'] > 0): ?>
                    <span class="discount">L.E <?=$product['discount']?></span>
                <?php endif; ?>
            </span>
        
            <form action="index.php?page=cart" method="post" class="quantity-form">
                <input type="hidden" name="cart_id" value="YOUR_CART_ID_HERE">
                <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                <input type="hidden" name="product_id" value="<?=$product['pid']?>">
                <button type="submit" class="add-to-cart-btn">Add To Cart</button>
                    

            </form>
        </div>
    </div>
</div>

<?=template_footer()?>

