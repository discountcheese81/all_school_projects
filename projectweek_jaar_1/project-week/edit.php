<?php

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die();
}

include_once "db.php";

if (!isset($_GET['id'])) {
    die("Geen ID opgegeven.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM restaurant_list WHERE id = ?");
$stmt->execute([$id]);
$info = $stmt->fetch();

if (!$info) {
    die("Restaurant niet gevonden.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $naam = $_POST['naam'];
    $aantal_tafels = $_POST['aantal_tafels'];
    $locatie = $_POST['locatie'];
    $soort_eten = $_POST['soort_eten'];
    $open_tijden = $_POST['open_tijden'];
    $sluit_tijd = $_POST['sluit_tijd'];
    $maximale_aantal_gasten = $_POST['maximale_aantal_gasten'];
    $aantal_actieve_reserveringen = $_POST['aantal_actieve_reserveringen'];
    $aantal_resterende_reserveringen = $_POST['aantal_resterende_reserveringen'];

    $stmt = $pdo->prepare(" UPDATE restaurant_list SET 
            naam = ?,
            aantal_tafels = ?,
            locatie = ?,
            soort_eten = ?,
            open_tijd = ?,
            sluit_tijd = ?,
            maximale_aantal_gasten = ?,
            aantal_actieve_reserveringen = ?,
            aantal_resterende_reserveringen = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $naam,
        $aantal_tafels,
        $locatie,
        $soort_eten,
        $open_tijden,
        $sluit_tijd,
        $maximale_aantal_gasten,
        $aantal_actieve_reserveringen,
        $aantal_resterende_reserveringen,
        $id
    ]);

    header("Location: restaurant_overzicht.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Bewerken</title>
    <link rel="stylesheet"href="edit.css">
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

    
<form method="POST">
<h1>Restaurant Bewerken</h1>
<label for="naam">Naam:</label>
<input type="text" name="naam" id="naam" value="<?= htmlspecialchars($info['naam']) ?>"><br>

<label for="aantal_tafels">Aantal tafels:</label>
<input type="number" name="aantal_tafels" id="aantal_tafels" value="<?= htmlspecialchars($info['aantal_tafels']) ?>"><br>

<label for="locatie">Locatie:</label>
<input type="text" name="locatie" id="locatie" value="<?= htmlspecialchars($info['locatie']) ?>"><br>

<label for="soort_eten">Soort eten:</label>
<input type="text" name="soort_eten" id="soort_eten" value="<?= htmlspecialchars($info['soort_eten']) ?>"><br>

<label for="open_tijden">Open tijden:</label>
<input type="time" name="open_tijden" id="open_tijden" value="<?= htmlspecialchars($info['open_tijd']) ?>"><br>

<label for="sluit_tijd">Sluit tijd:</label>
<input type="time" name="sluit_tijd" id="sluit_tijd" value="<?= htmlspecialchars($info['sluit_tijd']) ?>"><br>

<label for="maximale_aantal_gasten">Maximaal aantal gasten:</label>
<input type="number" name="maximale_aantal_gasten" id="maximale_aantal_gasten" value="<?= htmlspecialchars($info['maximale_aantal_gasten']) ?>"><br>

<label for="aantal_actieve_reserveringen">Actieve reserveringen:</label>
<input type="number" name="aantal_actieve_reserveringen" id="aantal_actieve_reserveringen" value="<?= htmlspecialchars($info['aantal_actieve_reserveringen']) ?>"><br>

<label for="aantal_resterende_reserveringen">Resterende reserveringen:</label>
<input type="number" name="aantal_resterende_reserveringen" id="aantal_resterende_reserveringen" value="<?= htmlspecialchars($info['aantal_resterende_reserveringen']) ?>"><br>

<button type="submit">Opslaan</button>

</form>
</body>
</html>