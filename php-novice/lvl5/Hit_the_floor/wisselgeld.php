<?php

if ($argc < 2) {
    exit("geen wisselgeld");
} else {
    $input = $argv[1];
    $p = intval($input);
    for ($k = 0; $k < $p + 5; $k++) {
        if ($input != is_numeric($input)) {
            exit("geen wisselgeld");
        } else if ($p >= 10) {
            $s = floor($p / 10);
            echo "$s X 10 euro" . PHP_EOL;
            $p = $p - ($s * 10);
        } else if ($p >= 5) {
            $r = floor($p / 5);
            echo "$r X 5 euro" . PHP_EOL;
            $p = $p - ($r * 5); 
        } else if ($p >= 2) {
            $q = floor($p / 2);
            echo "$q X 2 euro" . PHP_EOL;
            $p = $p - ($q * 2);
        } else if ($p >= 1) {
            echo "$p X 1 euro" . PHP_EOL;
            $p = $p - $p;
        }
    }
}

?>