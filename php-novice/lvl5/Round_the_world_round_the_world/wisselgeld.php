<?php

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
    exit("geen wisselgeld");
} else {
    $input = $argv[1];
    $p = floatval($input);
    if ($input != is_numeric($input)) {
        exit("geen wisselgeld");
    } else {
        foreach (MONEY_UNITS as $unit) {
            if ($p >= $unit) {
                    $count = floor($p / $unit);
                if ($unit >= 1) {
                        echo "$count X $unit euro" . PHP_EOL;
                } else if ($unit < 1) {
                        $unitCent = $unit * 100;
                        echo "$count X $unitCent cent" . PHP_EOL;
                }
                    $p = round($p / 0.05) * 0.05;
                    $p = fmod($p, $unit) + 0.00001;
                    var_dump($p);
            } else if ($p <= 0) {
                break;
            }  
        }
    }
}