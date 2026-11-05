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
$details = $pdo->query("SELECT has_won_awards,seasons,country, summary, spoken_in_language,rating FROM series WHERE id=$id");
$title_query = $pdo->query("SELECT title FROM series WHERE id=$id");
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
            //foreach($B as $info_full) {
            echo "<tr>";
            echo "<td>Awards</td>";
            echo "<td>$B[has_won_awards]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Seasons</td>";
            echo "<td>$B[seasons]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Country</td>";
            echo "<td>$B[country]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Language</td>";
            echo "<td>$B[spoken_in_language]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Rating</td>";
            echo "<td>$B[rating]</td>";
            echo "</tr>";
            }
            //}

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