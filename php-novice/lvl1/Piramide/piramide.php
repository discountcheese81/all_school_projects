<?php

$i = 0;
$n = '*';
$s = '*';
echo "hoeveel stapels wil je hebben? ";
$stapels = readline();
if ($stapels != is_numeric($stapels)) {
    exit("voer een geldig getal in (1, 2,3,4,5 etc.)");
} else if ($stapels <= 0) {
    exit("voer een geldig getal in (1, 2, 3, 4, 5 etc.)");
} else {
    while ($i < $stapels) {
        if ($i >= 1) {
            $n .= "$s" ;
            echo "$n" . PHP_EOL;
        } else {
            echo "*" . PHP_EOL;
        }
        $i++;
    }
}

?>