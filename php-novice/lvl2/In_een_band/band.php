<?php

$total = 0;
$avg = 0;
$albums_and_price = array("blood and dust" => "4", "peace and prosperity" => "3", "bard's banquet" => "5", "ballad of the forgotten prince" => "6");
$amount_of_things = count($albums_and_price);
foreach ($albums_and_price as $names => $prices) {
    echo "$names kost: €$prices" . PHP_EOL;
    $total = $total + $prices;
    $avg = $avg + $prices;
    $full_avg = $avg / $amount_of_things;
}
    echo "het totaalbedrag van alle albums is €$total" . PHP_EOL;
    echo "de gemiddelde prijs van het overzicht is €$full_avg" . PHP_EOL;

?>