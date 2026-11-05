<?php

$succeed = false;
$totaal = 0;
if ($argc < 2) {
    exit("geen argumenten meegegeven.");
}
for ($i = 1; $i < $argc; $i++) {
    $a = substr($argv[$i], -1);
    $c = (int)substr($argv[$i], 0, -1);
    switch ($a) {
        case "d":
            $ds = $c * 86400; 
            echo "$ds seconden" . PHP_EOL;
            $totaal += $ds;
            $succeed = true;
            break;
        case "u":
            $us = $c * 3600; 
            echo "$us seconden" . PHP_EOL; 
            $totaal += $us;
            $succeed = true;
            break;
        case "m":
            $ms = $c * 60;
            echo "$ms seconden" . PHP_EOL;
            $totaal += $ms;
            $succeed = true;
            break;
        case "s":
            $ss = $c;
            echo "$ss seconden" . PHP_EOL;
            $totaal += $ss;
            $succeed = true;
            break;
        default:
            echo "geen gepaste tijd aangegeven, de tijd is 0 seconden." . PHP_EOL;
            $succeed = false;
    }
}
echo "totaal aantal seconden: $totaal";
