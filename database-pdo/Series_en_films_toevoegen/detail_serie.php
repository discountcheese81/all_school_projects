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
$details = $pdo->query("SELECT title, has_won_awards,seasons,country, summary, spoken_in_language,rating FROM series WHERE id=$id");
$info = $details->fetch();
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
        </style>
    </head>
    <body>
    <h1><td><a href=index.php?id=<?= $id ?>>return</a></td></h1>
        <h2> <?php $info['title'] ?> </h2>
        <table>
            <th>information</th>
            <th>information</th>
            <tr>
            <td>Awards</td>
            <td><?= $info['has_won_awards'] ?></td>
            </tr>
            <tr>
            <td>Seasons</td>
            <td><?= $info['seasons'] ?></td>
            </tr>
            <tr>
            <td>Country</td>
            <td><?= $info['country'] ?></td>
            </tr>
            <tr>
            <td>Language</td>
            <td><?= $info['spoken_in_language'] ?></td>
            </tr>
            <tr>
            <td>Rating</td>
            <td><?= $info['rating'] ?></td>
            </tr>
            <tr>
            <td> details</td>
            <td><a href=edit_serie.php?id=<?= $id ?>> edit</a></td>
            </tr>
        </table>
        <h2>Beschrijving</h2>
            <p><?= $info['summary'] ?></p>
    </body>

</html>