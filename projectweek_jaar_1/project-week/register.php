<?php

include_once("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['naam']) && !empty($_POST['email']) && !empty($_POST['telefoonnummer']) && !empty($_POST['password'])) {
        $naam = $_POST['naam'];
        $email = $_POST['email'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { ?>
            <h1>E-mailadres is niet geldig</h1>
    <?php } elseif ($password != $password2) { ?>
            <h1>Wachtwoorden zijn verschillend!</h1>
       <?php } else {
            $statement = $pdo->prepare("SELECT COUNT(*) FROM users WHERE naam = :naam");
            $statement->bindparam(':naam', $naam);
            $statement->execute();

            $count = $statement->fetchColumn();

            if ($count > 0) {
                echo "Username '$naam' already exists.";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $insert = $pdo->prepare("INSERT INTO users (naam, email, telefoonnummer, password) VALUES (:naam, :email, :telefoonnummer, :password)");
                $insert->bindparam(':naam', $naam);
                $insert->bindparam(':email', $email);
                $insert->bindparam(':telefoonnummer', $telefoonnummer);
                $insert->bindparam(':password', $hash);
                $insert->execute();      
                
                header('location: login.php');
            }
        }
    } else { ?>
    <h1>fill all places in!</h1>
   <?php }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registreer restaurant</title>
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>

    <nav>
        <ul>
            <div class="nav-links">
                <div class="img-flag">
                <img src="img-flag-shop-flags-pride-inclusive-flag-1-2.webp" alt="pride flag">
                <button class="back-btn"><a href="login.php">terug</a></button>
        </ul>
    </nav>
            
            <form method="POST">
                <label for="naam">Naam</label>
                <input type="text" id="naam" name="naam" placeholder="Naam" maxlength="100">
                
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" placeholder="E-mail" maxlength="100">
            
            <label for="telefoonnumer">Telefoonnummer</label>
            <input type="number" id="telefoonnummer" name="telefoonnummer" placeholder="Telefoonnummer" maxlength="11">
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Wachtwoord" maxlength="15">
            
            <label for="password2">Confirm password</label>
            <input type="password" id="password2" name="password2" placeholder="Bevestig wachtwoord" maxlength="15">
            <input type="submit" value="Registreren">
        </form>
    </body>
    </html>