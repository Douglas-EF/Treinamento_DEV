import os;

<?php

$ary_palavra;
$ary_tracejada;
$ary_verificada;

$plv_tracejada;
$list_keys = [];
$life = 0;



$opcoes = array(1, 2, 3);

while (true) {
    $opc_selected = exibeMenu();
    if ($opc_selected == 1) {
        // Contando a quantidade de palavras para selecionar com base no indice
        $consulta = consultarPalavras();

        $numero_random = random_int(0, array_key_last($dados));
        echo "----------------------------\n\n";
        //echo $numero_random;

        $palavra = searchPalavra($numero_random);
        //converterDados($palavra);
        $plv_tracejada = tracejarPalavra($palavra);
        animacao(0);
        converterDados($palavra);

        while (true) {
            echo "┗━━━━━> " . $plv_tracejada . "\n\n";
            //converterDados($palavra);

            system("cls");
            $letra_informada = readline("Informe uma letra:" . "\n");

            if (in_array($letra_informada, $ary_palavra)) {

                // Enquanto tiver keys corespondentes a determinada letra ele ira prencher o array($ary_tracejada)
                $list_keys = array_search_all($letra_informada, $ary_palavra);
                foreach ($list_keys as $key) {
                    $ary_tracejada[$key] = "$letra_informada";
                }

                $plv_tracejada = implode($ary_tracejada);
                print_r($ary_tracejada);
            } else {
                $life++;
                animacao($life);

                if ($life > 7) {
                    echo "Game Over...";
                    return false;
                    system('ls');
                }
            }
        }
    } elseif ($opc_selected == 2) {
        echo "Opção 2!";
    } elseif ($opc_selected == 3) {
        return false;
    }

    //palavra($palavra);
    $exibe_palavra = " ";
    //$tracejada = mb_str_pad($exibe_palavra, strlen($palavra),"-" );
    echo strlen($palavra);
}



//
function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT, $encoding = 'UTF-8')
{
    $mb_diff = mb_strlen($input, $encoding) - strlen($input);
    return str_pad($input, $pad_length - $mb_diff, $pad_string, $pad_type);
}

// Função para exibir o menu
function exibeMenu()
{
    global $opcoes;
    echo "
    \n" . "┗━━━━━━━━━━━━━━━| GAME FORCA MENU |━━━━━━━━━━━━━━━┛" . "\n \n
             ┏━━━━━━━━━━━━━━━━━━━━━━━┓
             | 1 - Iniciar           | 
             | 2 - Cadastrar palavra |
             | 3 - Sair              |
             ┗━━━━━━━━━━━━━━━━━━━━━━━┛     
    " . "\n\n";

    $opc_selected = (int) readline("Escolha uma opção: ");

    if (!in_array($opc_selected, $opcoes)) {
        echo "Opção invalida!";
        return exibeMenu();
    }

    return $opc_selected;
}

// Função para percorrer todo o Array em busca de uma determinada letra, e retonar mais de uma chave(caso tenha)
function array_search_all($letra, $array)
{
    foreach ($array as $keys => $valor) {
        if ($array[$keys] == $letra) {
            $list[] = $keys;
        }
    }
    return ($list);
}

// Função
function converterDados($palavra)
{
    global $ary_palavra, $ary_tracejada;

    $plv_tracejada = mb_str_pad("", strlen($palavra), "-");
    //echo $plv_tracejada . "\n\n";

    $ary_palavra = str_split($palavra);
    //print_r($ary_palavra);

    $ary_tracejada = str_split($plv_tracejada);
        //print_r($ary_tracejada);

    ;
}

function tracejarPalavra($palavra)
{
    $plv_tracejada = mb_str_pad("", strlen($palavra), "-");
    return $plv_tracejada;
}

// Função para armazenar em array as palavras salvas no arquivo palavras.txt 
function consultarPalavras()
{
    global $dados;
    $dados = [];

    if (file_exists("palavras.txt")) {
        $arquivos_lista = fopen("palavras.txt", "r");

        while (($data = fgetcsv($arquivos_lista, 0, "|")) != false) {
            $dados[] = [
                "palavra" => $data[0]
            ];
        }
    }
    fclose($arquivos_lista);
}

// Função para trazer a palavra que corresponde ao numero gerado
function searchPalavra($numero)
{
    global $dados;
    $teste = $dados[$numero];
    //print_r($teste);

    return $teste['palavra'];
}

// Animações da forca
function animacao($case)
{
    switch ($case) {
        case 0:
            echo "
            ┏━━━━━━━┓
            |
            |
            |
            |
            |
            |
            |
            ";
            break;

        case 1:
            echo "
            ┏━━━━━━━┓
            |       O
            |              
            |        
            |       
            |
            |
            |
            ";
            break;

        case 2:
            echo "
            ┏━━━━━━━┓
            |       O
            |       |
            |
            |
            |
            |
            |
            ";
            break;

        case 3:
            echo "
            ┏━━━━━━━┓
            |       O
            |       |\        
            |
            |
            |
            |
            |
            ";
            break;

        case 4:
            echo "
            ┏━━━━━━━┓
            |       O
            |      /|\        
            |         
            |       
            |
            |
            |
            ";
            break;

        case 5:
            echo "
            ┏━━━━━━━┓
            |       O
            |      /|\        
            |       |  
            |
            |
            |
            |
            ";
            break;

        case 6:
            echo "
            ┏━━━━━━━┓
            |       O
            |      /|\        
            |       |  
            |        \
            |
            |
            |
            ";
            break;

        case 7:
            echo "
            ┏━━━━━━━┓
            |       O
            |      /|\        
            |       |  
            |      / \
            |
            |
            |
            ";
            break;
    }
}
