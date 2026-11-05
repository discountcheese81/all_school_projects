<?php

session_start();
include_once "db.php";

$reservering_initial = $pdo->query('SELECT id, naam, telefoonnummer, naam_restaurant, reserveringstijd, aantal_personen, speciale_verzoeken, datum FROM restaurant_reservations');
$reserveringen = $reservering_initial->fetchAll();
$id = $pdo->query('SELECT id FROM restaurant_reservations')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="resevering-overzicht.css">
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
    <table>
        <tr>
            <th>naam</th>
            <th>telefoonnummer</th>
            <th>restaurant naam</th>
            <th>Tijd</th>
            <th>datum</th>
            <th>Aantal personen</th>
            <th>Speciale verzoeken</th>
            <th>acties</th>
        </tr>
        <?php
        foreach ($reserveringen as $B) { ?>
            <tr>
                <td><?= $B['naam']; ?></td>
                <td><?= $B['telefoonnummer']; ?></td>
                <td><?= $B['naam_restaurant']; ?></td>
                <td><?= $B['reserveringstijd']; ?></td>
                <td><?= $B['datum']; ?>
                <td><?= $B['aantal_personen']; ?></td>
                <td><?= $B['speciale_verzoeken']; ?></td>
                <td><a href="edit-reservering.php?id=<?= $B['id'] ?>">edit    </a><a href="delete_reservations.php?id=<?= $B['id'] ?>">delete</a></td>
            </tr>
        <?php }
        ?>
</body>
</html>