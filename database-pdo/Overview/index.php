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
$shows = $pdo->query('SELECT Title, Rating FROM series');
$series = $shows->fetchAll();
$film_initial = $pdo->query('SELECT Title, duur FROM films');
$films = $film_initial->fetchALL();
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
        padding-left: 840px;
    }

    table {
    padding-left: 750px;
    }

    h1 {
    padding-left: 550px;
    }

    .bold_large {
        font-weight: bold;
    }

        </style>
    </head>
    <body>
        <h1 class="bold_large"> welkom op het netland beheerders paneel </h1>

        <h2> series </h2>
        <table>
        <th>Title</th>
        <th>Rating</th>
        <?php 
        foreach ($series as $B) {
            echo "<tr>";
            foreach ($B as $seriesinfo) {
                echo "<td>$seriesinfo</td>";
            }
            echo "</tr>";
        }
            
        ?>
        </table>
        <h2> films </h2>
        <table>
        <th>title</th>
        <th>duur</th>
        <?php
        foreach ($films as $movie_intermission) {
            echo "<tr>";
            foreach ($movie_intermission as $movie_information) {
                echo "<td> $movie_information </td>";
            }
            echo "</tr>";
        }
        ?>
        </table>
    </body>

</html>