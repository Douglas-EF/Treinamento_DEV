<?php
function ary_embaralhar($array)
{
    $result = [];

    foreach ($array as $value) {
        $dados_ary[] = $value;
    }

    while (sizeof($result) < sizeof($array)) {

        $random1 = random_int(0, 4);
        $random_key_dados = random_int(0, 4);

        if (!(array_key_exists($random1, $result)) and !(in_array($dados_ary[$random_key_dados], $result))) {
            $result[$random1] = $dados_ary[$random_key_dados];
        } else {
            continue;
        }
    }
    ksort($result);
    print_r($result);
}
ary_embaralhar([1, 2, 3, 4, 5]);
