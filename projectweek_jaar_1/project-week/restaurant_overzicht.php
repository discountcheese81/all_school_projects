<?php

session_start();
include_once "db.php";

$restaurant_initial = $pdo->query('SELECT id, naam, aantal_tafels, locatie, soort_eten, open_tijd, sluit_tijd, maximale_aantal_gasten, aantal_actieve_reserveringen, aantal_resterende_reserveringen FROM restaurant_list');
$restauranten = $restaurant_initial->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>restaurant overzicht</title>
    <link rel="stylesheet" href="restaurant_overzicht.css">
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
                <button><a href="restaurant-registeren.php">Restaurant registeren</a></button>
            </div>
        </ul>
    </nav>
    <h1 class="bold_large"> welkom op het restaurant overzicht </h1>
    <table>
        <th>Naam</th>
        <th>Aantal_tafels</th>
        <th>locatie</th>
        <th>soort eten</th>
        <th>open tijden</th>
        <th>sluit tijd</th>
        <th>maximale aantal gasten</th>
        <th>aantal actieve reserveringen</th>
        <th>aantal resterende reserveringen</th>
        <th>edit</th>
        <th>delete</th>
        <?php
        foreach ($restauranten as $B) { ?>
            <tr>
                <td><?= $B['naam']; ?></td>
                <td><?= $B['aantal_tafels']; ?></td>
                <td><?= $B['locatie']; ?></td>
                <td><?= $B['soort_eten']; ?></td>
                <td><?= $B['open_tijd']; ?></td>
                <td><?= $B['sluit_tijd']; ?></td>
                <td><?= $B['maximale_aantal_gasten']; ?></td>
                <td><?= $B['aantal_actieve_reserveringen']; ?></td>
                <td><?= $B['aantal_resterende_reserveringen']; ?></td>
                <td><a href="edit.php?id=<?= $B['id'] ?>">pas aan</a></td>
                <td><a href="restaurant_delete.php?id=<?= $B['id'] ?>">delete</a></td>
            </tr>
        <?php }
        ?>
    </table>
</body>

</html>