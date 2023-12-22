<?php
// Include your database connection file
include 'db.php';

// If the user is logged in, get user_id from the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // If the user is not logged in, redirect to the login page (or any other handling you want)
    header('Location: index.html');
    exit;
}

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our database
    $stmt = $pdo->prepare('SELECT * FROM products WHERE pid = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quantity
                $_SESSION['cart'][$product_id] += $quantity;
                // Update the quantity in the cart table
                $stmt = $pdo->prepare('UPDATE cart SET quantity = quantity + ? WHERE pid = ? AND user_id = ?');
                $stmt->execute([$quantity, $product_id, $user_id]);
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
                // Insert the product into the cart table
                $stmt = $pdo->prepare('INSERT INTO cart (user_id, pid, price, quantity, img) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$user_id, $product_id, $product['price'], $quantity, $product['img']]);
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
            // Insert the first product into the cart table
            $stmt = $pdo->prepare('INSERT INTO cart (user_id, pid, price, quantity, img) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$user_id, $product_id, $product['price'], $quantity, $product['img']]);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}
/*
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
    // Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
*/
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Fetch the details of the product to be removed
    $removedProductId = (int)$_GET['remove'];
    $product_id = (int)$_GET['remove'];

    
    // Ensure the product ID is valid
    if ($removedProductId > 0) {
        // Fetch the product details from the database
        $stmt = $pdo->prepare('SELECT * FROM products WHERE pid = ?');
        $stmt->execute([$removedProductId]);
        
        // Fetch the product details
        $removedProduct = $stmt->fetch(PDO::FETCH_ASSOC);

        // Ensure the product exists
        if ($removedProduct) {
            // Get the quantity of the product in the cart
            $removedProductQuantity = $_SESSION['cart'][$removedProductId];
           
            // Remove the product from the shopping cart
            unset($_SESSION['cart'][$removedProductId]);

            // Update the database to increment the quantity
            $stmt = $pdo->prepare('UPDATE products SET quantity  = quantity  + ? WHERE pid = ?');
            $stmt->execute([$removedProductQuantity, $removedProductId]);
             //Remove product from cart table
            $stmt = $pdo->prepare('DELETE FROM cart WHERE pid = ? AND user_id = ?');
            $stmt->execute([$product_id, $user_id]);
        }
    }
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity-') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity in session
                $_SESSION['cart'][$id] = $quantity;
                
                // Update the quantity in the cart table
                $stmt = $pdo->prepare('UPDATE cart SET quantity = ? WHERE pid = ? AND user_id = ?');
                $stmt->execute([$quantity, $id, $user_id]);
            }
        }
    }
    
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $stmt = $pdo->prepare("INSERT INTO orders (order_time, pid, user_id) VALUES (NOW(), ?, ?)");
        $stmt->execute([$product_id, $user_id]);
    }
    // Clear the cart
    $_SESSION['cart'] = [];
    header('Location: index.php?page=placeorder');
    exit;
}
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE pid IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['pid']];
    }
// After updating $_SESSION['cart']
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $stmt = $pdo->prepare('UPDATE products SET quantity  = quantity  - ? WHERE pid = ?');
    $stmt->execute([$quantity, $product_id]);
}
}
?>
<?=template_header('Cart')?>

<div class="cart content-wrapper">
    <head>

    <title>
        
        Shopping Cart

    </title>

    <link rel ="stylesheet" type="text/css" href="Shopping Cart .css">

    <script src="https://kit.fontawesome.com/9088cc6401.js" crossorigin="anonymous"></script>

    </head>
    <h1>Shopping Cart</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&pid=<?=$product['pid']?>">
                            <img src="imgs/<?=$product['img']?>" width="50" height="50" alt="<?=$product['name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&pid=<?=$product['pid']?>"><?=$product['name']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['pid']?>" class="remove">Remove</a>
                    </td>
                    <td class="price">L.E <?=$product['price']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['pid']?>" value="<?=$products_in_cart[$product['pid']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                    </td>
                    <td class="price">L.E <?=$product['price'] * $products_in_cart[$product['pid']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price">L.E <?=$subtotal?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>

<?=template_footer()?>

