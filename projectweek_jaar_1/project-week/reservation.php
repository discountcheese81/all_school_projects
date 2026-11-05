<?php

session_start();
include_once "db.php";

$restaurant_initial = $pdo->query('SELECT id, naam, aantal_tafels, locatie, soort_eten, open_tijd, sluit_tijd, maximale_aantal_gasten, aantal_actieve_reserveringen, aantal_resterende_reserveringen FROM restaurant_list');
$restauranten = $restaurant_initial->fetchAll();
if (
    isset($_POST['naam']) and isset($_POST['telefoonnummer'])
    and isset($_POST['restaurant_name']) and isset($_POST['tijd'])
    and isset($_POST['datum']) and isset($_POST['aantal_personen']) and isset($_POST['special'])
) {
    $name_add = $_POST['naam'];
    $phone_add = $_POST['telefoonnummer'];
    $name_restaurant_add = $_POST['restaurant_name'];
    $time_add = $_POST['tijd'];
    $date_add = $_POST['datum'];
    $people_amount_add = $_POST['aantal_personen'];
    $special_add = $_POST['special'];

 $check = $pdo->prepare(' SELECT aantal_resterende_reserveringen FROM restaurant_list WHERE naam = :restaurant
');
$check->bindParam(':restaurant', $name_restaurant_add);
$check->execute();

$remaining = $check->fetch(PDO::FETCH_ASSOC);
if (!$remaining || $remaining['aantal_resterende_reserveringen'] <= 0) {
    ?> <a href="reservation.php">Reservering</a> <?php
    exit("Geen reserveringen meer beschikbaar voor dit restaurant.");

} else {
    $sth = $pdo->prepare('INSERT INTO restaurant_reservations (naam, telefoonnummer, naam_restaurant, datum, reserveringstijd, aantal_personen, speciale_verzoeken) 
    VALUES (:name_add, :phone_add, :name_restaurant_add, :date_add, :time_add, :people_amount_add, :special_add)');
    $sth->bindParam(':name_add', $name_add);
    $sth->bindParam(':phone_add', $phone_add);
    $sth->bindParam(':name_restaurant_add', $name_restaurant_add);
    $sth->bindParam(':time_add', $time_add);
    $sth->bindParam(':people_amount_add', $people_amount_add);
    $sth->bindParam(':special_add', $special_add);
    $sth->bindparam(':date_add', $date_add);
    $sth->execute();
    
    $update_reservation_left = $pdo->prepare(' UPDATE restaurant_list SET aantal_resterende_reserveringen = aantal_resterende_reserveringen - 1 WHERE naam = :restaurant');
    $update_reservation_left->bindParam(':restaurant', $name_restaurant_add);
    $update_reservation_left->execute();

    $update_reservation_active = $pdo->prepare('UPDATE restaurant_list SET aantal_actieve_reserveringen = aantal_actieve_reserveringen + 1 WHERE naam = :restaurant');
    $update_reservation_active->bindParam(':restaurant', $name_restaurant_add);
    $update_reservation_active->execute();

    header('Location: reservereing-overzicht.php');
}
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

    <h1>Plaats hier uw reservaties</h1>
    <div class="reservation-form">
    <form method="post">
    <select name="restaurant_name">
        <option value="">Naam restaurant</option>
        <?php foreach ($restauranten as $restaurant_form) {?>
        <option value="<?= $restaurant_form['naam'] ?>"> <?= $restaurant_form['naam'] ?></option>
        <?php } ?>
    </select><br>
    <input type="text" name="naam" placeholder="Naam"><br>
    <input type="text" name="telefoonnummer" placeholder="telefoonnummer"><br>
    <input type="date" name="datum" placeholder="Datum" max="9999:12:31"><br>
    <input type="time" name="tijd" placeholder="Tijd"><br>
    <input type="text" name="aantal_personen" placeholder="Aantal personen"><br>
    <input type="text" name="special" placeholder="Speciale verzoeken"><br>
    <input type="submit" value="reserveer">
    </form>
    </div>
</body>
</html>