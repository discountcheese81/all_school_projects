<?php

$totaal = 0;
$temperatuur_eenheid = readline("welke temperatuur eenheid wil je gebruiken? ");
$amount_of_rooms = readline("hoeveel kamers wil je de gemiddelde temperatuur van berekenen? ");
for ($i = 1; $i <= $amount_of_rooms; $i++) {
    $input = readline("wat is de temperatuur van kamer $i? ");
    $totaal = $totaal += $input;
}  
$gemiddelde_temperatuur = $totaal / $amount_of_rooms;
echo "de gemiddelde temperatuur van $amount_of_rooms kamers is $gemiddelde_temperatuur $temperatuur_eenheid";

?>