<?php
# Soma dos Valores
function ary_sum($array)
{
    $result = 0;

    foreach ($array as $key => $value) {
        $result += $value;
    }
    return $result;
}

$valores = ary_sum([1, 5, 7, 1]);
echo "\n\tSAÍDA: " . $valores . "\n";


# Valor Máximo
function valorMax($array)
{
    $result = 0;

    return $result;
}

$valores = valorMax([1, 5, 7, 8, 1, 20]);
echo "\n\tSAÍDA: " . $valores . "\n";
