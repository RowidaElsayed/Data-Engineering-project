<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=groceryw_project', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

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
        max-width: 100%;
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

<div class="content-wrapper">
    <div class="navigation">
        <a href="index.php">Home</a>
        <a href="index.php?page=products">Products</a>
    </div>
    <h1><?=$product['name']?></h1>
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

