<?php 

session_start();

?>


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
$login_check=$pdo->query("SELECT * FROM gebruikers");
$login_verify=$login_check->fetchAll();

if (isset ($_POST['username']) and isset ($_POST['password'])) {
    foreach ($login_verify as $a) {
        if ($_POST['username'] == $a['username'] and $_POST['password'] == $a['password']) {
            $_SESSION['loggedinUser'] = $a['username'];
            header("Location: index.php");
            exit();
        } else {
            ?> <h1 style="color: red;"> Invalide gebruikersnaam/wachtwoord combinatie</h1> <?php
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h1>Netland Admin Panel</h1>

<form method="post">
<input type="text" name="username" id="username"></input>
<input type="text" name="password" id="password"></input>
<input type=submit></input>

</form>
<button><a href=index.php>terug</button>
</body>
</html>