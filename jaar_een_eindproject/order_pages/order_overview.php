<?php

session_start();
include_once "../database/connection.php";

$order_query = $pdo->query('SELECT order_id, user_id, order_date, total_price FROM orders');
$order_info = $order_query->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>
    <link rel="stylesheet" href="../css/order_overview.css">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <nav>
            <div class="nav-links">
                <a href="../index.php">Home</a>
                <a href="../product_pages/product_overview.php">products overview</a>
                <a href="order_overview.php">order overview</a>
                <a href="../account_system/register.php">register</a>
                <a href="../cart.php">cart</a>
            </div>
    </nav>
    <h1 class="bold_large"> welcome to the order view page </h1>
    <table>
        <tr>
        <th>username</th>
        <th>order date</th>
        <th>total price</th>
        </tr>
        <?php
        foreach ($order_info as $B) {
            $name_get = $pdo->prepare('SELECT user_name FROM users WHERE user_id = :id');
            $name_get->bindParam('id', $B['user_id']);
            $name_get->execute();
            $username = $name_get->fetchColumn();?>
            <tr>
                <td><?= $username; ?></td>
                <td><?= $B['order_date']; ?></td>
                <td><?= $B['total_price']; ?></td>
            </tr>
        <?php }
        ?>
    </table>
</body>

</html>