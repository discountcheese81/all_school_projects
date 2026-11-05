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
$check = $pdo->prepare('SELECT * FROM restaurant_list WHERE id = :id');
$check->bindParam(':id', $id);
$check->execute();
$checking = $check->fetch();
if (isset($_POST['confirm_delete'])) {
    if ($_POST['confirm_delete'] == 'ja') {
    $deleting = $pdo->prepare('DELETE FROM restaurant_list WHERE id = :id');
    $deleting->bindParam(':id', $id);
    $deleting->execute();
    
    header("Location: restaurant_overzicht.php");
    exit;
    } else {
        header("Location: restaurant_overzicht.php");
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
    <button>weet je zeker dat je het restaurant <?= $checking['naam'] ?> op de locatie <?= $checking['locatie'] ?> die <?=  $checking['soort_eten'] ?> eten serveert van <?= $checking['open_tijd']?> tot <?= $checking['sluit_tijd'] ?> wil deleten?</button>
<form method="POST">
    <button><input type="submit" name="confirm_delete" value="ja"></button>
    <button><input type="submit" name="confirm_delete" value="nee"></button>  
</form>
</div>
</body>
</html>