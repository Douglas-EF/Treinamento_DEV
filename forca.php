<?php


// Contando a quantidade de palavras para selecionar com base no indice
consultarPalavras();

$numero_random = random_int(0, count($dados));

print_r($dados[$numero_random]);


$consulta = consultarPalavras();


$qtd_palavras = (array_key_last($dados));

//print_r($qtd_palavras."\n\n\n");
//echo count($dados);
//print_r($numero_random[1]);





















// Função para armazenar em array as palavras salvas no arquivo palavras.txt 
function consultarPalavras()
{
    global $dados;
    $dados = [1 => "informar"];

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
}
