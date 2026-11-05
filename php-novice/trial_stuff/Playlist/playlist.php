<?php

$cont = 'ja';
$A_and_S = [];
while ($cont == 'ja') {
    $artist = readline("voer de naam van de artiest in: ");
    $song = readline("voer de naam in van het liedje van $artist: ");
    $A_and_S += ["$artist" => "$song"];
    $cont = readline("wilt u nog meer artiesten en liedjes toevoegen? (ja/nee)");
} foreach ($A_and_S as $artist_array => $song_array) {
    echo "$artist_array met het liedje: $song_array" . PHP_EOL;
}

?>