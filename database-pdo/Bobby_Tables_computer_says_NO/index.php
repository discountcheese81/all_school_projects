<?php

include_once('connection.php');

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die();
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
    <div>
        <h1>Welkom op de website</h1>
        Je bent ingelogd als gebruiker met ID: <b><?= $_SESSION['loggedInUser'] ?></b>

        <p>
            De volgende gegevens zijn gebruikt om in te loggen:<br>
            <b>Username:</b><code><?= $_GET['username'] ?></code><br>
            <b>Password:</b><code><?= $_GET['password'] ?></code><br>

        </p>
        <p></p>

    </div>
    <div>
        <a href="logout.php">Uitloggen</a>
    </div>
</body>
</html>
