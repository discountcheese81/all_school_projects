<?php

echo "hoeveel vrienden zal ik vragen om hun droom? ";
$nmbr_frnds = readline();
if ($nmbr_frnds != is_numeric($nmbr_frnds)) {
    exit("$nmbr_frnds is geen geldig getal, probeer het opnieuw");
} else {
    for ($x = 1; $x <= $nmbr_frnds; $x++) {
        echo "wat is jouw naam? ";
        $name = readline();
        echo "wat is jouw droom? ";
        $droom = readline();
        $bucket_list["$name"] = "$droom";
    }
    foreach ($bucket_list as $c => $y) {
        echo "$c heeft dit als droom: $y." . PHP_EOL;
    }
}

?>