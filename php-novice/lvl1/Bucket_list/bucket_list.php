<?php

echo "hoeveel activiteiten wilt u toevoegen? ";
$number_of_activities = readline();
if ($number_of_activities != is_numeric($number_of_activities)) {
    exit("voer een geldig getal in (bijv. 1,2,3,4,5,6 etc.)");
} else {
    for ($x = 1; $x <= $number_of_activities; $x++) {
        echo "voer bucketlist item $x in: ";
        $add = readline();
        $bucketlist[$x] = "$add";
    } echo "op jouw lijst staat: " . PHP_EOL;
    foreach ($bucketlist as $c) {
        echo "$c" . PHP_EOL;
    }
}
?>