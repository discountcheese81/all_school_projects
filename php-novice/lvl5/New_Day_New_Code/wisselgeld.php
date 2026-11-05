<?php

const MONEY_UNITS = [
    "50",
    "20",
    "10",
    "5",
    "2",
    "1"
];

if ($argc < 2) {
    exit("geen wisselgeld");
} else {
    $input = $argv[1];
    $p = intval($input);
    for ($k = 0; $k < $p + 5; $k++) {
        if ($input != is_numeric($input)) {
            exit("geen wisselgeld");
        } else {
            foreach (MONEY_UNITS as $unit) {
                if ($p >= $unit) {
                    $count = floor($p / $unit);
                    echo "$count X $unit euro" . PHP_EOL;
                    $p = $p % $unit;
                } else if ($p < 1) {
                    break;
                }  
            }
        }
    }
}

?>