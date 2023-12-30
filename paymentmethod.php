<?php
session_start();
include_once 'functions.php';
$pdo = pdo_connect_mysql();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch values from $_POST
    $transaction_id = $_SESSION['transaction_id'];
    $full_name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip_code'];
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';

    // Insert data into the database
    $sql = "INSERT INTO shipping (transaction_id, full_name, address, city, state, zip_code, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$transaction_id, $full_name, $address, $city, $state, $zip, $payment_method]);

    // Redirect to checkout page if payment method is online
    if ($payment_method == 'online') {
        header('Location: checkout.php');
        exit;
    }
    else{
         header('Location: placeorder.php');
    
    }
}
?>
<!DOCTYPE html>
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
<head>
  <title>Choose Payment Method</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    form {
      width: 300px;
      margin: 0 auto;
    }
    label {
      display: block;
      margin-top: 20px;
    }
    input[type="text"], select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
    }
    input[type="submit"] {
      margin-top: 30px;
      padding: 10px 20px;
      background-color: #4CAF50;
      border: none;
      color: white;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h1>Choose Payment Method</h1>

  <form action="" method="post">
    <input type="hidden" name="transaction_id">

    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name">

    <label for="address">Shipping Address:</label>
    <input type="text" id="address" name="address">

    <label for="city">City:</label>
    <input type="text" id="city" name="city">

    <label for="state">State:</label>
    <input type="text" id="state" name="state">

    <label for="zip_code">ZIP Code:</label>
    <input type="text" id="zip_code" name="zip_code">

    <label for="payment_method">Payment Method:</label>
    <label for="online">Pay Online</label>
    <input type="radio" id="online" name="payment_method" value="online"><br>
    <label for="delivery">Pay on Delivery</label>
    <input type="radio" id="delivery" name="payment_method" value="delivery"><br>

    <input type="submit" value="Complete">
  </form>
</body>
</html>