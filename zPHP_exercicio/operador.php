<?php
$a = 10;
$b = 5;
$c = 2;

$resultado = ($a + $b) * $c / 2 - 3; 
echo "Resultado da expressão: $resultado<br>";

$A = 1;
$B = -3;
$C = 2;

$delta = $B*$B - 4*$A*$C;

if ($delta >= 0) {
    $x1 = (-$B + sqrt($delta)) / (2*$A);
    $x2 = (-$B - sqrt($delta)) / (2*$A);
    echo "Raízes da equação quadrática: x1 = $x1, x2 = $x2<br>";
} else {
    echo "A equação não possui raízes reais.<br>";
}
?>
