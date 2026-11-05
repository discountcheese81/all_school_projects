<?php

session_start();

include_once('db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $naam = trim($_POST['username']);
        $password = $_POST['password'];

        $statement = $pdo->prepare("SELECT * FROM users WHERE naam = :naam");
        $statement->bindparam(':naam', $naam);
        $statement->execute();
        $user = $statement->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loggedInUser'] = $user['id'];
            header("Location: index.php");
            exit;
        } else { ?>
            <h1>onjuiste Username/Password</h1>
     <?php  }
    } else { ?>
        <h1>Vul alle velden in</h1>
  <?php  }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login restaurant reservering</title>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <nav>
        <ul>
            <div class="nav-links">
                <div class="img-flag">
                <img src="img-flag-shop-flags-pride-inclusive-flag-1-2.webp" alt="pride flag">
                <button class="back-btn"><a href="index.php">terug</a></button>
        </ul>
    </nav>
        <form method="POST" class="centreren">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username"><pre></pre>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password"><pre></pre>
            <input type="submit" class="btn" value="login">
            <input type="button" class="btn" value="Registreren" onclick="window.location.href='register.php'">
        </form>
    </body>
</html>