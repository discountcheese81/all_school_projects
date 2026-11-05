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
    $titel_change = $_POST['titel'];
    $duur_change = $_POST['duur_minuten'];
    $datum_change = $_POST['datum_uitkomst'];
    $origin_change = $_POST['land_uitkomst'];
    $description_change = $_POST['omschrijving'];
    $yt_id_change = $_POST['yt_id'];
    $sth = $pdo->prepare("UPDATE movies SET title = :titel_change, length_in_minutes = :duur_change, released_at = :datum_change,
    country_of_origin = :origin_change, summary = :description_change, youtube_trailer_id = :yt_id_change WHERE id=:id");
    $sth->bindParam(':titel_change', $titel_change);
    $sth->bindParam(':duur_change', $duur_change);
    $sth->bindParam(':datum_change', $datum_change);
    $sth->bindParam(':origin_change', $origin_change);
    $sth->bindParam(':description_change', $description_change);
    $sth->bindParam(':yt_id_change', $yt_id_change);
    $sth->bindParam(':id', $id);
    $sth->execute();
}
$information_query = $pdo->query("SELECT title, length_in_minutes, released_at, country_of_origin, summary, youtube_trailer_id FROM movies WHERE id=$id");
$information = $information_query->fetch();
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

    textarea {
        width: 800px;
        height: 120px;
    }
    
        </style>
    </head>
    <body>
        <h2> <?php $information['title'] ?></h2>
            <h3><a href='detail_film.php?id=<?= $id ?>'>return</a></h3>
            <form method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label for="titel">Titel</label>
            <input type="text" id="titel" name="titel" placeholder="title" value="<?= $information['title'] ?>"><br>
            <label for="duur_minuten"> duur</label>
            <input type="text" id="duur_minuten" name="duur_minuten" placeholder="duur in minuten" value="<?=$information['length_in_minutes'] ?>"><br>
            <label for="datum_uitkomst"> datum van uitkomst</label>
            <input type="date" id="datum_uitkomst" name="datum_uitkomst" placeholder="datum van uitkomst"  value="<?=$information['country_of_origin'] ?>"><br>
            <label for="land_uitkomst">land van uitkomst</label>
            <input type="text" id="land_uitkomst" name="land_uitkomst" placeholder="land van uitkomst" value="<?=$information['country_of_origin']?>"><br>
            <label for="omschrijving"> omschrijving</label><br>
            <textarea id="omschrijving" name="omschrijving"> <?=$information['summary'] ?> </textarea><br>
            <label for="yt_id"> youtube trailer ID</label>
            <input type="text" id="yt_id" name="yt_id" placeholder="youtube id" value="<?= $information['youtube_trailer_id']?>"><br>
            <input type="submit">
        </form>
    </body>
</html>