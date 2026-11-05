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
if (!isset($_GET['row_order_films'])) {
    $_GET['row_order_films'] = 'length_in_minutes';
}
if (!isset($_GET['row_order_show'])) {
    $_GET['row_order_show'] = 'rating';
}
if (!isset($_GET['order_films'])) {
    $_GET['order_films'] = 'asc';
}
if (!isset($_GET['order_show'])) {
    $_GET['order_show'] = 'asc';
}
$row_order_show = $_GET['row_order_show'];
$row_order_films = $_GET['row_order_films'];
$order_show = $_GET['order_show'];
$order_film = $_GET['order_films'];
$shows = $pdo->query("SELECT title, rating, id FROM series ORDER BY $row_order_show $order_show");
$film_initial = $pdo->query("SELECT title, length_in_minutes, id FROM movies ORDER BY $row_order_films $order_film");
$films = $film_initial->fetchALL();
$series = $shows->fetchAll();
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

    .button {
    display: flex;
    justify-content: center;
    gap: 2px;
    }

        </style>
    </head>
    <body>
        <h1 class="bold_large"> welkom op het netland beheerders paneel </h1>

        <h2> series </h2>
        <table method="_POST">
        <th><a href=index.php?row_order_show=title&row_order_films=<?= $row_order_films ?>&order_show=asc&order_films=<?= $order_film ?>>title</a></th>
        <th><a href=index.php?order_show=desc&order_films=<?= $order_film ?>&row_order_films=<?= $row_order_films ?>>Rating</a></th>
        <th>details</th>
        <?php foreach ($series as $B) { ?>
            <tr>
            <td><?= $B['title'] ?></td>
            <td><?= $B['rating'] ?></td>
            <td><a href=detail_serie.php?id=<?= $B['id']?>> details</a></td>
            </tr>
        <?php }
        ?>
        </table method="_GET">
        <h2> films </h2>
        <table>
        <th><a href=index.php?row_order_films=title&row_order_show=<?= $row_order_show ?>&order_films=asc&order_show=<?= $order_show ?>>title</a></th>
        <th><a href=index.php?order_films=desc&order_show=<?= $order_show ?>&row_order_show=<?= $row_order_show ?>>duur</a></th>
        <th>details</th>
        <?php foreach ($films as $movie_info) {?>
            <tr>
            <td><?= $movie_info['title'] ?></td>
            <td><?= $movie_info['length_in_minutes'] ?></td>
            <td><a href=detail_film.php?id=<?= $movie_info['id'] ?>> details</a></td>
            </tr>
        <?php }
        ?>
        </table>
        <div class="button">
        <button><a href=add_serie.php>add serie</button>
        <button><a href=add_film.php> add film </button>
        </div>


    </body>

</html>