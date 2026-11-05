<?php

$a = substr($argv[1], -1);
$c = substr($argv[1], 0, -1);
if ($a == 'd' xor $a == 'D') {
    $b = substr($argv[1], 0, -1) * 86400; 
    echo "$b seconden";
} else if ($a == 'u' or $a == 'u' or $a == 'h' or $a == 'H') {
    $b = substr($argv[1], 0, -1) * 3600; 
    echo "$b seconden"; 
} else if ($a == 'm' xor $a == 'M') {
    $b = substr($argv[1], 0, -1) * 60;
    echo "$b seconden";
} else if ($a == 's' xor $a == 'S') {
    $b = substr($argv[1], 0, -1);
    echo "$b seconden";
}

?>