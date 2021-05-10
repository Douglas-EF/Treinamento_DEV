<?php
/* EXEMPLO MURILO
function remove_ary($array)
{
    $result = [];

    foreach ($array as $value) {
        $item = $value;
        $qtd_keys = array_keys($array, $item);
        if ($qtd_keys < 1) {
            $result[] = $item;
        }
    }
    //print_r($result);
    //return $result;
}
remove_ary([1, 2, 3, 3, 4, 5, 4, 6, 8, 6, 8, 6, 8, 6, 8]);
*/
//remove_ary_2([1, 2, 3, 3, 4, 5, 4, 6, 8, 6, 8, 6, 8, 6, 8]);


function embralhar($a, $b)
{
    return rand(-1, 1);
}

function zerFor($array)
{
    $result = [];

    usort($array, 'embralhar');

    foreach ($array as $value) {
        echo $value . "\n";
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

//zerFor([1, 2, 3, 4, 5]);