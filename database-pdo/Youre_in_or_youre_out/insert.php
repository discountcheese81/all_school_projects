<?php

session_start();
if (!isset($_SESSION['loggedinUser'])) {
    header('location:login.php');
    exit();
}

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
if (isset($_POST['media_type'])) {
    if ($_POST['media_type'] == 'series') {
        if (
            isset($_POST['titel'])
            and isset($_POST['rating'])
            and isset($_POST['omschrijving'])
            and isset($_POST['land_uitkomst'])
            and isset($_POST['awards'])
            and isset($_POST['seasons'])
            and isset($_POST['spoken_language'])
        ) {
            $titel_add = $_POST['titel'];
            $rating_add = $_POST['rating'];
            $description_add = $_POST['omschrijving'];
            $awards_add = $_POST['awards'];
            $seasons_add = $_POST['seasons'];
            $origin_add = $_POST['land_uitkomst'];
            $language_add = $_POST['spoken_language'];
            $sth = $pdo->prepare('INSERT INTO media (title, rating, has_won_awards, country_of_origin, summary, seasons, spoken_in_language, types) 
                VALUES (:titel_add, :rating_add, :awards_add, :origin_add, :description_add, :seasons_add, :language_add, "series")');
                $sth->bindParam(':titel_add', $titel_add);
                $sth->bindParam(':rating_add', $rating_add);
                $sth->bindParam(':awards_add', $awards_add);
                $sth->bindParam(':origin_add', $origin_add);
                $sth->bindParam(':description_add', $description_add);
                $sth->bindParam(':language_add', $language_add);
                $sth->bindParam(':seasons_add', $seasons_add);
                $sth->execute();
        }
    } else if ($_POST['media_type'] == 'film') { 
        if (isset($_POST['titel']) and isset($_POST['duur']) and (isset($_POST['release_date'])) and (isset($_POST['land_uitkomst'])) and isset($_POST['omschrijving']) and isset($_POST['yt_id'])) {
            $titel_add = $_POST['titel'];
            $duur_add = $_POST['duur'];
            $datum_add = $_POST['release_date'];
            $origin_add = $_POST['land_uitkomst'];
            $description_add = $_POST['omschrijving'];
            $yt_id_add = $_POST['yt_id'];
            $sth = $pdo->prepare('INSERT INTO media (title, length_in_minutes, released_at, country_of_origin, summary, youtube_trailer_id, types)
        VALUES (:titel_change, :duur_change, :datum_change, :origin_change, :description_change, :yt_id_change, "film")');
                $sth->bindParam(':titel_change', $titel_add);
                $sth->bindParam(':duur_change', $duur_add);
                $sth->bindParam(':datum_change', $datum_add);
                $sth->bindParam(':origin_change', $origin_add);
                $sth->bindParam(':description_change', $description_add);
                $sth->bindParam(':yt_id_change', $yt_id_add);
                $sth->execute();
        }
    }
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
        <h1>media toevoegen</h1>
        <button><a href='index.php'>return</a></button>
        <form method="post">
        <label for="titel">Titel</label>
        <input type="text" id="titel" name="titel"><br>

        <label for="rating"> rating</label>
        <input type="text" id="rating" name="rating" placeholder="alleen voor series"><br>

        <label for="omschrijving"> omschrijving</label>
        <input type="text" id="omschrijving" name="omschrijving"><br>

        <label for="awards"> awards</label>
        <input type="text" id="awards" name="awards" placeholder="alleen voor series"><br>

        <label for="duur"> lengte in minuten </label>
        <input type="text" id="duur" name="duur" placeholder="alleen voor films"><br>

        <label for="release_date"> release_date </label>
        <input type="date" id="release_date" name="release_date">alleen voor films<br>

        <label for="seasons"> seizoenen</label>
        <input type="text" id="seasons" name="seasons" placeholder="alleen voor series"><br>

        <label for="land_uitkomst">land van uitkomst</label>
        <input type="text" id="land_uitkomst" name="land_uitkomst"><br>

        <label for="spoken_language"> gesproken taal </label>
        <input type="text" id="spoken_language" name="spoken_language" placeholder="alleen voor series"><br>

        <label for="yt_id"> youtube trailer ID </label>
        <input type="text" id="yt_id" name="yt_id" placeholder="alleen voor films"><br>

        <label for="media_type">type media</label>
        <select name="media_type" id="media_type">
            <option value="movies">films</option>
            <option value="series">series</option>
        </select><br>
        <input type="submit">
        </form>
    </body>
</html>