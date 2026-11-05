<?php

include_once("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['naam']) && !empty($_POST['locatie']) && !empty($_POST['soort-eten']) && !empty($_POST['tijd-open']) && !empty($_POST['tijd-sluit']) && !empty($_POST['aantal_personen']) && !empty($_POST['aantal_tafels']) && !empty($_POST['aantal_resterende_reserveringen'])) {
        $naam = $_POST['naam'];
        $locatie = $_POST['locatie'];
        $soort_eten = $_POST['soort-eten'];
        $openingstijd = $_POST['tijd-open'];
        $sluitingstijd = $_POST['tijd-sluit'];
        $aantal_personen = $_POST['aantal_personen'];
        $aantal_tafels = $_POST['aantal_tafels'];
        $aantal_resterende_reservering = $_POST['aantal_resterende_reserveringen'];

        $statement = $pdo->prepare("SELECT COUNT(*) FROM restaurant_list WHERE naam = :naam");
        $statement->bindparam(':naam', $naam);
        $statement->execute();
        $count = $statement->fetchColumn();
        if ($count > 0) {
            echo "restaurant name '$naam' already exists.";
        } else {
            $insert = $pdo->prepare("INSERT INTO restaurant_list (naam, locatie, soort_eten, open_tijd, sluit_tijd, maximale_aantal_gasten, aantal_tafels, aantal_resterende_reserveringen) VALUES (:naam, :locatie, :soort_eten, :tijd_open, :tijd_sluit, :aantal_personen, :aantal_tafels, :aantal_resterende_reservering)");
            $insert->bindparam(':naam', $naam);
            $insert->bindparam(':locatie', $locatie);
            $insert->bindparam(':soort_eten', $soort_eten);
            $insert->bindparam(':tijd_open', $openingstijd);
            $insert->bindparam('tijd_sluit', $sluitingstijd);
            $insert->bindparam('aantal_personen', $aantal_personen);
            $insert->bindparam('aantal_tafels', $aantal_tafels);
            $insert->bindparam('aantal_resterende_reservering', $aantal_resterende_reservering);
            $insert->execute();
            
            header('Location: restaurant_overzicht.php');
        }
    } else { ?>
        <h1>fields cannot be empty!</h1>
   <?php }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="restaurant-regristeren.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<nav>
        <ul>
            <div class="nav-links">
                <div class="img-flag">
                <img src="img-flag-shop-flags-pride-inclusive-flag-1-2.webp" alt="pride flag">
                <Button><a href="contacten.php">terug</a></Button>
            </div>
        </ul>
    </nav>    
    <div class="register-form">
        <form method="post">

            <input type="text" name="naam" placeholder="Naam restaurant"><br>
            <input type="text" name="locatie" placeholder="locatie"><br>
            <input type="text" name="soort-eten" placeholder="Soort eten"><br>
            <label for="tijd-open">open tijd:</label><br>
            <input type="time" name="tijd-open" placeholder="open Tijd"><br>

            <label for="tijd-sluit">sluit tijd:</label><br>
            <input type="time" name="tijd-sluit" placeholder="sluit Tijd"><br>
            <input type="text" name="aantal_personen" placeholder="Max aantal personen"><br>
            <input type="text" name="aantal_tafels" placeholder="Max aantal tafels"><br>
            <input type="text" name="aantal_resterende_reserveringen" placeholder="aantal resterende reserveringen"><br>
            <input type="submit" value="registreer restaurant">
        </form>
    </div>
</body>
</html>