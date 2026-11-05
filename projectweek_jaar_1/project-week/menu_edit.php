<?php
session_start();
include_once "db.php";

if (!isset($_GET['id'])) {
    die("Geen ID opgegeven.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM menu WHERE id = ?");
$stmt->execute([$id]);
$info = $stmt->fetch();

if (!$info) {
    die("Menu-item niet gevonden.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $naam_restaurant = $_POST['naam_restaurant'];
    $naam_gerecht = $_POST['naam_gerecht'];
    $beschrijving = $_POST['beschrijving'];
    $prijs = $_POST['prijs'];
    $categorie = $_POST['categorie'];
    $update_menu = $pdo->prepare(" UPDATE menu SET naam_restaurant = :naam_restaurant, naam_gerecht = :naam_gerecht, beschrijving = :beschrijving, prijs = :prijs, categorie = :categorie WHERE id = :id
    ");
    $update_menu->bindParam(':naam_restaurant', $naam_restaurant);
    $update_menu->bindParam(':naam_gerecht', $naam_gerecht);
    $update_menu->bindParam(':beschrijving', $beschrijving);
    $update_menu->bindParam(':prijs', $prijs);
    $update_menu->bindParam(':categorie', $categorie);
    $update_menu->bindParam(':id', $id);
    
    
    
    $update_menu->execute();

    header("Location: menu_overzicht.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu-item bewerken</title>
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>

<nav>
    <ul>
        <div class="nav-links">
            <div class="img-flag">
                <img src="img-flag-shop-flags-pride-inclusive-flag-1-2.webp" alt="pride flag">
                <button><a href="index.php">Home</a></button>
                <button><a href="reservation.php">Reservering</a></button>
                <button><a href="reservereing-overzicht.php">Reservering overzicht</a></button>
                <button><a href="restaurant_overzicht.php">Restaurant overzicht</a></button>
                <button><a href="menu_overzicht.php">Menu overzicht</a></button>
            </div>
        </div>
    </ul>
</nav>

<form method="POST">
    <h1>Menu-item bewerken</h1>

    <label for="naam_restaurant">Naam restaurant:</label>
    <input type="text" name="naam_restaurant" id="naam_restaurant" value="<?= htmlspecialchars($info['naam_restaurant']) ?>"><br>

    <label for="naam_gerecht">Naam gerecht:</label>
    <input type="text" name="naam_gerecht" id="naam_gerecht" value="<?= htmlspecialchars($info['naam_gerecht']) ?>"><br>

    <label for="beschrijving">Beschrijving:</label>
    <textarea name="beschrijving" id="beschrijving"><?= htmlspecialchars($info['beschrijving']) ?></textarea><br>

    <label for="prijs">Prijs (€):</label>
    <input type="number" step="0.01" name="prijs" id="prijs" value="<?= htmlspecialchars($info['prijs']) ?>"><br>

    <label for="categorie">Categorie:</label>
    <input type="text" name="categorie" id="categorie" value="<?= htmlspecialchars($info['categorie']) ?>"><br>

    <button type="submit">Opslaan</button>
</form>

</body>
</html>
