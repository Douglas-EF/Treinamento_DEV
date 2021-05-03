<?php

$ary_palavra;
$ary_tracejada;
$plv_tracejada;
$list_keys = [];
$plv_informada;
$dica;
$life = 7;




$opcoes = array(1, 2, 3, 4, 5);

while (true) {
    $opc_selected = exibeMenu();
    if ($opc_selected == 1) {

        $consulta = consultarPalavras();

        $numero_random = random_int(0, array_key_last($dados));
        echo "\n\n";

        $palavra = searchPalavra($numero_random);
        $plv_tracejada = tracejarPalavra($palavra);
        converterDados($palavra);

        while (true) {
            if ($life >= 0) {
                animacao($life);
                echo "┗━━━━━> " . $plv_tracejada . "\n\n";
                life($life);
                if (in_array("-", $ary_tracejada)) {

                    echo "\n" . "►►►►► DICA: " . $dica . "\n";

                    $letra_informada = readline("►►►►►►►►►► Informe uma letra: ");

                    if (in_array($letra_informada, $ary_palavra)) {

                        // Enquanto tiver keys corespondentes a determinada letra ele ira prencher o array($ary_tracejada)
                        $list_keys = array_search_all($letra_informada, $ary_palavra);
                        foreach ($list_keys as $key) {
                            $ary_tracejada[$key] = "$letra_informada";
                        }

                        $plv_tracejada = implode($ary_tracejada);
                    } else {
                        $life--;
                    }
                } else {
                    animacao(202);
                    insertHistorico($palavra, (7 - $life));
                    return false;
                }
            } else {
                animacao(404);
                return false;
            }
        }
        // CADASTRAR PALAVRA
    } elseif ($opc_selected == 2) {
        echo "\n\n" . "┗━━━━━━━━━━━━━━━| CADASTRAR PALAVRA |━━━━━━━━━━━━━━━┛" . "\n\n\n";
        while (true) {
            global $plv_informada;
            $plv_informada = readline("►►►►►►►►►►►►►►► Informe a palavra que deseja cadastrar: ");

            if (!(empty($plv_informada))) {
                iniciar();

                echo "\n \t" . "Obaa, palavra cadastrada com sucesso!!!" . "\n";

                return false;
            }

            echo "►►►►►►►►►► OPA, NÃO ENTENDI O QUE VOCÊ DIGITOU, TENTE NOVAMENTE..." . "\n\n\n";
        }
        // MULTIPLAYER
    } elseif ($opc_selected == 3) {
        echo "\n" . "┗━━━━━━━━━━━━━━━| MULTIPLAYER |━━━━━━━━━━━━━━━┛" . "\n\n\n";
        $player0 = readline("►►►►►►►►►►►►►►► Nome do Player 1: ");
        echo "\n";
        $player1 = readline("►►►►►►►►►►►►►►► Nome do Player 2: ");
        $animacion = 0;
        $life_pvp_0 = 7;
        $life_pvp_1 = 7;
        $ganhou = 0;
        $teste = 7;
        $plv_informadas = "";
        $plv_play_pvp_0 = "";
        $plv_play_pvp_1 = "";


        if (!(empty($player0 or $player1))) {
            $consulta = consultarPalavras();
            $numero_random = random_int(0, array_key_last($dados));

            $palavra = searchPalavra($numero_random);
            $plv_tracejada = tracejarPalavra($palavra);
            converterDados($palavra);
            $jogador = $player0;

            while (true) {
                animacao($teste);
                echo "┗━━━━━> " . $plv_tracejada . "\n\n";
                echo "►►►►►►►►►►►►►►► $jogador, agora é sua vez..." . "\n";
                echo "►►►►►►►►►► DICA: " . $dica . "\n";
                echo "Palavras informadas: " . $plv_informadas;
                echo "\n" . implode($ary_palavra) . "\n";
                $REQUEST = readline("►►►►► Informe um letra: ");



                if (in_array("-", $ary_tracejada)) {

                    if (in_array("$REQUEST", $ary_palavra)) {
                        if ($jogador == $player0) {
                            alter_tracejada($REQUEST);
                            $plv_play_pvp_0 .= $REQUEST;
                            $plv_informadas = $plv_play_pvp_0;
                        } else {
                            alter_tracejada($REQUEST);
                            $plv_play_pvp_1 .= $REQUEST;
                            $plv_informadas = $plv_play_pvp_1;
                        }
                    } else {
                        if ($jogador == $player0) {
                            $teste = $life_pvp_1;
                            $life_pvp_0--;
                            $jogador = $player1;
                            $plv_play_pvp_0 .= $REQUEST;
                            $plv_informadas = $plv_play_pvp_1;
                        } else {
                            $teste = $life_pvp_0;
                            $life_pvp_1--;
                            $jogador = $player0;
                            $plv_play_pvp_1 .= $REQUEST;
                            $plv_informadas = $plv_play_pvp_1;
                        }
                    }
                } else {
                    $ganhou = 1;
                    break;
                }

                if (($life_pvp_0 <= 0) && ($life_pvp_1 <= 0)) {
                    echo "Game over!";
                    break;
                }
            }
            if ($ganhou) {
                echo "Parabéns, $jogador vc ganhou!";
            }
        } else {
        }
        // EXIBIR HISTÓRICO
    } elseif ($opc_selected == 4) {
        exibirHistorico();
        // EXIT
    } elseif ($opc_selected == 5) {
        return false;
    }
}

