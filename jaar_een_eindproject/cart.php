<?php
session_start();
include_once "database/connection.php";

if (isset($_POST['delete'])) {
    unset($_SESSION['cart']);
    unset($_SESSION['full_price']);
    unset($_SESSION['orderline']);
}

if (isset($_POST['order'])) {
    if(!isset($_SESSION['user_id'])) {
        header("Location: account_system/register.php");
        die();
    }

    $full_price = $_SESSION['full_price'];
    $order_date = date("Y/m/d");
    $userid = $_SESSION['user_id'];


    $insert = $pdo->prepare('INSERT INTO orders(user_id, order_date, total_price) VALUES (:userid, :orderdate, :totalprice)');
    $insert->bindParam(':userid', $userid);
    $insert->bindParam(':orderdate', $order_date);
    $insert->bindParam(':totalprice', $full_price);
    $insert->execute();
    $last_id = $pdo->lastInsertId();
    foreach ($_SESSION['cart'] as $A) {
        if ($A['amount'] <= 0) {
            continue;
        }
        $item_name = $pdo->prepare('SELECT price, quantity_available FROM products WHERE product_id = :pro_id');
        $item_name->bindParam(':pro_id', $A['product_id']);
        $item_name->execute();
        $items = $item_name->fetch();
        if ($A['amount'] > $items['quantity_available']) {
            $remove_badorder = $pdo->prepare('DELETE FROM orders WHERE order_id = :id');
            $remove_badorder->bindParam(':id', $last_id);
            $remove_badorder->execute();
            ?> <a href="cart.php">return</a> <?php
            die('Not enough items left to order!');
        }
        $amount_left = $items['quantity_available'] - $A['amount'];

        $amount_reduce = $pdo->prepare('UPDATE products SET quantity_available = :remaining_amount WHERE product_id = :productid');
        $amount_reduce->bindParam(':productid', $A['product_id']);
        $amount_reduce->bindParam(':remaining_amount', $amount_left);
        $amount_reduce->execute();

        $insert_orderline = $pdo->prepare('INSERT INTO orderlines(order_id, product_id, amount, unit_price) VALUES (:order_id, :product_id, :amount, :unit_price)');
        $insert_orderline->bindParam(':order_id', $last_id);
        $insert_orderline->bindParam(':product_id', $A['product_id']);
        $insert_orderline->bindParam(':amount', $A['amount']);
        $insert_orderline->bindParam(':unit_price', $items['price']);
        $insert_orderline->execute();
    }
    unset($_SESSION['cart']);
    unset($_SESSION['full_price']);
    header("location: order_pages/order_overview.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <title>cart</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="nav-links">
    <nav>
                <a href="index.php">Home</a>
                <a href="product_pages/product_overview.php">products overview</a>
                <a href="order_pages/order_overview.php">order overview</a>
                <a href="account_system/register.php">register</a>
                <a href="cart.php">cart</a>
    </nav>
    </div>
    <table>
        <tr>
            <th>Name:</th>
            <th>Price</th>
            <th>amount</th>
        </tr>
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $_SESSION['full_price'] = 0;
            $cart_list = $_SESSION['cart'];
            foreach ($_SESSION['cart'] as $A) {
                if ($A['amount'] <= 0) {
                    continue;
                }
                $_SESSION['amount'] = $A['amount'];
                $item_name = $pdo->prepare('SELECT name, price FROM products WHERE product_id = :pro_id');
                $item_name->bindParam(':pro_id', $A['product_id']);
                $item_name->execute();
                $items = $item_name->fetch();

                $full_price_single_item = $items['price'] * $A['amount'];

        ?>
                <tr>
                    <td><?= $items['name']; ?></td>
                    <td><?= $items['price']; ?></td>
                    <td><?= $A['amount'] ?></td>
                </tr>
            <?php
                $_SESSION['full_price'] += $full_price_single_item;
            }

            ?>
    </table>
    <p>fullprice:</p>
    <?= $_SESSION['full_price'] ?>
    <form method="post">
        <input type="submit" name="delete" value="Delete cart">
        <input type="submit" name="order" value="Order now!">
    </form>
    <?php } else { ?>
        oh no! it seems like your cart is empty, go to the products overview page in order to add items to your cart!
    <?php } ?>
</body>

</html>