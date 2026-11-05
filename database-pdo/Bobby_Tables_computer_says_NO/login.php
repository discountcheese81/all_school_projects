<?php

include_once('connection.php');

session_start();

unset($_SESSION['error']);

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->execute();
    $user = $query->fetch();

    if ($user !== false) {
        $_SESSION['loggedInUser'] = $user['id'];
        header("Location: index.php?username=$username&password=$password");
        die();
    }

    $_SESSION['error'] = "Gebruikersnaam of wachtwoord is ongeldig.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <div>
            <label for="username">Gebruikersnaam</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Wachtwoord</label>
            <input type="text" name="password" id="password">
        </div>
        <?php if (isset($_SESSION['error'])) { ?>
            <div style="color: red;"><?= $_SESSION['error']; ?></div>
        <?php } ?>
        <input type="submit" value="Inloggen">
    </form>
</body>
</html>
