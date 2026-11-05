<?php

echo "hoeveel landen zal ik toevoegen? ";
$nmbr_cntry = readline();
if ($nmbr_cntry != is_numeric($nmbr_cntry)) {
    exit("$nmbr_cntry is geen geldig getal, probeer het opnieuw");
} else {
    for ($x = 1; $x <= $nmbr_cntry; $x++) {
        echo "welk land wil je toevoegen? " . PHP_EOL;
        $country = readline();
        echo "wat is de hoofdstad van $country? " . PHP_EOL;
        $capital = readline();
        $countries_and_capitals["$country"] = "$capital";
    }
    echo "de volgende landen en steden zitten in de database: " . PHP_EOL;
    foreach ($countries_and_capitals as $cntry => $cap) {
        echo "$cntry, $cap" . PHP_EOL;
    }
}

?>