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
$details = $pdo->query("SELECT released_at, length_in_minutes,country_of_origin, summary, youtube_trailer_id FROM movies WHERE id=$id");
$title_query = $pdo->query("SELECT title FROM movies WHERE id=$id");
$info_ini = $details->fetchALL();
$title_ini = $title_query->fetchALL();
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
        <h2> <?php foreach ($title_ini as $C) {
            foreach ($C as $title) {
                echo $title;
            }
             }?> </h2>
        <table>
            <th>information</th>
            <th>information</th>
        <?php 
        foreach ($info_ini as $B) {
            echo "<tr>";
            echo "<td>Datum van uitkomst</td>";
            echo "<td>{$B['released_at']}</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>land van uitkomst</td>";
            echo "<td>{$B['country_of_origin']}</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>duur</td>";
            echo "<td>{$B['length_in_minutes']}</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> details</td>";
            echo "<td><a href=edit_film.php?id=$details_info[id]> edit</a></td>";
            echo "</tr>";
        }   
        ?>
        </table>
        <h2>Beschrijving</h2>
        <?php
        foreach ($info_ini as $C) {
            echo "<p>{$C['summary']}</p>";
        }
        ?>
    </body>
</html>