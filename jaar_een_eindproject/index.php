<?php

session_start();
include_once "database/connection.php";

$info_users_query = $pdo->query('SELECT * FROM users');
$info_products_query = $pdo->query('SELECT * FROM products');
$info_orders_query = $pdo->query('SELECT * FROM orders');
$info_orderlines_query = $pdo->query('SELECT * FROM orderlines');

$info_users = $info_users_query->fetchAll();
$info_products = $info_products_query->fetchAll();
$info_orders = $info_orders_query->fetchAll();
$info_orderlines = $info_orderlines_query->fetchAll();
if (isset($_SESSION['loggedinUser'])) {
    $username = $_SESSION['loggedinUser'];
    if (isset($username) && !empty($username)) {
        $permissions_check_query = $pdo->prepare('SELECT role FROM users WHERE user_name = :username');
        $permissions_check_query->bindParam('username', $username);
        $permissions_check_query->execute();
        $permissions_check = $permissions_check_query->fetch();
        $permission_check = $permissions_check['role'];
    }
}
?>

<!DOCTYPE html>
<html lang="EN">
<head>
<title>home</title>
<link rel="stylesheet" href="css/main.css">
<meta charset="UTF-8">
</head>
<body>
<nav>
    <div class="nav_buttons">
                <a href="index.php">Home</a>
                <a href="product_pages/product_overview.php">products overview</a>
                <a href="order_pages/order_overview.php">order overview</a>
                <a href="account_system/register.php">register/login</a>
                <a href="cart.php">cart</a>
                <?php
                if (isset($username) && !empty($username)) {
                    if ($permission_check == 'admin') {?>
                        <a href="admin_page/admin_overview.php">admin page</a>
                    <?php }
                }
                ?>
            </div>
    </nav>
        <h1>welcome to The banana tree, where we sell everything banana-related from bananas to eat to banana plushies and toys</h1>
    <?php if(isset($_SESSION['loggedinUser'])) {?> <h1>hello <?= $_SESSION['loggedinUser'] ?></h1> <?php } ?>
    </body>
</html>