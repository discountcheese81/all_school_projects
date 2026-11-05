<?php

$aantal_landen = readline("hoeveel landen wil je toevoegen? ");
if ($aantal_landen <= 0 or $aantal_landen != is_numeric($aantal_landen)) {
    exit("voer een gepast getal in");
}
for ($i = 0; $i < $aantal_landen; $i++) {
    $land = readline("welk land wil je toevoegen?");
    $hoofdstad = readline("wat is de hoofdstad van $land? ");
    $landen["$land"] = "$hoofdstad";
    } foreach ($landen as $x => $y) {
        echo "de hoofdstad van $x is $y" . PHP_EOL;
}

?>