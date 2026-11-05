<?php

$bucket_list = [];
echo "hoeveel vrienden zal ik vragen om hun droom? ";
$nmbr_frnds = readline();
if ($nmbr_frnds != is_numeric($nmbr_frnds)) {
    exit("$nmbr_frnds is geen geldig getal, probeer het opnieuw");
} else {
    for ($x = 1; $x <= $nmbr_frnds; $x++) {
        echo "wat is jouw naam? ";
        $name = readline();
        echo "hoeveel dromen ga jij opgeven? ";
        $aantal_dromen = readline();
        var_dump($aantal_dromen);
        if ($aantal_dromen != is_numeric($aantal_dromen)) {
            exit("$aantal_dromen is geen geldig getal");
        } else {
            $p = 0;
            while ($p <= $aantal_dromen - 1) {
                echo "wat is jouw droom? ";
                $droom = readline();
                $bucket_list["$name"] [] = "$droom";
                $p++;
            } 
        }
    }
    var_dump($bucket_list);
    foreach ($bucket_list as $n => $d1) {
            $string = implode(' en ', $d1);
        echo "$n heeft deze dromen: $string" . PHP_EOL;
    }
}

?>