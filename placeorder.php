<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #fff; 
        margin: 0;
        padding: 0;
    }

    .placeorder {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
        animation: fadeIn 1s ease-in;
    }

    h1 {
        color: #28a745;
        font-size: 2em;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    p {
        font-size: 1.2em;
        color: #333;
        line-height: 1.6;
        margin: 0 20px;
    }

    .content-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    @keyframes fadeIn {
        0% {opacity: 0;}
        100% {opacity: 1;}
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

<div class="content-wrapper">
    <div class="placeorder">
        <h1>Your Order Has Been Placed</h1>
        <p>Thank you for ordering with us! We'll contact you by email with your order details.</p>
    </div>
    
</div>

                
                