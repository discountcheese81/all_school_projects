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
$info_query = $pdo->query("SELECT title, released_at, length_in_minutes,country_of_origin, summary, youtube_trailer_id FROM movies WHERE id=$id");
$info = $info_query->fetch();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>database PDO start</title>
        <style> 
    td, th {
        border: 1px solid black;
        padding: 10px;
    }
    h2 {
        text-align: center;
    }

    table {
    margin-left: auto;
    margin-right: auto;
    }

    h1 {
    text-align: center;
    }

    .bold_large {
        font-weight: bold;
    }

    p {
        width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    iframe {
        margin-left: auto;
        margin-right: auto;
    }
        </style>
    </head>
    <body>
    <h1><td><a href=index.php?id=<?= $id ?>>return</a></td></h1>
        <h2> <?= $info['title'] ?> </h2>
        <table>
            <th>information</th>
            <th>information</th>
            <tr>
            <td>Datum van uitkomst</td>
            <td><?= $info['released_at']?></td>
            </tr>
            <tr>
            <td>land van uitkomst</td>
            <td><?= $info['country_of_origin']?></td>
            </tr>
            <tr>
            <td>duur</td>
            <td><?= $info['length_in_minutes']?></td>
            </tr>
            <tr>
            <td> details</td>
            <td><a href="edit_film.php?id=<?= $id ?>"> edit</a></td>
            </tr>
        </table>
        <h2>Beschrijving</h2>
        <p><?= $info['summary']?></p>
        <iframe src=https://www.youtube.com/embed/<?= $info['youtube_trailer_id'] ?> title="youtube trialer"></iframe>
    </body>
</html>