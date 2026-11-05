<?php 

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die();
}

include_once "db.php";

$id=$_GET['id'];

if (
    isset($_POST['naam']) and isset($_POST['telefoonnummer']) and isset($_POST['restaurant_name']) and isset($_POST['telefoonnummer'])
    and isset($_POST['reserveringstijd']) and isset($_POST['datum']) and isset($_POST['aantal_personen']) and ($_POST['speciale_verzoeken']))
{
    $name_change = $_POST['naam'];
    $phone_change = $_POST['telefoonnummer'];
    $restaurant_name_change = $_POST['restaurant_name'];
    $date_change = $_POST['datum'];
    $time_change = $_POST['reserveringstijd'];
    $people_change = $_POST['aantal_personen'];
    $special_change = $_POST['speciale_verzoeken'];
    $sth = $pdo->prepare("UPDATE restaurant_reservations SET naam = :name_change,
    telefoonnummer= :phone_change, naam_restaurant= :restaurant_name_change, datum= :date_change, reserveringstijd= :time_change, aantal_personen= :people_change, speciale_verzoeken= :special_change WHERE id = :id");
    $sth->bindParam('name_change', $name_change);
    $sth->bindParam('phone_change', $phone_change);
    $sth->bindParam('restaurant_name_change', $restaurant_name_change);
    $sth->bindParam('date_change', $date_change);
    $sth->bindParam('time_change', $time_change);
    $sth->bindParam('people_change', $people_change);
    $sth->bindParam('special_change', $special_change);
    $sth->bindParam('id', $id);
    $sth->execute();
    
    header('Location: reservereing-overzicht.php');
} else { ?>
        <h1>fields cannot be empty!</h1>
   <?php }
$restaurant_initial = $pdo->query('SELECT id, naam, aantal_tafels, locatie, soort_eten, open_tijd, sluit_tijd, maximale_aantal_gasten, aantal_actieve_reserveringen, aantal_resterende_reserveringen FROM restaurant_list');
$restauranten = $restaurant_initial->fetchAll();
$reservation_initial = $pdo->prepare('SELECT id, naam, telefoonnummer, naam_restaurant, datum, reserveringstijd, aantal_personen, speciale_verzoeken FROM restaurant_reservations WHERE id = :reservation_id');
$reservation_initial->bindParam(':reservation_id', $id);
$reservation_initial->execute();
$reservation_info = $reservation_initial->fetch();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservering edit pagina</title>
    <link rel="stylesheet" href="edit-reservering.css">
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
            </div>
        </ul>
    </nav>

    <div class="edit_reservation">
    <form method="post">
    <select name="restaurant_name">
        <option value="<?= $reservation_info['naam_restaurant'] ?>"><?= $reservation_info['naam_restaurant'] ?></option>
        <?php foreach ($restauranten as $restaurant_form) {?>
        <option value="<?= $restaurant_form['naam'] ?>"> <?= $restaurant_form['naam'] ?></option>
        <?php } ?>
    </select><br>
<label for="naam">naam</label>
<input type="text" name="naam" value="<?= $reservation_info['naam']; ?>"> </input><br>
<label for="telefoonnummer">telefoon nummer</label>
<input type="text" name="telefoonnummer" value="<?= $reservation_info['telefoonnummer']; ?>"> </input><br>
<label for="reserveringsijd">reserverings tijd</label>
<input type="time" name="reserveringstijd" value="<?= $reservation_info['reserveringstijd']; ?>"> </input><br>
<label for="datum">datum</label>
<input type="date" name="datum" value="<?= $reservation_info['datum']; ?>"> </input><br>
<label for="aantal_personen">aantal personen</label>
<input type="text" name="aantal_personen" value="<?= $reservation_info['aantal_personen']; ?>"> </input><br>
<label for="speciale_verzoeken">speciale verzoeken</label>
<input type="text" name="speciale_verzoeken" value="<?= $reservation_info['speciale_verzoeken']; ?>"> </input><br>
<input type="submit" value="pas aan" ></input><br>
</form>
</div>
</body>
</html>