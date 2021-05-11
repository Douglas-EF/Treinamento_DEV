<?php
include_once 'conexao.php';

while (true) {
    echo "
    1 - CADASTRAR PRODUTO 
    2 - VERIFICAR ESTOQUE
    3 -  + ESTO
    4 -  - ESTO
    5 - SAIR
    
    ";
    $OPT_VALUES = [1, 2, 3, 4, 5];

    $OPTION = (int) readline("Informe a opção desejada: ");

    if (!(in_array($OPTION, $OPT_VALUES))) {
        echo "\n\n\nOPA, NÃO ENTENDI O QUE VC DIGITOU... TENTE NOVAMENTE!\n\n\n";
        continue;
    } elseif ($OPTION == 1) {
        echo "\n\n";
        $NOME_PROD = readline("►►►►►►►►►►►►►►► Qual o nome do produto? ");
        echo "\n";
        $VALOR_PROD = readline("►►►►►►►►►► Qual o valor do produto? ");
        echo "\n";
        $QUANTIDADE_PROD = readline("►►►►► Qual a quantidade do produto ");
        echo "\n\n";

        $SQL = "INSERT INTO produto VALUES(null, '$NOME_PROD', '$VALOR_PROD', '$QUANTIDADE_PROD')";
        mysqli_query($connect, $SQL);

        $SQL = "INSERT INTO estoque VALUES(NULL, '$NOME_PROD', '$QUANTIDADE_PROD', '')";



        echo "OPC 1";
    } elseif ($OPTION == 2) {

        $SQL = "SELECT * FROM estoque";

        $RESULT = mysqli_query($connect, $SQL);
        echo "\n\n\tNOME" . "\t\tQUANTIDADE\n\n";
        while ($DADOS = mysqli_fetch_array($RESULT)) {
            echo "\t" . $DADOS['nome_esto'] . "\t\t", $DADOS['quantidade_esto'] . "\n";
        }
    } elseif ($OPTION == 3) {

        require_once 'conexao.php';
        $SQL = "SELECT * FROM estoque";

        $RESULT = mysqli_query($connect, $SQL);
        echo "\nPOSIÇÃO\t" . "\tNOME" . "\t\tQUANTIDADE\n";
        while ($DADOS = mysqli_fetch_array($RESULT)) {
            echo $DADOS['id_esto'] . "\t\t" . $DADOS['nome_esto'] . "\t\t", $DADOS['quantidade_esto'] . "\n";
        }
        echo "\n";
        $INDICE = readline("Informe a posição do produto que deseja alterar: ");

        $QUANTIDADE = (int) readline("Quantos produtos deseja incluir? ");

        // Consulta para verificar a quantidade OLD
        $SQL = "SELECT * FROM estoque WHERE id_esto = '$INDICE'";
        $RESULT = mysqli_query($connect, $SQL);
        $DADOS = mysqli_fetch_array($RESULT);
        $NEW_QTD = $DADOS['quantidade_esto'] + $QUANTIDADE;


        $SQL = "UPDATE estoque SET quantidade_esto = '$NEW_QTD' WHERE id_esto = '$INDICE'";

        mysqli_query($connect, $SQL);

        echo "\n\n\nO ESTOQUE DO ITEM {$DADOS['nome_esto']}, FOI ATUALIZADO COM SUCESSO!\n\n\n";
    } elseif ($OPTION == 4) {
        require_once 'conexao.php';
        $SQL = "SELECT * FROM estoque";

        $RESULT = mysqli_query($connect, $SQL);
        echo "\nPOSIÇÃO\t" . "\tNOME" . "\t\tQUANTIDADE\n\n";
        while ($DADOS = mysqli_fetch_array($RESULT)) {
            echo $DADOS['id_esto'] . "\t\t" . $DADOS['nome_esto'] . "\t\t", $DADOS['quantidade_esto'] . "\n";
        }
        echo "\n";
        $INDICE = readline("Informe a posição do produto que deseja alterar: ");

        $QUANTIDADE = (int) readline("Quantos produtos deseja retirar? ");

        // Consulta para verificar a quantidade OLD
        $SQL = "SELECT * FROM estoque WHERE id_esto = '$INDICE'";
        $RESULT = mysqli_query($connect, $SQL);
        $DADOS = mysqli_fetch_array($RESULT);
        $NEW_QTD = $DADOS['quantidade_esto'] - $QUANTIDADE;


        $SQL = "UPDATE estoque SET quantidade_esto = '$NEW_QTD' WHERE id_esto = '$INDICE'";

        mysqli_query($connect, $SQL);

        echo "\n\n\nO ESTOQUE DO ITEM {$DADOS['nome_esto']}, FOI ATUALIZADO COM SUCESSO!\n\n\n";
    } elseif ($OPTION == 5) {
        break;
    }
}
