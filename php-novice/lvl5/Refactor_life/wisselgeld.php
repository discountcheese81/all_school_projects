<?php

function valid_input($input)
{
    if ($input != is_numeric($input)) {
        exit("geen wisselgeld");
    }
}
function coins($p, $unit) 
{
    if ($p >= $unit) {
                    $count = floor($p / $unit);
        if ($unit >= 1) {
                        echo "$count X $unit euro" . PHP_EOL;
        } else if ($unit < 1) {
            $unitCent = $unit * 100;
            echo "$count X $unitCent cent" . PHP_EOL;
        }
    }
}
function rounded($p)
{
    $p = round($p / 0.05) * 0.05;
}

const MONEY_UNITS = [
    50,
    20,
    10,
    5,
    2,
    1,
    0.5,
    0.2,
    0.1,
    0.05,
];

if ($argc < 2) {
    exit("geen wisselgeld, geen input ontvangen");
} else {
    $input = $argv[1];
    if ($input < 0) {
        exit("geen wisselgeld, negatief bedrag");
    } else {
    $p = floatval($input);
    valid_input($input);
    foreach (MONEY_UNITS as $unit) {
            coins($p, $unit);
            rounded($p);
            $p = fmod($p, $unit) + 0.00001;
        if ($p <= 0) {
            break;
        }
    }
    if ($p < 0.05 && $p > 0) {
        $p = 0.05;
        coins($p, 0.05);
    }
}
}