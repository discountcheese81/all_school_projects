<?php

$klaslokaal = array();
$kantoor = array();
$gang = array();

$day = 1;
$aantal_dagen = readline("hoeveel dagen wil je invullen? ");
for ($i = 1; $i <= $aantal_dagen; $i++) {
    $temp_klas = readline("wat is de temperatuur op dag $day voor het klaslokaal ");
    $klaslokaal["$day"] = "$temp_klas";
    $temp_gang = readline("wat is de temperatuur op dag $day voor de gang? ");
    $gang["$day"] = "$temp_gang";
    $temp_kantoor = readline("wat is de temperatuur op dag $day voor het kantoor? ");
    $kantoor["$day"] = "$temp_kantoor";    
    $day++;
}
foreach ($klaslokaal as $thing) {
    echo $thing . PHP_EOL;
    foreach ($kantoor as $otherthing) {
        echo $otherthing . PHP_EOL;
    foreach ($gang as $otherother_thing) {
        echo $otherother_thing . PHP_EOL;
    }
    }
    }

?>
