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
    if (empty($_SESSION['edit_user_id'])) {
    header("location: ../admin_page/admin_overview.php");
    die("Geen ID opgegeven.");
    }

$id = $_SESSION['edit_user_id'];

$user_info = $pdo->prepare("SELECT user_name, password, E_mail FROM users WHERE user_id = :id");
$user_info->bindParam('id', $id);

$user_info->execute();
$user_info_finished = $user_info->fetch();

if (isset($_POST['return'])) {
    header("location: ../admin_page/admin_overview.php");
    exit();
}

if (isset($_POST['save'])) {
    if (!empty($_POST['user_name']) && !empty($_POST['pass']) && !empty($_POST['email'])) {
        $username = $_POST['user_name'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    $update_product = $pdo->prepare(" UPDATE users SET user_name = :username, password = :pass, E_mail = :email WHERE user_id = :id ");
    $update_product->bindParam(':username', $username);
    $update_product->bindParam(':pass', $hashed_password);
    $update_product->bindParam(':email', $email);
    $update_product->bindParam(':id', $id);
    
    $update_product->execute();

    header("Location: ../admin_page/admin_overview.php");
    exit;
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit Users</title>
    <link rel="stylesheet" href="../css/edit.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<form method="POST">
    <h1>edit Users</h1>

    <label for="user_name">username:</label>
    <input type="text" name="user_name" id="user_name" value="<?= $user_info_finished['user_name'] ?>"><br>

    <label for="email">e-mail</label>
    <input type="text" name="email" id="email" value="<?= $user_info_finished['E_mail'] ?>"><br>

    <label for="pass">new password</label>
    <input type="password" name="pass" id="pass" required><br>

    <input type="submit" id = "save" name="save" value="save">
    <div class="nav-links">
    <a href="../admin_page/admin_overview.php"> return</a>
    </div>
</form>
</body>
</html>
