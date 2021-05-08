<?php
# Valor Máximo
# Extra: com qual array a função vai me retornar o resultado errado?
/*
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

$valores = valorMax([-10, -10, -8, -10]);
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
*/
# Array Intercalados
function ary_inter($array0, $array1)
{
    $result = [];

    foreach ($array0 as $key0 => $value0) {
        $result[] = [
            $value0,
            $array1[$key0]
        ];         
    }
    print_r($result);
}

ary_inter([1, 2, 3, 4], ['a', 'b', 'c', 'd']);
/*
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

# Ordenar Array
function order_ary($array)
{
    $ary_mod = $array;
    $result = [];

    for ($i = 0; $i < sizeof($array); $i++) {
        $result[] = menor_valor($ary_mod);
        $pesquisa = array_search($result[$i], $ary_mod);
        unset($ary_mod[$pesquisa]);
    }

    print_r($result);
}

order_ary([1, 5, 2, 4, 3]);

#Remove Duplicados
function remove_ary($array)
{
    $result = [];

    foreach ($array as $value) {
        $item = $value;
        $qtd_keys = array_keys($array, $item);
        if () {
            $result[] = $item;
        }
    }
    print_r($result);
}
remove_ary([1, 2, 3, 3, 4, 5, 4, 6, 8, 6, 8, 6, 8, 6, 8]);

function remove_ary_2($array)
{
    $pre = [];

    foreach ($array as $value) {
        $pre[$value] = true;
    }

    print_r($pre);
    $result = [];

    foreach ($pre as $key => $val) {
        $result[] = $key;
    }

    print_r($result);
}
remove_ary_2([1, 2, 3, 3, 4, 5, 4, 6, 8, 6, 8, 6, 8, 6, 8]);
*/

/*
function embaralha_ary($array)
{
    $result = [];
    $valor = [];
    $random = random_int(0, 90);

    foreach ($array as $value) {
        $valor[] = $value;
    }
    //print_r($valor);
    while (sizeof($result) < sizeof($array)) {

        $random = random_int(0, 4);

        if (!(array_key_exists($random, $result))) {
            $result[$random] = $valor[$random];
        } else {
            continue;
        }
    }
    arsort($result);
    print_r($result);
}
//embaralha_ary([1, 2, 3, 4, 5]);

function embralhar($a, $b) 
{
    return rand(-1, 1);
}

function zerFor($array)
{
    $result = [];

    usort($array, 'embralhar');

    foreach ($array as $value) {
        echo $value."\n";
    }

    
    
    foreach ($array as $value) {
        $random = random_int(0, 4);
        if (!(array_key_exists($random, $result) and isset($result[$value]))) {
            $result[$random] = $value;
        } else {
            while (!(array_key_exists($random, $result) and isset($result[$value]))) {
                $random = random_int(0, 4);

                if (!(array_key_exists($random, $result) and isset($result[$value]))) {
                    $result[$random] = $value;
                } else {
                    continue;
                }
            }
        }
    }

    //ksort($result);
    //print_r($result);
}
*/
//zerFor([1, 2, 3, 4, 5]);
