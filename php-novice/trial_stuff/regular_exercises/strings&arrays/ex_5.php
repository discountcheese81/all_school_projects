<?php

$continue = "Y";
$i = 0;
$totaal = 0;
$array_test = [];
$valuta = readline("welke gelds eenheid wil je gebruiken? ");
while ($continue == "Y" or $continue == "y") {
    $item = readline("wat voor item wil je toevoegen? ");
    $item_price = readline("hoeveel kost $item in $valuta? ");
    $array_test ["$item"] = "$item_price";
    $continue = readline("wil je meer items toevoegen?(Y/N) ");
}

foreach($array_test as $food => $price) {
    $totaal = $totaal += $price;  
    $i++;  
}
$gemiddelde_prijs = $totaal / $i;
echo "de prijs van het lijstje is in totaal: $totaal" . PHP_EOL;
echo "en de gemiddelde prijs is: $gemiddelde_prijs $valuta" . PHP_EOL; 

?>