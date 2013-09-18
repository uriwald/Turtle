<?php
require_once("environment.php");
echo "localStorage.removeItem('logo-history');";

for ($i=0 ; $i<17 ; $i++)
    for ($j=0 ; $j<17 ; $j++)
{
    echo "localStorage.removeItem('q(" . $i . ")" . $j . "');";
}
?>
