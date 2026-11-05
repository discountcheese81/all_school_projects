<?php

echo "wie zit er in de klas? splits de namen doormiddel van spaties ";
$namen = readline();
$result = explode(' ', $namen);
echo "de studenten in de klas zijn: " . PHP_EOL;
foreach ($result as $x => $y) {
    echo $y . PHP_EOL;
}

?>