function alter_tracejada($REQUEST)
{
    global $ary_palavra, $ary_tracejada, $plv_tracejada;
    $list_keys = array_search_all($REQUEST, $ary_palavra);
    foreach ($list_keys as $key) {
        $ary_tracejada[$key] = "$REQUEST";
    }

    $plv_tracejada = implode($ary_tracejada);
}

function iniciar()
{
    while (true) {
        global $plv_informada;
        $pergunta_status = strtoupper(readline("►►►►►►►►►► Deseja adicionar um grupo(irá servir como dica) para esta palavra (Y/N)?"));
        if (!($pergunta_status == "Y" || $pergunta_status == "N")) {
            echo "►►►►► OPA, NÃO ENTENDI O QUE VOCÊ DIGITOU, TENTE NOVAMENTE..." . "\n\n\n";
            continue;
        } elseif ($pergunta_status == "Y") {
            $plv_status = readline("►►►►► Qual o nome do grupo? ");
            insertPalavra($plv_informada, $plv_status);
            return false;
        } else {
            return false;
        }
    }
}

function insertPalavra($palavra, $grupo)
{
    $fp = fopen('palavras.txt', 'a');
    fwrite($fp, strtolower($palavra) . "|" . strtolower($grupo) . "\n");
    fclose($fp);
}

function insertHistorico($palavra, $life)
{
    $fp = fopen('historico.txt', 'a');
    fwrite($fp, $palavra . "|" . $life . "/7" . "\n");
    fclose($fp);
}

function exibirHistorico()
{
    $reg_linhas = [];

    if (file_exists("historico.txt")) {
        $arq_list = fopen("historico.txt", "r");
        while (($data = fgetcsv($arq_list, 0, "|")) != false) {
            $reg_linhas[] =
                [
                    'palavra' => $data[0],
                    'life' => $data[1]
                ];
        }
        fclose($arq_list);
        array_multisort(array_column($reg_linhas, 'palavra'), SORT_DESC, array_column($reg_linhas, 'life'), SORT_ASC,  $reg_linhas);
    }

    echo "\n" . "┏━━━━━━━━━━━━━━━━━━━━━━━| HISTÓRICO |━━━━━━━━━━━━━━━━━━━━━━━┓" . "\n";
    $rank = $reg_linhas;

    foreach ($rank as $values) {
        echo "| Palavra --> |" . mb_str_pad($values['palavra'], 19, " ") . "Vidas Utilizadas --> |" . mb_str_pad($values['life'], 4, " ") . "|\n";
    }
    echo "┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛" . "\n \n \n";
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
             | 3 - Multiplayer       |
             | 4 - Histórico         |
             | 5 - Sair              |
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

// Função responsável por tracejar uma palavra
function tracejarPalavra($palavra)
{
    $plv_tracejada = mb_str_pad("", strlen($palavra), "-");
    return $plv_tracejada;
}

// Função para converter a palavra e a palavra tracejada em Array
function converterDados($palavra)
{
    global $ary_palavra, $ary_tracejada;
    $ary_palavra = str_split($palavra);
    $ary_tracejada = str_split(tracejarPalavra($palavra));
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
                "palavra" => $data[0],
                "grupo" => $data[1]
            ];
        }
    }
    fclose($arquivos_lista);
}

// Função para trazer a palavra que possui a key corresponde ao numero gerado
function searchPalavra($numero)
{
    global $dados, $dica;
    $pull_plv = $dados[$numero];
    $dica = $pull_plv['grupo'];
    return $pull_plv['palavra'];
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

        case 202:
            echo "
    ╭━━━━╮   ┏━━━━━━━━━━━━━━━━━━━━━━━━━━┓
    ┃╭╮╭╮┃┈┈ ┃ PARABÉNS VOCÊ ACERTOU!!! ┃
   ┗┫┏━━┓┣┛  ┗━━━━━━━━━━━━━━━━━━━━━━━━━━┛
    ┃╰━━╯┃
    ╰┳━━┳╯" . "\n";
            break;

        case 404:
            echo " \n\n\n
    █████████    ┏━━━━━━━━━━━━━━━━━━━━━━┓
    █▄█████▄█ ┈┈ ┃ SUAS VIDAS ACABARAM! ┃
    █▼▼▼▼▼       ┗━━━━━━━━━━━━━━━━━━━━━━┛
    █            
    GAME OVER!
    █▲▲▲▲▲
    █████████
      ██ ██" . "\n \n";
            break;
    }
}

function life($case)
{
    switch ($case) {
        case 0:
            echo "
       _______________
LIFE: ║ - - - - - - - ║
       ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾";
            break;

        case 1:
            echo "
       _______________
LIFE: ║ ● - - - - - - ║
       ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾";
            break;

        case 2:
            echo "
       _______________
LIFE: ║ ● ● - - - - - ║
       ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾";
            break;

        case 3:
            echo "
       _______________
LIFE: ║ ● ● ● - - - - ║
       ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾";
            break;

        case 4:
            echo "
       _______________
LIFE: ║ ● ● ● ● - - - ║
       ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾";
            break;

        case 5:
            echo "
       _______________
LIFE: ║ ● ● ● ● ● - - ║
       ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾";
            break;

        case 6:
            echo "
       _______________
LIFE: ║ ● ● ● ● ● ● - ║
       ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾";
            break;

        case 7:
            echo "
       _______________
LIFE: ║ ● ● ● ● ● ● ● ║
       ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾";
            break;
    }
}
