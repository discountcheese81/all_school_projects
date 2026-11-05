<?php

$nmber_friends = readline("hoeveel vrienden zou ik vragen om hun droom?: ");
if ($nmber_friends != is_numeric($nmber_friends)) {
    exit("$nmber_friends is geen geldig getal, probeer het opnieuw");
} else {
    for ($i = 1; $i <= $nmber_friends; $i++) {
        $name = readline("wat is jouw naam? ");
        $aantal_dromen = readline("hoeveel dromen ga jij opgeven? ");
        if ($aantal_dromen != is_numeric($aantal_dromen)) {
            exit ("'$aantal_dromen' is geen geldig getal, probeer het opnieuw");
        } else { 
        $p = 0;
        while ($p < $aantal_dromen) {
        $dream = readline("wat is jouw droom? ");
        $bucket_list["$name"] [] = $dream;
        $p++;
        }
        }
    }
    foreach ($bucket_list as $n => $d1) {
            $string = implode(' en ', $d1);
        echo "$n heeft deze dromen: $string" . PHP_EOL;
    }
}

?>