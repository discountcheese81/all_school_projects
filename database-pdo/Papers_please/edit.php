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
$type = $_GET['type'];
if ($type == 'series') { 
    if (
        isset($_POST['titel']) and isset($_POST['rating']) and isset($_POST['awards']) and isset($_POST['land_uitkomst'])
        and isset($_POST['omschrijving']) and isset($_POST['seasons']) and isset($_POST['spoken_language'])
    ) {
        $titel_change = $_POST['titel'];
        $rating_change = $_POST['rating'];
        $description_change = $_POST['omschrijving'];
        $awards_change = $_POST['awards'];
        $seasons_change = $_POST['seasons'];
        $origin_change = $_POST['land_uitkomst'];
        $language_change = $_POST['spoken_language'];
        $sth = $pdo->prepare("UPDATE media SET title = :titel_change,
        rating = :rating_change, summary = :description_change, has_won_awards = :awards_change, country_of_origin = :origin_change, seasons = :seasons_change,
        spoken_in_language = :language_change WHERE id = :id");
        $sth->bindParam('titel_change', $titel_change);
        $sth->bindParam('rating_change', $rating_change);
        $sth->bindParam('description_change', $description_change);
        $sth->bindParam('origin_change', $origin_change);
        $sth->bindParam('awards_change', $awards_change);
        $sth->bindParam('seasons_change', $seasons_change);
        $sth->bindParam('language_change', $language_change);
        $sth->bindParam('id', $id);
        $sth->execute();
    }
}

$information_query = $pdo->query("SELECT title, rating, summary, has_won_awards, seasons, country_of_origin, spoken_in_language FROM media WHERE id=$id");
$information_series = $information_query->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>database PDO start</title>
    <style>
        td,
        th {
            border: 1px solid black;
            padding: 10px;
        }

        h2 {
            text-align: center;
        }

        label {
            padding-right: 50px;
        }

        h1 {
            text-align: center;
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
    <h2> <?= $information_series['title'] ?></h2>
    <p><a href='detail.php?id=<?= $id ?>&type=<?= $type ?>'>return</a></p>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>">
        <label for="titel">Titel</label>
        <input type="text" id="titel" name="titel" value="<?= $information_series['title'] ?>"><br>
        <label for="rating"> rating</label>
        <input type="text" id="rating" name="rating" value="<?= $information_series['rating']?>"><br>
        <label for="awards"> awards</label>
        <input type="text" id="awards" name="awards" value="<?= $information_series['has_won_awards']?>"><br>
        <label for="land_uitkomst">land van uitkomst</label>
        <input type="text" id="land_uitkomst" name="land_uitkomst" value="<?= $information_series['country_of_origin'] ?>"><br>
        <label for="seasons"> seizoenen</label>
        <input type="text" id="seasons" name="seasons" value="<?= $information_series['seasons'] ?>"><br>
        <label for="spoken_language"> gesproken taal </label>
        <input type="text" id="spoken_language" name="spoken_language" value="<?= $information_series['spoken_in_language'] ?>"><br>
        <label for="omschrijving"> omschrijving</label><br>
        <textarea id="omschrijving" name="omschrijving"><?= $information_series['summary'] ?></textarea><br>
        <input type="submit">
    </form>
</body>

</html>