<?php
//detail page
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
$allowed = ['series', 'film'];
if (!in_array($type, $allowed)) {
    die("Invalid table");
}
$details = $pdo->prepare("SELECT * FROM media WHERE id=:id");
$details->bindParam(':id', $id);
$details->execute();
$info_ini = $details->fetch();
$awards = $info_ini['has_won_awards'];
$title = $info_ini['title'];
$seasons = $info_ini['seasons'];
$countries = $info_ini['country_of_origin'];
$languages = $info_ini['spoken_in_language'];
$rating = $info_ini['rating'];
$summary = $info_ini['summary'];
$released = $info_ini['released_at'];
$duur = $info_ini['length_in_minutes'];
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
    <?php
    echo "<h1><td><a href=index.php?id=$id>return</a></td></h1>";
    ?>
        <h2> <?= $title ?> </h2>
        <table>
            <th>information</th>
            <th>information</th>
        <?php 
        if ($type == 'series') {
            ?>
            <tr>
            <td>Awards</td>
            <td><?= $awards ?></td>
            </tr>
            <tr>
            <td>Seasons</td>
            <td><?= $seasons ?></td>
            </tr>
            <tr>
            <td>Country</td>
            <td><?= $countries ?></td>
            </tr>
            <tr>
            <td>Language</td>
            <td><?= $languages ?></td>
            </tr>
            <tr>
            <td>Rating</td>
            <td><?= $rating ?></td>
            </tr>
            <tr>
            <td> details</td>";
            <td><a href=edit.php?id=<?= $id ?>&type=<?= $type ?>> edit</a></td>
            </tr>
            <?php
        } else if ($type == 'film') {
            ?>
            <tr>
            <td>Datum van uitkomst</td>
            <td><?= $released ?></td>
            </tr>
            <tr>
            <td>land van uitkomst</td>
            <td><?= $countries ?></td>
            </tr>
            <tr>
            <td>duur</td>
            <td><?= $duur ?></td>
            </tr>
            <tr>
            <td>details</td>
            <td><a href=edit.php?id=<?= $id ?>&type=<?= $type ?>> edit</a></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <h2>Beschrijving</h2>
        <p><?= $summary ?></p>
    </body>
</html>