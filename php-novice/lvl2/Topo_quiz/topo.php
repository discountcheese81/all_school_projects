<?php

$score = 0;
$countries_capitals = array("japan" => "Tokyo", "mexico" => "Mexico-stad", "de verenigde staten" => "Washington D.C.", "India" => "New Delhi",
"Zuid-Korea" => "Seoul", "China" => "Peking", "Nigeria" => "Abuja", "Argentinië" => "Buenos Aires", "Egypte" => "Cairo", "Engeland" => "Londen");
foreach ($countries_capitals as $country => $capital) {
    echo "wat is de hoofdstadd van $country? (let op: hoofdletter gevoelig) ";
    $p_input = readline();
    if ($p_input == $capital) {
        echo "correct!" . PHP_EOL;
        $score++;
    } else {
        echo "helaas dat is niet het antwoord, de hoofdstad van $country is $capital" . PHP_EOL;
    }
} echo "$score van de 10 goed";

?>