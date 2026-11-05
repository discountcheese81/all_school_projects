<?php

$i = 0;
$n = '*';
$s = '*';
$stapels = readline("hoeveel stapels wil je?: ");
if ($stapels != is_numeric($stapels)) {
    exit("voer een gepast getal in(1,2,3,4,5,6,7,8,9,10. etc.)");
} else if ($stapels <= 0) {
    exit("voer een gepast getal in (1,2,3,4,5,6,7,8,9,10. etc.)");
} else {
    while ($i < $stapels) {
        if ($i >= 1) {
            $n .= $s;
            echo "$n" . PHP_EOL;
        } else {
            echo '*' . PHP_EOL;
        }
        $i++;
    }
}

?>