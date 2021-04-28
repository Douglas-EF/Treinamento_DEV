<?php


// Contando a quantidade de palavras para selecionar com base no indice
$consulta = consultarPalavras();

$numero_random = random_int(0, array_key_last($dados));
echo "----------------------------\n\n";
echo $numero_random;
searchPalavra($consulta, $numero_random);
echo "\n\n ---------------------------";
/*
animacao_0();
animacao_1();
animacao_2();
animacao_3();
animacao_4();
animacao_5();
animacao_6();
animacao_7();
animacao_8();
animacao_9();
animacao_10();
*/
//print_r($qtd_palavras."\n\n\n");
//echo count($dados);
//print_r($numero_random[1]);





















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
function searchPalavra($palavra, $numero)
{
    $palavra["$numero"];
    print_r($palavra);
}

// Animações game
function animacao_0()
{
    echo "
    ┏━━━━━━━┓
    |       O
    |              
    |        
    |       
    |
    |
    |____
    ";
}

function animacao_1()
{
    echo "
    ┏━━━━━━━┓
    |       O
    |       |        
    |        
    |       
    |
    |
    |____
    ";
}

function animacao_2()
{
    echo "
    ┏━━━━━━━┓
    |       O
    |       |\        
    |        
    |       
    |
    |
    |____
    ";
}

function animacao_3()
{
    echo "
    ┏━━━━━━━┓
    |       O
    |       |\        
    |         *
    |       
    |
    |
    |____
    ";
}

function animacao_4()
{
    echo "
    ┏━━━━━━━┓
    |       O
    |      /|\        
    |         *
    |       
    |
    |
    |____
    ";
}

function animacao_5()
{
    echo "
    ┏━━━━━━━┓
    |       O
    |      /|\        
    |     *   *
    |       
    |
    |
    |____
    ";
}

function animacao_6()
{
    echo "
    ┏━━━━━━━┓
    |       O
    |      /|\        
    |     * | *
    |       
    |
    |
    |____
    ";
}

function animacao_7()
{
    echo "
    ┏━━━━━━━┓
    |       O
    |      /|\        
    |     * | *
    |        \
    |
    |
    |____
    ";
}

function animacao_8(){
    echo "
    ┏━━━━━━━┓
    |       O
    |      /|\        
    |     * | *
    |        \
    |         *
    |
    |____
    ";
}


function animacao_9()
{
    echo "
    ┏━━━━━━━┓
    |       O
    |      /|\        
    |     * | *
    |      / \
    |         *  
    |
    |____
    ";
}

function animacao_10()
{
    echo "
    ┏━━━━━━━┓
    |       O
    |      /|\        
    |     * | *
    |      / \
    |     *   *  
    |
    |____
    ";
}
