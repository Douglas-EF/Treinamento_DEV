<?php

$string = "São Paulo";
$caracteres_sem_acento = array(
    'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', '�' => 'Z', '�' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
    'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
    'Ï' => 'I', 'Ñ' => 'N', 'Ń' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
    'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
    'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
    'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ń' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
    'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f',
    'ă' => 'a', 'î' => 'i', 'â' => 'a', 'ș' => 's', 'ț' => 't', 'Ă' => 'A', 'Î' => 'I', 'Â' => 'A', 'Ș' => 'S', 'Ț' => 'T',
);
$nova_string = strtr($string, $caracteres_sem_acento);
echo ($nova_string) . "\n\n";

$view_array = str_split(tracejarPalavra($nova_string)); // Tracejar a palavra e apresentar as letras conforme acerto
$array_clear = str_split($nova_string); // Deixar sem os caracteres especiais
$array = str_split_unicode($string); // Manter os caracteres conforme realmente são
while (true) {

    $plv_informada  = readline("Informe uma palavra: ");
    if (in_array($plv_informada, $array_clear)) {

        $id =  array_search_all($plv_informada, $array_clear);
        foreach ($id as $key) {
            $view_array[$key] = $array[$key];
        }
    } else {
        echo "Você errou!";
    }

    //$view_array[$key] = $array[$key];

    print_r($view_array);
    echo "\n\n\n" . implode($view_array) . "\n\n";
}
function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT, $encoding = 'UTF-8')
{
    $mb_diff = mb_strlen($input, $encoding) - strlen($input);
    return str_pad($input, $pad_length - $mb_diff, $pad_string, $pad_type);
}

function tracejarPalavra($palavra)
{
    $id_space = array_search(" ", str_split_unicode($palavra));
    $plv_tracejada = mb_str_pad("", strlen($palavra), "-");
    $plv_tracejada[$id_space] = " ";
    return $plv_tracejada;
}

function str_split_unicode($str, $l = 0)
{
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}

function array_search_all($letra, $array)
{
    foreach ($array as $keys => $valor) {
        if ($array[$keys] == $letra) {
            $list[] = $keys;
        }
    }
    return ($list);
}
