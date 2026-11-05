<?php

session_start();
include_once "db.php";
$id = $_GET['id'];
$menu_initial = $pdo->query('SELECT id,naam_restaurant, naam_gerecht, beschrijving, prijs, categorie FROM menu');
$menu_information = $menu_initial->fetch();
$check = $pdo->prepare('SELECT naam_gerecht, id, naam_restaurant, naam_gerecht, beschrijving, prijs, categorie FROM menu WHERE id = :id');
$check->bindParam(':id', $id);
$check->execute();
$checking = $check->fetch();
if (isset($_POST['confirm_delete'])) {
    if ($_POST['confirm_delete'] == 'ja') {
    $deleting = $pdo->prepare('DELETE FROM menu WHERE id = :id');
    $deleting->bindParam(':id', $id);
    $deleting->execute();
    
    header("Location: menu_overzicht.php");
    exit;
    } else {
        header("Location: menu-overzicht.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="delete_reservations.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="confirmation_buttons">
    <button>weet je zeker dat je het gerecht <?= $checking['naam_gerecht'] ?> dat <?=  $checking['prijs'] ?> kost van het restaurant <?= $checking['naam_restaurant']?> wil deleten?</button>
<form method="POST">
    <button><input type="submit" name="confirm_delete" value="ja"></button>
    <button><input type="submit" name="confirm_delete" value="nee"></button>  
</form>
</div>
</body>
</html>