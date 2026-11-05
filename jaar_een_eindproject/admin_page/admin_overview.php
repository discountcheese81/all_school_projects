<?php

session_start();
include_once "../database/connection.php";

if (!isset($_SESSION['loggedinUser'])) {
    header("location: ../account_system/register.php");
    die();
    }

$username = $_SESSION['loggedinUser'];
if (isset($username) && !empty($username)) {
    $permissions_check_query = $pdo->prepare('SELECT role FROM users WHERE user_name = :username');
    $permissions_check_query->bindParam('username', $username);
    $permissions_check_query->execute();
    $permissions_check = $permissions_check_query->fetch();
    $permissions_check = $permissions_check['role'];
    if ($permissions_check !== 'admin') {
    header("location: ../index.php");
    die();
    }
}

$info_users_query = $pdo->query('SELECT * FROM users');
$info_products_query = $pdo->query('SELECT * FROM products');
$info_orders_query = $pdo->query('SELECT * FROM orders');
$info_orderlines_query = $pdo->query('SELECT * FROM orderlines');

$info_users = $info_users_query->fetchAll();
$info_products = $info_products_query->fetchAll();
$info_orders = $info_orders_query->fetchAll();
$info_orderlines = $info_orderlines_query->fetchAll();

if (isset($_POST['edit_product'])) {
    $_SESSION['productid'] = $_POST['productid'];
    header("location:../product_pages/product_change.php");
    exit();
}

if (isset($_POST['remove_orderline'])) {
    $id = $_POST['orderline_id'];
    $orderline_remove = $pdo->prepare("DELETE FROM orderlines WHERE ID = :id");
    $orderline_remove->bindParam('id', $id);
    $orderline_remove->execute();
    header("location: admin_overview.php");
    exit();
}

if (isset($_POST['remove_product'])) {
    $id = $_POST['product_id'];
    $product_removal = $pdo->prepare("DELETE FROM products WHERE product_id = :id");
    $product_removal->bindParam('id', $id);
    $product_removal->execute();
    header("location: admin_overview.php");
    exit();
}

if (isset($_POST['remove_order'])) {
    $id = $_POST['remove_order_id'];
    $order_remove = $pdo->prepare("DELETE FROM orders WHERE order_id = :id");
    $order_remove->bindParam('id', $id);
    $order_remove->execute();

    header("location: admin_overview.php");
    exit();
}

if (isset($_POST['role_change'])) {
    if (isset ($_POST['role'])) {
        if ($_POST['role'] == 'customer') {
            $users_update = $pdo->prepare('UPDATE users SET role="admin" WHERE user_id=:userid');
            $users_update->bindParam('userid', $_POST['userid']);
            $users_update->execute();

            header("location: admin_overview.php");
            exit();    
        } else { if ($_POST['role'] == 'admin') {
            $users_update = $pdo->prepare('UPDATE users SET role="customer" WHERE user_id = :userid');
            $users_update->bindParam('userid', $_POST['userid']);
            $users_update->execute();

            header("location: admin_overview.php");
            exit();
            }
        }
    }
}

if (isset($_POST['edit_user'])) {
    $_SESSION['edit_user_id'] = $_POST['userid'];
    header("location: ../account_system/account_edit.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="EN">
<head>
<meta charset="UTF-8">
<title>admin page</title>
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<nav>
        <a href="../index.php">Home</a>
        <a href="../product_pages/product_overview.php">products overview</a>
        <a href="../order_pages/order_overview.php">order overview</a>
        <a href="../account_system/register.php">register/login</a>
        <a href="../cart.php">cart</a>
        <?php
        if (isset($username) && !empty($username)) {
            if ($permissions_check == 'admin') {?>
                <a href="admin_overview.php">admin page</a>
            <?php }
        }
        ?>
    </nav>
    <?php if(isset($_SESSION['loggedinUser'])) {?> <h1>hallo <?= $_SESSION['loggedinUser'] ?></h1> <?php } ?>
<div class="row">
    <div class="column">
    <h2>orders</h2>
    <table>
        <tr>
            <th>order id</th>
            <th>user id</th>
            <th>order date</th>
            <th>total price</th>
            <th>actions</th>
        </tr>
        <?php
        foreach ($info_orders as $B) { ?>
        <form method="post">
            <tr>
                <td><?= $B['order_id'] ?></td>
                <td><?= $B['user_id']; ?></td>
                <td><?= $B['order_date']; ?></td>
                <td><?= $B['total_price']; ?></td>
                <input type="hidden" name="remove_order_id" value="<?= $B['order_id']?>">
                <td><input type="submit" name="remove_order" value="remove"></td>
            </tr>
        </form>
    <?php }
    ?>
    </table>
    </div>
    <div class="column">
        <h2>products</h2>
        <table>
            <tr>
                <th>product id</th>
                <th>name</th>
                <th>price</th>
                <th>quantity available</th>
                <th>description</th>
                <th>actions</th>
            </tr>
            <?php 
        foreach($info_products as $B){ ?>
        <form method="post">
            <tr>
                <td><?= $B['product_id'] ?></td>
                <td><?= $B['name']; ?></td>
                <td><?= $B['price']; ?></td>
                <td><?= $B['quantity_available']; ?></td>
                <td><?= $B['description']; ?></td>
                <input type="hidden" name="productid" value="<?= $B['product_id'] ?>">
                <td><input type="submit" name="edit_product" value="edit product"></td>
            </tr>
        </form>
        <?php }
        ?>
    </table>
    <a href="../product_pages/product_add.php">add product</a>
</div>
<div class="column">
    <h2>users</h2>
    <table>
        <tr>
            <th>user id</th>
            <th>username</th>
            <th>E-mail</th>
            <th>role</th>
            <th>actions</th>
        </tr>
        <?php 
    foreach($info_users as $B){ ?>
        <form method="post">
        <tr>
            <td><?= $B['user_id'] ?></td>
            <td><?= $B['user_name']; ?></td>
            <td><?= $B['E_mail']; ?></td>
            <td><?= $B['role']; ?></td>
            <td><input type="hidden" name="role" value="<?= $B['role'] ?>">
            <input type="hidden" name="userid" value="<?= $B['user_id'] ?>">
            <input type="submit" name="role_change" value="change role">
            <input type="hidden" name="edit_user_id" value="<?= $B['user_id']?>">
            <input type="submit" name="edit_user" value="edit users"></td>
        </tr>
        </form>
        <?php }
        ?>
    </table>
</div>
</div>
<div class="row">
<div class="column">
    <h2>orderlines</h2>
    <table>
        <tr>
            <th>id</th>
            <th>order_id</th>
            <th>product_id</th>
            <th>amount</th>
            <th>unit_price</th>
            <th>actions</th>
        </tr>
        <?php 
    foreach($info_orderlines as $B){ ?>
    <form method="post">
        <tr>
            <td><?= $B['ID'] ?></td>
            <td><?= $B['order_id']; ?></td>
            <td><?= $B['product_id']; ?></td>
            <td><?= $B['amount']; ?></td>
            <td><?= $B['unit_price']; ?>
            <input type="hidden" name="orderline_id" value="<?= $B['ID'] ?>">
            <td><input type="submit" name="remove_orderline" value="remove"></td>
        </tr>
    </form>
        <?php }
        ?>
    </table>
</div>
</div>
</body>