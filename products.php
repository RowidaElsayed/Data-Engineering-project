<?php
include 'db.php';
// The amounts of products to show on each page
$num_products_on_each_page = 4;
// The current page - in the URL, will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY pid DESC LIMIT ?,?');
// bindValue will allow us to use an integer in the SQL statement, which we need to use for the LIMIT clause
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products = $pdo->query('SELECT * FROM products')->rowCount(); ?>
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
        width: 100%;
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

<div class="content-wrapper">
    <h1>Explore Our Products</h1>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <a href="index.php?page=product&pid=<?= $product['pid'] ?>" class="product">
                <img src="imgs/<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
                <span class="name"><?= $product['name'] ?></span>
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
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
            <a href="index.php?page=products&p=<?= $current_page+1 ?>">Next</a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>



