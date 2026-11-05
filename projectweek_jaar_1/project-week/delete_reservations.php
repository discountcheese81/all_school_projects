<?php

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die();
}

include_once "db.php";
$id = $_GET['id'];
$reservering_initial = $pdo->query('SELECT id, naam, telefoonnummer, naam_restaurant, reserveringstijd, aantal_personen, speciale_verzoeken, datum FROM restaurant_reservations');
$reserveringen = $reservering_initial->fetchAll();
$check = $pdo->prepare('SELECT naam, id, naam_restaurant, reserveringstijd, datum FROM restaurant_reservations WHERE id = :id');
$check->bindParam(':id', $id);
$check->execute();
$checking = $check->fetch();
$name_restaurant = $checking['naam_restaurant'];
if (isset($_POST['confirm_delete'])) {
    if ($_POST['confirm_delete'] == 'ja') {
    $deleting = $pdo->prepare('DELETE FROM restaurant_reservations WHERE id = :id');
    $deleting->bindParam(':id', $id);
    $deleting->execute();
    $update_reservation_left = $pdo->prepare(' UPDATE restaurant_list SET aantal_resterende_reserveringen = aantal_resterende_reserveringen + 1 WHERE naam = :restaurant');
    $update_reservation_left->bindParam(':restaurant', $name_restaurant);
    $update_reservation_left->execute();

    $update_reservation_active = $pdo->prepare('UPDATE restaurant_list SET aantal_actieve_reserveringen = aantal_actieve_reserveringen - 1 WHERE naam = :restaurant');
    $update_reservation_active->bindParam(':restaurant', $name_restaurant);
    $update_reservation_active->execute();

    header("Location: reservereing-overzicht.php");
    exit;
    } else {
        header("Location: reservereing-overzicht.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="delete_reservations.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="confirmation_buttons">
    <button>weet je zeker dat je de reservatie van <?= $checking['naam'] ?> voor <?=  $checking['naam_restaurant'] ?> om <?= $checking['reserveringstijd']?> op <?= $checking['datum'] ?> wil deleten?</button>
<form method="POST">
    <button><input type="submit" name="confirm_delete" value="ja"></button>
    <button><input type="submit" name="confirm_delete" value="nee"></button>  
</form>
</div>
</body>
</html>