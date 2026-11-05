<?php

$S_and_G = array(
"Amir" => "4.7",
"Bao" => "4.3",
"Cedric" => "6.2",
"Dalia" => "8.2",
"Emeka" => "6.6",
"Frederique" => "5.9",
"Giovanni" => "7.6",
"Hannah" => "3.1",
"Ivan"	=> "2.5",
);

foreach ($S_and_G as $name => $grade) {
    $float_grade = floatval($grade);
    $rounded_grade = round($float_grade, 0);
    echo "Het afgeronde cijfer van $name is een $rounded_grade" . PHP_EOL;
}


?>