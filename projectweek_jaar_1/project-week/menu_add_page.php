<?php

session_start();
include_once "db.php";

$menu_initial = $pdo->query('SELECT id,naam_restaurant, naam_gerecht, beschrijving, prijs, categorie FROM menu');
$menu_information = $menu_initial->fetchAll();
$restaurant_name = $pdo->query('SELECT id, naam FROM restaurant_list');
$restaurant = $restaurant_name->fetchall();
if (
    isset($_POST['restaurant_name']) and isset($_POST['naam_gerecht'])
    and isset($_POST['beschrijving']) and isset($_POST['prijs'])
    and isset($_POST['categorie'])
) {
    $name_gerecht_add = $_POST['naam_gerecht'];
    $beschrijving_add = $_POST['beschrijving'];
    $naam_restaurant_add = $_POST['restaurant_name'];
    $prijs_add = $_POST['prijs'];
    $categorie_add = $_POST['categorie'];

    $sth = $pdo->prepare("INSERT INTO `menu` (`naam_gerecht`, `beschrijving`, `naam_restaurant`, `prijs`, `categorie`) 
    VALUES (:gerecht_naam, :beschrijving_add, :name_restaurant_add, :prijs_add, :categorie_add)");
    $sth->bindParam(':gerecht_naam', $name_gerecht_add);
    $sth->bindParam(':beschrijving_add', $beschrijving_add);
    $sth->bindParam(':name_restaurant_add', $naam_restaurant_add);
    $sth->bindParam(':prijs_add', $prijs_add);
    $sth->bindParam(':categorie_add', $categorie_add);
    $sth->execute();

    header('Location: menu_overzicht.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservation</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="stylesheet" href="main.css">
    
</head>
<body>
    <nav>
        <ul>
            <div class="nav-links">
                <div class="img-flag">
                <img src="img-flag-shop-flags-pride-inclusive-flag-1-2.webp" alt="pride flag">
                <button><a href="index.php">Home</a></button>
                <button><a href="reservation.php">Reservering</a></button>
                <button><a href="reservereing-overzicht.php">Reservering overzicht</a></button>
                <button><a href="restaurant_overzicht.php">restaurant overzicht</a></button>
                <button><a href="menu_overzicht.php">menu overzicht</a></button>
                <button><a href="contacten.php">Contacten</a></button>
            </div>
        </ul>
    </nav>
    <h1><button>plaats hier nieuwe menu items</button></h1>
    <div class="reservation-form">
    <form method="post">
    <select name="restaurant_name">
        <?php foreach ($restaurant as $B) {?>
        <option value="<?= $B['naam'] ?>"> <?= $B['naam'] ?></option>
        <?php } ?>
        </select><br>
    <input type="text" name="naam_gerecht" placeholder="gerecht Naam"><br>
    <input type="text" name="beschrijving" placeholder="beschrijving"><br>
    <input type="text" name="prijs" placeholder="prijs"><br>
    <input type="text" name="categorie" placeholder="categorie"><br>
    <input type="submit">
    </form>
    </div>
</body>
</html>