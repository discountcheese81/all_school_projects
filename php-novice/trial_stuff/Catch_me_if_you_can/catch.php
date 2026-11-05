<?php

$b = 0;
$a = 'b'; 
$c = -1;
$d = 501;
$f = 5 / 1;
$i = 0;
$k = 0;
function exceptions ($a, $b, $c, $d, $f, $k) {
    try {
        if ($b == 0) {
            throw new exception("Mijn eigen foutmelding");
        }
        if ($a != is_numeric($a)) {
            throw new TypeError("geen getal opgegeven");
        }
        if ($c < 0) {
        throw new RangeException("error: negatief getal");
        }
        if ($d > 500) {
            throw new RangeException("error: getallen groter dan 500 niet toegestaan");
        }
        $f == 5 / $k;
        if ($k == 0) {
            throw new DivisionByZeroError();
        }
    } catch (DivisionByZeroError $e)
    {
        echo $e->getMessage() . PHP_EOL;
    } catch (Exception $e)
    {
        echo $e->getMessage() . PHP_EOL;
    } catch (TypeError $e)
    {
        echo $e->getMessage() . PHP_EOL;
    } catch (RangeException $e)
    {
        echo $e->getMessage() . PHP_EOL;
    }
    
}
    exceptions($a, $b, $c, $d, $f, $k);

?>