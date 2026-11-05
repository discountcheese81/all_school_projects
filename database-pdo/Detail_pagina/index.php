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
$shows = $pdo->query('SELECT title, rating, id FROM series');
$film_initial = $pdo->query('SELECT title, length_in_minutes, id FROM movies');
$films = $film_initial->fetchALL();
$series = $shows->fetchAll();
?>'
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

        </style>
    </head>
    <body>
        <h1 class="bold_large"> welkom op het netland beheerders paneel </h1>

        <h2> series </h2>
        <table method="_GET">
        <th>Title</th>
        <th>Rating</th>
        <th>details</th>
        <?php 
        foreach ($series as $B) {
            echo "<tr>";
            echo "<td>{$B['title']}</td>";
            echo "<td>{$B['rating']}</td>";
            echo "<td><a href=detail_serie.php?id={$B['id']}> details</a></td>";
            echo "</tr>";
        }
        ?>
        </table method="_GET">
        <h2> films </h2>
        <table>
        <th>title</th>
        <th>duur</th>
        <th>details</th>
        <?php
        foreach ($films as $movie_info) {
            echo "<tr>";
            echo "<td>{$movie_info['title']}</td>";
            echo "<td>{$movie_info['length_in_minutes']}</td>";
            echo "<td><a href=detail_film.php?id={$movie_info['id']}> details</a></td>";
            echo "</tr>";
        }
        ?>
        </table>
    </body>

</html>