<?php 

session_start();
include_once "../database/connection.php";
$login_check=$pdo->query("SELECT * FROM users");
$login_verify=$login_check->fetchAll();

if (isset($_POST['login'])) {
    if (!empty($_POST['username']) and !empty($_POST['password'])) {
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        foreach ($login_verify as $a) {
            if ($_POST['username'] == $a['user_name'] and password_verify($a['user_name'], $hashed_password)) {
                $user_id = $pdo->prepare('SELECT user_id FROM users WHERE user_name = :user_name');
                $user_id->bindParam(':user_name', $a['user_name']);
                $user_id->execute();
                $userid = $user_id->fetchcolumn();
                $_SESSION['user_id'] = $userid;
                $_SESSION['loggedinUser'] = $a['user_name'];
                header("Location: ../index.php");
                exit();
            } else {
                ?> <h1 style="color: red;"> Invalide gebruikersnaam/wachtwoord combinatie</h1> <?php
            }
            }
    } else {?> 
    <h1 style="color: red;">Geen gebruikersnaam/wachtwoord opgegeven</h1>
    <?php } ?>
<?php } ?>

<?php
    if (isset($_POST['logout'])) {
        unset($_SESSION['user_id']);
        unset($_SESSION['loggedinUser']);
    }
?>

<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>

<?php  if (isset($_SESSION['loggedinUser'])) { ?>
    <h1>hallo <?= $_SESSION['loggedinUser'] ?></h1>
<?php } else { ?>
    <h1> Not logged in </h1>    
<?php } ?>

<form method="post">
<label for="username">Username:</label><br>
<input type="text" name="username" id="username"><br>
<label for="password">password:</label><br>
<input type="password" name="password" id="password"><br>
<a href=../index.php>Cancel</a>
<input type="submit" name="login" value="log in">
<input type="submit" name="logout" value="log out">
</form>
</body>
</html>