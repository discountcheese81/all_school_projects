<?php

function parseToInteger($value)
{
    // Schrijf jouw code hier
    if ($value != is_numeric($value)) {
        return("input moet een valide getal zijn");
    } else {
        $ParseToIntegerval = intval($value);
        return($ParseToIntegerval);
    }
}

// Pas de code hieronder niet aan!

echo parseToInteger(10) . PHP_EOL;
echo parseToInteger("101") . PHP_EOL;
echo parseToInteger("Hallo wereld!") . PHP_EOL;
