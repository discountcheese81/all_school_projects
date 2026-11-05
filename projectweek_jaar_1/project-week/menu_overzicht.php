<?php

session_start();
include_once "db.php";

$menu_initial = $pdo->query('SELECT id,naam_restaurant, naam_gerecht, beschrijving, prijs, categorie FROM menu ORDER BY naam_restaurant asc');
$menu_information = $menu_initial->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="menu_overzicht">
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
                <button><a href="menu_add_page.php"> menu item toevoegen</a></button>
                <button><a href="contacten.php">Contacten</a></button>
            </div>
        </ul>
    </nav>
    <table>
        <tr>
            <th>naam restaurant</th>
            <th>naam gerecht</th>
            <th>beschrijving</th>
            <th>prijs</th>
            <th>categorie</th>
            <Th>actie</Th>
        </tr>
        <?php
        foreach ($menu_information as $B) { ?>
            <tr>
                <td><?= $B['naam_restaurant']; ?></td>
                <td><?= $B['naam_gerecht']; ?></td>
                <td><?= $B['beschrijving']; ?></td>
                <td><?= $B['prijs']; ?></td>
                <td><?= $B['categorie']; ?>
                <td><a href="menu_item_delete.php?id=<?= $B['id'] ?>">delete    </a><a href="menu_edit.php?id=<?= $B['id'] ?>">edit</a></td>
            </tr>
        <?php }
        ?>
</body>
</html>