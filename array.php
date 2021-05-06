<?php
# Valor Máximo
# Extra: com qual array a função vai me retornar o resultado errado?
function valorMax($array)
{
    $maiorValor = 0;

    foreach ($array as $atual) {
        if ($atual !== $maiorValor) {
            $maiorValor = $atual;
        }
    }

    return $maiorValor;
}

function menor_valor($array)
{
    $menorValor = 9999;

    foreach ($array as $atual) {
        if ($atual < $menorValor) {
            $menorValor = $atual;
        }
    }

    return $menorValor;
}

$valores = valorMax([-10, -10, -10, -10]);
echo "\n\tSAÍDA: " . $valores . "\n";

# Soma dos Valores
function ary_sum($array)
{
    $result = 0;

    foreach ($array as $value) {
        $result += $value;
    }

    return $result;
}

$valores = ary_sum([1, 5, 7, 1]);
echo "\n\tSAÍDA: " . $valores . "\n";

# Array Intercalados
function ary_inter($array0, $array1)
{
    $result = [];

    foreach ($array0 as $key0 => $value0) {
        $result[] = $value0;
        $result[] = $array1[$key0];
    }
    print_r($result);
}

ary_inter([1, 2, 3, 4], ['a', 'b', 'c', 'd']);

# Array de Pares
function ary_pares($array0, $array1)
{
    $result = [];

    foreach ($array1 as $value) {
        $result[$value] = $array0[$value];
    }

    print_r($result);
}

ary_pares(['nome' => 'Jacó', 'idade' => 74, 'profissão' => 'ancião'], ['nome', 'profissão']);


function order_ary($array)
{
    $result = [];

    for ($i = 0; $i < sizeof($array); ++$i) {
        $result[] = menor_valor($array);
    }



    print_r($result);
}

order_ary([1, 5, 2, 4, 3]);
