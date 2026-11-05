<?php

session_start();
include_once "db.php";

$restaurant_initial = $pdo->query('SELECT naam, aantal_tafels, locatie, soort_eten, open_tijd, sluit_tijd, maximale_aantal_gasten, aantal_actieve_reserveringen, aantal_resterende_reserveringen FROM restaurant_list');
$restauranten = $restaurant_initial->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="main.css">
</head>

<body class="body-index">

    <nav>
        <ul>
            <div class="nav-links">
                <div class="img-flag">
                <img src="img-flag-shop-flags-pride-inclusive-flag-1-2.webp" alt="pride flag">
                <button><a href="index.php">Home</a></button>
                <button><a href="reservation.php">Reservering</a></button>
                <button><a href="reservereing-overzicht.php">Reservering overzicht</a></button>
                <button><a href="restaurant_overzicht.php">restaurant overzicht</a></button>
                <button><a href="contacten.php">Contacten</a></button>
                <button><a href="menu_overzicht.php">menu overzicht</a></button>
            </div>
            <div class="login-container">
                <button class="login-button"><a href="login.php">login</a></button>
            </div>
        </ul>
    </nav>



    <h1>Welkom bij de restaurant reservering website</h1>
    <p> hier kunt u gemakkelijk een reservering maken bij een van onze aangesloten restaurants. <br>Klik op de reservering
        knop om een reservering te maken of klik op de reservering overzicht knop om een overzicht te krijgen van al uw
        gemaakte reserveringen.</p>
    <p>we hebben hier meerdere restaurants toegankelijk! deze kan je zien in het restaurant overzicht</p>
    <div class="container">
        <div class="restaurant-overzicht">
            <table>
                <tr>
                    <th>Restaurant naam</th>
                    <th>Locatie</th>
                    <th>Cuisine</th>
                </tr>
                <?php foreach ($restauranten as $restaurant_loop) {?>
                <tr>
                    <td><?= $restaurant_loop['naam'];?></td>
                    <td><?= $restaurant_loop['locatie'];?></td>
                    <td><?= $restaurant_loop['soort_eten'];?></td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <div class="restaurant-image">
            <img src="restaurant.jpg" alt="restaurant image">
        </div>

    </div>
    <h3>Wij hopen dat u een fijne ervaring heeft op onze website en dat u snel een reservering maakt bij een van
        onze
        restaurants!</h3>
    </body>

</html>