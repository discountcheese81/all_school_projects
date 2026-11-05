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
if (
    isset($_POST['titel']) and isset($_POST['rating'])
    and isset($_POST['omschrijving']) and isset($_POST['land_uitkomst'])
    and isset($_POST['awards']) and isset($_POST['seasons']) and isset($_POST['spoken_language'])
) {
    $titel_add = $_POST['titel'];
    $rating_add = $_POST['rating'];
    $description_add = $_POST['omschrijving'];
    $awards_add = $_POST['awards'];
    $seasons_add = $_POST['seasons'];
    $origin_add = $_POST['land_uitkomst'];
    $language_add = $_POST['spoken_language'];
    $sth = $pdo->prepare('INSERT INTO series (title, rating, has_won_awards, country, summary, seasons, spoken_in_language) 
    VALUES (:titel_add, :rating_add, :awards_add, :origin_add, :description_add, :seasons_add, :language_add)');
    $sth->bindParam(':titel_add', $titel_add);
    $sth->bindParam(':rating_add', $rating_add);
    $sth->bindParam(':awards_add', $awards_add);
    $sth->bindParam(':origin_add', $origin_add);
    $sth->bindParam(':description_add', $description_add);
    $sth->bindParam(':language_add', $language_add);
    $sth->bindParam(':seasons_add', $seasons_add);
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
        <h1>serie toevoegen</h1>
           <button><a href='index.php'>return</a></button>
        <form method="post">
        <label for="titel">Titel</label>
        <input type="text" id="titel" name="titel"><br>

        <label for="rating"> rating</label>
        <input type="text" id="rating" name="rating"><br>

        <label for="awards"> awards</label>
        <input type="text" id="awards" name="awards"><br>

        <label for="land_uitkomst">land van uitkomst</label>
        <input type="text" id="land_uitkomst" name="land_uitkomst"><br>

        <label for="seasons"> seizoenen</label>
        <input type="text" id="seasons" name="seasons"><br>
        <label for="spoken_language"> gesproken taal </label>
        <input type="text" id="spoken_language" name="spoken_language"><br>

        <label for="omschrijving"> omschrijving</label>
        <input type="text" id="omschrijving" name="omschrijving"><br>
        <input type="submit">
        </form>
    </body>
</html>