<?php 

session_start();
include_once"../database/connection.php";

if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['password2'])
    && !empty($_POST['password2'] && isset($_POST['email']) && !empty($_POST['email']))) {
        $name = $_POST['username'];
        $pass = $_POST['password'];
        $pass2 = $_POST['password2'];
        $mail = $_POST['email'];
        $name_check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE user_name = :name");
        $name_check->bindparam(':name', $name);
        $name_check->execute();
        $count = $name_check->fetchcolumn();
        if ($count > 0) {
            echo "Username '$name' already exists.";
        } else {
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO users(user_name, password, E_mail) VALUES (:name, :password, :email)");
            $insert->bindParam(':name', $name);
            $insert->bindParam(':password', $hashed_password);
            $insert->bindParam(':email', $mail);
            $insert->execute();

        header('location: login.php');
        exit();
    }
}
    if (isset($_POST['logout'])) {
        unset($_SESSION['user_id']);
        unset($_SESSION['loggedinUser']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Register</title>
</head>
<body>
<main>
    <form action="register.php" method="post">
        <h1>Sign Up</h1>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="password2">Password Again:</label>
            <input type="password" name="password2" id="password2">
        </div>
        <input type="submit" name="register" value="register">
        <a href="../index.php">cancel</a>
        <input type="submit" name="logout" value="log out">
        <footer>Already a member? <a href="login.php">Login here</a></footer>
    </form>
</main>
</body>
</html>     