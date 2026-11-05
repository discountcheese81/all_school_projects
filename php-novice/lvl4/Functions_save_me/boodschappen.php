<?php

$list = array();


function add_product(&$list)
{
    $product = readline("Wat wil je aan je boodschappenlijst toevoegen? ");
    array_push($list, $product);
}

function show_list($list)
{
    echo "Je boodschappen lijstje bevat nu:" . PHP_EOL;
    foreach ($list as $value) {
        echo $value . PHP_EOL;
    }
}

add_product($list);
show_list($list);

// Deze echo moet in het midden blijven staan
echo "Bedankt voor het gebruik van de boodschappenlijst!" . PHP_EOL;

while (strtolower(substr(trim(readline("Wil je meer producten toevoegen? (y/n)")), 0, 1)) === 'y') {
    add_product($list);
    show_list($list);
}
