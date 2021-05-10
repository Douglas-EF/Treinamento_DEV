<?php

function valorMin($array)
{
    $menorValor = 9999;

    foreach ($array as $atual) {
        if ($atual < $menorValor) {
            $menorValor = $atual;
        }
    }

    return $menorValor;
}

# Valor Máximo
echo "\n┗━━━━━━━━━━━━━━━| VALOR MÁXIMO\n";
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
$valores = valorMax([-10, -10, -8, -10]);
echo "\n\tSAÍDA: " . $valores . "\n";


# Soma dos Valores
echo "\n\n┗━━━━━━━━━━━━━━━| SOMA DOS VALORES\n";
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

# Array de Valores Intercalados
echo "\n\n┗━━━━━━━━━━━━━━━| VALORES INTERCALADOS\n";
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
echo "\n\n┗━━━━━━━━━━━━━━━| VALORES EM PARES\n";
function ary_pares($array0, $array1)
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
ary_pares([1, 2, 3, 4], ['a', 'b', 'c', 'd']);

# Array para Embaralhar os Valores
echo "\n\n┗━━━━━━━━━━━━━━━| EMBARALHAR VALORES\n";
function ary_embaralhar($array)
{
    $result = [];

    while (!empty($array)) {
        $randkey = random_int(0, sizeof($array) - 1);
        $result[] = $array[$randkey];
        unset($array[$randkey]);
        $array = array_values($array);
    }

    /*foreach ($array as $value) {
        $dados_ary[] = $value;
    }

    while (sizeof($result) < sizeof($array)) {

        $random1 = random_int(0, $size);
        $random_key_dados = random_int(0, $size);

        if (!(array_key_exists($random1, $result)) and !(in_array($dados_ary[$random_key_dados], $result))) {
            $result[$random1] = $dados_ary[$random_key_dados];
        } else {
            continue;
        }
    }*/
    //$result = array_values($result);
    print_r($result);
}

$target = [];
$iteracoes = 10000;
for ($i = 0; $i < $iteracoes; $i++) {
    $target[] = $i;
}
ary_embaralhar($target);


# Array de Associativo
echo "\n\n┗━━━━━━━━━━━━━━━| ARRAY ASSOCIATIVO\n";
function ary_associativo($array0, $array1)
{
    $result = [];

    foreach ($array1 as $value) {
        $result[$value] = $array0[$value];
    }

    print_r($result);
}
ary_associativo(['nome' => 'Jacó', 'idade' => 74, 'profissão' => 'ancião'], ['nome', 'profissão']);


# Ordenar Array
echo "\n\n┗━━━━━━━━━━━━━━━| ARRAY ORDENADO\n";
function ary_order($array)
{
    $ary_mod = $array;
    $result = [];

    for ($i = 0; $i < sizeof($array); $i++) {
        $result[] = valorMin($ary_mod);
        $pesquisa = array_search($result[$i], $ary_mod);
        unset($ary_mod[$pesquisa]);
    }

    print_r($result);
}
ary_order([1, 5, 2, 4, 3]);


#Remove Duplicados
echo "\n\n┗━━━━━━━━━━━━━━━| DEL VALORES DUPLICADOS\n";
function remove_ary($array)
{
    $pre = [];

    foreach ($array as $value) {
        $pre[$value] = true;
    }

    //print_r($pre);
    $result = [];

    foreach ($pre as $key => $val) {
        $result[] = $key;
    }

    print_r($result);
}
remove_ary([1, 2, 3, 3, 4, 5, 4, 6, 8, 6, 8, 6, 8, 6, 8]);

# Reverter Array
echo "\n\n┗━━━━━━━━━━━━━━━| ARRAY REVERTIDO\n";
function ary_revert($array)
{
    $result = [];
    $ary_dados = [];
    $key_last = array_key_last($array);

    foreach ($array as $valores) {
        $ary_dados[] = $valores;
    }

    while ($key_last >= 0) {
        $result[] = $ary_dados[$key_last];
        $key_last--;
    }
    print_r($result);
}
ary_revert([1, 2, 3, 4, 5, 6, 7, 7, 8, 8]);

# Achatar um Array Multidimensional
echo "\n\n┗━━━━━━━━━━━━━━━| ARRAY MULTIDIMENSIONAL ACHATADO\n";
function ary_achat_mult($array)
{
    $result = [];

    //print_r($array);

    foreach ($array as $value) {
        if (is_array($value)) {
            $result = array_merge($result, ary_achat_mult($value));
        } else {
            $result[] = $value;
        }
    }
    //print_r($result);

    return $result;
}
exibir([1, [1, 2], [1, [2, 3], 4]]);

function exibir($array)
{
    $result = [];

    $result = ary_achat_mult($array);

    print_r($result);
}
