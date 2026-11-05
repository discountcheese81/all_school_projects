<?php

$continue = 'Y';
$totaal = 0;
function division_errors($getal1, $getal2) {
    try {
        if ($getal1 == 0 or $getal2 == 0) {
            throw new DivisionByZeroError("Error: kan nul niet delen of kan niet door nul delen. probeer het opnieuw met een ander getal");
        }
        if ($getal1 != is_numeric($getal1) or $getal2 != is_numeric($getal2)) {
            throw new typeError("Error: $getal1 en/of $getal2 is geen getal, probeer het opnieuw met een getal");
        }
    } catch (TypeError $e) {
        echo $e->getMessage();
        exit();
    } catch (DivisionByZeroError $e) {
        echo $e->getMessage();
        exit();
    }
}
function regular_errors($getal1, $getal2) {
    try {
        if ($getal1 != is_numeric($getal1) or $getal2 != is_numeric($getal2)) {
            throw new typeError("Error: $getal1 of $getal2 is geen getal, probeer het opnieuw met een getal");
        }
    } catch (TypeError $e) {
        echo $e->getMessage();
        exit();
    }
}

while ($continue == 'Y' or $continue == 'y') {
$choice = readline("wat wil je berekenen? (/, X, -, %) ");
$getal1 = readline("wat is het eerste getal? ");
$getal2 = readline("wat is het tweede getal? ");
regular_errors($getal1, $getal2);
switch($choice) {
    case "/":
        division_errors($getal1, $getal2);
        $divide = $getal1 / $getal2;
        echo "$getal1 gedeeld door $getal2 is $divide" . PHP_EOL;
        break;
    case '*':
        $multiply = $getal1 * $getal2;
        echo "$getal1 keer $getal2 is $multiply" . PHP_EOL;
        break;
    case '-':
        $subtract = $getal1 - $getal2;
        echo "$getal1 min $getal2 = $subtract" . PHP_EOL;
        break;
    case '%':
        division_errors($getal1, $getal2);
        $modulo = $getal1 % $getal2;
        echo "de rest van $getal1 gedeeld door $getal2 = $modulo" . PHP_EOL;
        break;
    default:
        exit("engeldige bewerking, probeer het opnieuw met een geldige bewerking");
}
$continue = readline("wil je verder rekenen?(Y/N)");

}
?>