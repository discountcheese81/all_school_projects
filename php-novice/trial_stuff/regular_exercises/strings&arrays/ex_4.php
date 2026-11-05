<?php

$score = 0;
$land = array(
"Japan" => "Tokyo",
"Mexico" => "Mexico-Stad",
"de Verenigde Staten" => "Washington D.C.",
"India" => "New Delhi",
"Zuid-Korea" => "Seoul",
"China" => "Peking",
"Nigeria" => "Abuja",
"Argentinië" => "Buenos Aires",
"Egypte" => "Cairo",
"Engeland" => "Londen"
);
foreach ($land as $cntry => $cap) {
    $answer = readline("wat is de hoofdstad van $cntry? ");
    if ($answer == $cap) {
        echo "jippee goed gedaan" . PHP_EOL;
        $score++;
    } else {
        echo "helaas het is fout" . PHP_EOL;
    }
} echo "je hebt $score van de 10 landen goed"

?>qsws