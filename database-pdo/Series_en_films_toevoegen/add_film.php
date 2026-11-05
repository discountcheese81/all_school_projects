<?php

$host = 'localhost';
$db   = 'netland';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $options);
$id = $_GET['id'];
if (
    isset($_POST['titel']) and isset($_POST['duur_minuten'])
    and isset($_POST['datum_uitkomst']) and isset($_POST['land_uitkomst']) and isset($_POST['omschrijving']) and isset($_POST['yt_id'])
) {
    $titel_add = $_POST['titel'];
    $duur_add = $_POST['duur_minuten'];
    $datum_add = $_POST['datum_uitkomst'];
    $origin_add = $_POST['land_uitkomst'];
    $description_add = $_POST['omschrijving'];
    $yt_id_add = $_POST['yt_id'];
    $sth = $pdo->prepare('INSERT INTO movies (title, length_in_minutes, released_at, country_of_origin, summary, youtube_trailer_id)
    VALUES (:titel_change, :duur_change, :datum_change, :origin_change, :description_change, :yt_id_change)');
    $sth->bindParam(':titel_change', $titel_add);
    $sth->bindParam(':duur_change', $duur_add);
    $sth->bindParam(':datum_change', $datum_add);
    $sth->bindParam(':origin_change', $origin_add);
    $sth->bindParam(':description_change', $description_add);
    $sth->bindParam(':yt_id_change', $yt_id_add);
    $sth->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>database PDO start</title>
        <style> 
    input {
        border: 1px solid black;
        padding: 10px;
    }

    .bold_large {
        font-weight: bold;
}

        </style>

    </head>
    <body>
        <h1>toevoegen films </h1>
            <button><a href='index.php'>return</a></button>
        <form method="post">
            <label for="titel">Titel</label>
            <input type="text" id="titel" name="titel"><br>
            
            <label for="duur_minuten"> duur</label>
            <input type="text" id="duur_minuten" name="duur_minuten"><br>
            
            <label for="datum_uitkomst"> datum van uitkomst</label>
             <input type="date" id="datum_uitkomst" name="datum_uitkomst"><br>
            
            <label for="land_uitkomst">land van uitkomst</label>
            <input type="text" id="land_uitkomst" name="land_uitkomst"><br>
            
            <label for="omschrijving"> omschrijving</label>
            <input type="text" id="omschrijving" name="omschrijving"><br>
            
            <label for="yt_id"> youtube trailer ID</label>
            <input type="text" id="yt_id" name="yt_id"><br>
            
            <input type="submit">
        </form>
    </body>
</html>