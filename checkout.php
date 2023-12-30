<?php
session_start();
include_once 'functions.php';
$pdo = pdo_connect_mysql();
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $card_number = isset($_POST['card_number']) ? $_POST['card_number'] : '';
    $transaction_id = $_SESSION['transaction_id'];
    $card_type=isset($_POST['card_type']) ? $_POST['card_type'] : '';
    $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';
    $cardholder_name = isset($_POST['cardholder_name']) ? $_POST['cardholder_name'] : '';
    $expiry_month = isset($_POST['expiry_month']) ? $_POST['expiry_month'] : '';
    $expiry_year = isset($_POST['expiry_year']) ? $_POST['expiry_year'] : '';

    if (strlen($card_number) == 16 && strlen($cvv) == 3 && $expiry_month >= 1 && $expiry_month <= 12 && $expiry_year >= date("Y")) 
    {
        // Fetch transaction_id from orders table
        // Insert into payments table
        $sql = "INSERT INTO payments (amount,card_number,transaction_id,card_type,cvv,cardholder_name, expiry_month, expiry_year) VALUES (?,?,?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$amount, $card_number, $transaction_id, $card_type,$cvv, $cardholder_name, $expiry_month, $expiry_year]);
        $message = "Payment successful! Transaction ID: " . $transaction_id;
        header('Location:placeorder.php');
    } else {
        $message = "Payment failed";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        form {
            width: 300px;
            margin: auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            margin-top: 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            color: green;
            text-align: center;
            margin-top: 20px;
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
   </head>
<body>
    <h1>Payment Form</h1>

    <?php if (isset($message)): ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>

    <form action="" method="post">
          <label for="amount">Payment Amount:</label>
          <input type="text" id="amount" name="amount" value="<?= isset($_SESSION['sub_total']) ? $_SESSION['sub_total'] : '' ?>" required >
          <label for="card_type">Card type:</label>
          <select name="card_type" id="card_type">
             <option value="visa">Visa</option>
             <option value="mastercard">MasterCard</option>
             <option value="Mezza"> Mezza</option>
             <option value="discover">Discover</option>
          </select>
          <label for="card_number">CardNumber:</label>
          <input type="text" id="card_number" name="card_number" required>
          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" name="cvv" required>
          <label for="cardholder_name">CardholderName:</label>
          <input type="text" id="cardholder_name" name="cardholder_name" required>
          <label for="expiry_month">ExpiryMonth:</label>
          <input type="text" id="expiry_month" name="expiry_month" required>
          <label for="expiry_year">ExpiryYear:</label>
          <input type="text" id="expiry_year" name="expiry_year" required>
          <button type="submit">Pay</button>
   </form>
</body>
</html>