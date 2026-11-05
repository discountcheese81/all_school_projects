<?php

echo "van welk getal wil je de faculteit weten? ";
$number = readline();
$output = 1;
for ($i = 1; $i <= $number - 1; $i++) {
    $output *= ($i + 1); 
}
echo "The faculteit van $number is $output" . PHP_EOL;

?>