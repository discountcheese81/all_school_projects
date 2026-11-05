<?php

$i = 0;
echo "hoeveel stapels wil je hebben? ";
$stapels = readline();
if ($stapels != is_numeric($stapels)) {
    exit("voer een geldig getal in (1,2,3,4,5,6,7 etc.)");
} else if ($stapels <= 0) {
    exit("voer een geldig getal in (1,2,3,4,5,6,7 etc.)");
} else {
    while ($i <= $stapels) {
	    $j = 1;
	    while ($j <= $i) {
		    $j++;
		    echo "*";
	    }
	    $i++;
	    echo PHP_EOL;
    }
}

?>