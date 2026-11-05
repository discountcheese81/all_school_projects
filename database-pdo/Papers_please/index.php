<?php
session_start();

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
if (!isset($_GET['full_order'])) {
    $_GET['full_order'] = 'title';
}
if (!isset($_GET['full_order_by'])) {
    $_GET['full_order_by'] = 'asc';
}

$full_order = $_GET['full_order'];
$full_order_by = $_GET['full_order_by'];

$row_order_show = $_GET['row_order_show'];
$row_order_films = $_GET['row_order_films'];
$order_show = $_GET['order_show'];
$order_film = $_GET['order_films'];

$test_full_info = $pdo->query("SELECT * FROM media ORDER BY $full_order $full_order_by");
$full_info = $test_full_info->fetchAll();

if (isset ($_SESSION['loggedinUser'])) {
    $person = $_SESSION['loggedinUser'];
}


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

    div {
        text-align: center;
    }
        </style>
    </head>
    <body>
        <h1 class="bold_large"> welkom <?php if (isset($person)) {echo $person;} ?> op het netland beheerders paneel </h1>
        <h2> media </h2>
        <table>
        <th><a href=index.php?full_order=title&full_order_by=asc>title</a></th>
        <th><a href=index.php?full_order=length_in_minutes&full_order_by=desc>duur</a></th>
        <th><a href=index.php?full_order=rating&full_order_by=desc>Rating</a></th>
        <th>media type</th>
        <th>details</th>
        <?php
        foreach ($full_info as $c) {?>
        <tr>
        <td><?= $c['title'] ?></td>
        <td><?= $c['length_in_minutes'] ?></td>
        <td><?= $c['rating'] ?></td>
        <td><?= $c['types'] ?></td>
        <td><a href=detail.php?id=<?= $c['id'] ?>&type=<?= $c['types'] ?>> details</a></td>
        </tr>
        <?php } ?>
        </table>
        <div>
        <button><a href=insert.php>add media</button>
        <button><a href=login.php>inloggen</button>
        </div>
    </body>

</html>