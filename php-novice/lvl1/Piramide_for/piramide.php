<?php

echo "hoeveel stapels wil je? ";
$stapels = readline();
if ($stapels != is_numeric($stapels)) {
    exit("voer een gepast getal in (1,2,3,4,5,6 etc.)");
} else if ($stapels <= 0) {
        exit("voer een gepast getal in (1,2,3,4,5,6 etc.)");
} else {
    for ($a = 0; $a <= $stapels; $a++) {
        for ($b = 1; $b <= $a; $b++) {
            echo "*";
        }
        echo PHP_EOL;
    }
}

?>