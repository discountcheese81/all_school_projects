<?php

function round_to_05($p)
{
if ($p < 0.05 && $p > 0.03 && $p > 0) {
    $p = 0.05;
    coins($p, 0.05);
}
}
function exceptions($input, $argc, $argv)
{
    try {
        if ($argc != 2) {
            throw new Exception("Verkeerd aantal argumenten. Roep de applicatie op de volgende manier: 'php wisselgeld.php <bedrag>'");
        } else if ($argv[1] < 0) {
            throw new exception("geen wisselgeld, negatief bedrag");
        } else if ($input != is_numeric($input)) {
            throw new Exception("input moet een valide getal zijn");
        }
    } catch (Exception $e) {
        echo "" . PHP_EOL;
        $e->getMessage();
        echo $e . PHP_EOL;
        exit;
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
    $p = round($p * 2) / 2;
}
$input = $argv[1];
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
exceptions($input, $argc, $argv);
    $p = floatval($input);
foreach (MONEY_UNITS as $unit) {
        rounded($p);
        coins($p, $unit);
        $p = fmod($p, $unit) + 0.00001;
    if ($p <= 0) {
        break;
    }
    
}round_to_05($p);
