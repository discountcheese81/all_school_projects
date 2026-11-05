<?php

session_start();
include_once "../database/connection.php";

$product_query = $pdo->query('SELECT product_id, name, description, price, quantity_available FROM products');
$product_info = $product_query->fetchAll();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $amount = $_POST['amount'];

    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
  
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['amount'] += $amount;
    } else {
        $_SESSION['cart'][$product_id] = array( 'product_id' => $product_id, 'amount' => $amount);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>products</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/product_overview.css">
</head>

<body>
    <nav>
            <div class="nav-links">
                <a href="../index.php">Home</a>
                <a href="../product_pages/product_overview.php">products overview</a>
                <a href="../order_pages/order_overview.php">order overview</a>
                <a href="../account_system/register.php">register</a>
                <a href="../cart.php">cart</a>
            </div>
    </nav>
    <h1 class="bold_large"> welcome to the product overview page </h1>
    <div class="all-cards">
        <?php foreach ($product_info as $product_cards) { ?>
        <div class="card">
            <h1><?= $product_cards['name'] ?></h1>
            <p class="price">$<?= $product_cards['price'] ?></p>
            <p><?= $product_cards['description'] ?></p>
            <p>amount left: <?= $product_cards['quantity_available'] ?></p>
            <form method="POST">
                <input type="number" name="amount" value="1" step="1" min="1" max="<?= $product_cards['quantity_available']?>" required><br>
                <input type="hidden" name="product_id" value="<?= $product_cards['product_id'] ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </div>  
        <?php } ?>
    </div>
</body>
</html>