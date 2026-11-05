<?php

session_start();

include_once("../database/connection.php");

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['quantity'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $statement = $pdo->prepare("SELECT COUNT(*) FROM products WHERE name = :name");
        $statement->bindparam(':name', $name);
        $statement->execute();
        $count = $statement->fetchColumn();
        if ($count > 0) {
            echo "product '$name' already exists.";
        } else {
            $insert = $pdo->prepare("INSERT INTO products (name, description, price, quantity_available) VALUES (:name, :description, :price, :quantity)");
            $insert->bindparam(':name', $name);
            $insert->bindparam(':description', $description);
            $insert->bindparam(':price', $price);
            $insert->bindparam(':quantity', $quantity);
            $insert->execute();
            
            header('Location: ../admin_page/admin_overview.php');
            exit;
        }
    } else { ?>
        <h1>fields cannot be empty!</h1>
   <?php }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add product</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/register_style.css">
</head>
<body>
<nav>
            <div>
                <a href="../admin_page/admin_overview.php">terug</a>
            </div>
</nav>    
    <div class="register-form">
        <form method="post">
            <p>name:</p>
            <input type="text" name="name" placeholder="Name"><br><br>
            <p>description:</p>
            <input type="text" name="description" placeholder="description"><br><br>
            <p>price:</p>
            <input type="number" name="price" min = "0" step = "0.01" placeholder="price"><br><br>
            <p>quantity:</p>
            <input type="number" name="quantity" min = "0" placeholder="quantity"><br><br>
            <input type="submit" name="pro_add" value="add product">
        </form>
    </div>
</body>
</html>