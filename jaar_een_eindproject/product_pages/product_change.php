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

if (empty($_SESSION['productid'])) {
    die("Geen ID opgegeven.");
}

$id = $_SESSION['productid'];

$product_info = $pdo->prepare("SELECT name, description, price, quantity_available FROM products WHERE product_id = :id");
$product_info->bindParam('id', $id);
$product_info->execute();
$product_info = $product_info->fetch();

if (isset($_POST['return'])) {
    header("location: ../admin_page/admin_overview.php");
    exit;
}

if (isset($_POST['save'])) {
    if (!empty($_POST['product_name']) && !empty($_POST['desc']) && !empty($_POST['price']) && !empty($_POST['quantity'])) {
    $name = $_POST['product_name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $update_product = $pdo->prepare(" UPDATE products SET name = :name, description = :desc, price = :price, quantity_available = :quantity WHERE product_id = :id
    ");
    $update_product->bindParam(':name', $name);
    $update_product->bindParam(':desc', $desc);
    $update_product->bindParam(':price', $price);
    $update_product->bindParam(':quantity', $quantity);
    $update_product->bindParam(':id', $id);
    
    $update_product->execute();

    header("Location: ../admin_page/admin_overview.php");
    exit;
    }
}
?>
<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editing Product</title>
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>

<form method="POST">
    <h1>edit Product</h1>

    <label for="product_name">product name:</label>
    <input type="text" name="product_name" id="product_name" value="<?= $product_info['name'] ?>"><br>

    <label for="desc">description   :</label>
    <textarea name="desc" id="desc"><?= $product_info['description'] ?></textarea><br>

    <label for="price">Price (€):</label>
    <input type="number" step="0.01" name="price" id="price" value="<?= $product_info['price'] ?>"><br>

    <label for="quantity">quantity available:</label>
    <input type="text" name="quantity" id="quantity" value="<?= $product_info['quantity_available'] ?>"><br>

    <input type="submit" id = "save" name="save" value="save">
    <input type="submit" id = "return" name="return" value="return">
</form>

</body>
</html>
