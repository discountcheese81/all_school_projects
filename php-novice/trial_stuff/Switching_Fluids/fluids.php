<?php

function input_check($argc, $c)
{
    try {
        if ($argc < 2) {
            throw new exception("Geen argumenten opgegeven");
        } else if ($argc < 3) {
            throw new exception("Geen eenheid opgegeven");
        }
        if ($c != is_numeric($c)) {
            throw new exception("Geen geldig getal opgegeven");
        }
    } catch (exception $e) {
        echo $e->getMessage();
        exit();
    }
}
$c = (int)substr($argv[1], 0, 10);
input_check($argc, $c);
$a = substr($argv[2], 0, 2);




switch ($a) {
    case "L":
        $LdL = $c * 10;
        echo "$c l is omgerekend: $LdL dl";
        break;
    case "DL":
        $dl = $c * 1;
        echo "$a dl is $dl dl";
        break;
    case "CL":
        $cldl = $c / 10;
        echo "$c cl is omgerekend: $cldl dl";
        break;
    case "l":
        $LdL = $c * 10;
        echo "$c l is omgerekend: $LdL dl";
        break;
    case "dl":
        $dl = $c * 1;
        echo "$c dl is $dl dl";
        break;
    case "cl":
        $cldl = $c / 10;
        echo "$c cl is omgerekend: $cldl dl";
        break;
    case "ml":
        $mldl = $c / 100;
        echo "$c ml is omgerekend: $mldl dl";
        break;
    case "ML":
        $mldl = $c / 100;
        echo "$c ml is omgerekend: $mldl dl";
        break;
    default:
        exit("Ongeldige eenheid opgegeven");
}

?>