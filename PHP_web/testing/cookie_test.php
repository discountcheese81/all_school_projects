<?php
session_start();

if (!isset($_SESSION['refresh'])) {
$_SESSION['refresh']=0;
}
$_SESSION['refresh']++;

?>
<!doctype html>
<html> 
    <head> 
        <title>cookies zetten</title> 
        <style>body {font-weight: bold; color: white; text-align: center; background-color: darkblue;}</style>
    </head> 
    <body> 
        <h1><?php echo "je hebt deze pagina $_SESSION[refresh] bezocht";?></h1>
    </body> 
</html>