<?php
include_once 'conexao.php';
$OPT_VALUES = [1, 2, 3, 4, 5, 6, 7];
$USER_LOGADO = [];
date_default_timezone_set("America/Manaus");
echo date("d/m/Y H:i");


while (true) {

    echo "\n\tBem vindo ao nosso sistema...\n\n";
    $REQUEST = strtoupper(readline("        Para continuar é necessario informar um usuário, você já está cadastrado(S/N)?"));

    if (!($REQUEST == 'S' or $REQUEST == 'N')) {
        continue;
    } elseif ($REQUEST == 'S') {
        echo "\n\nOba, vomos lá então...\nInforme abaixo seus dados de login!\n\n";
        $CPF_USER = readline("►►►►► SEU CPF: ");
        $SENHA_USER = md5(readline("►►►►► SUA SENHA: "));

        $SQL = "SELECT * FROM usuario WHERE cpf_user = '$CPF_USER' AND senha_user = '$SENHA_USER'";
        $RESULT = mysqli_query($connect, $SQL);

        $USER_LOGADO = mysqli_fetch_array($RESULT);
        //print_r($USER_LOGADO);

        if (mysqli_num_rows($RESULT) > 0) {
            $USER_ON = true;
        } else {
            echo "Usuário ou senha invalido!";
            continue;
        }
    } elseif ($REQUEST == 'N') {
        echo "\nQue pena, vamos te cadastrar então...\n\n";
        $NOME_USER = readline("►►►►► NOME: ");
        $CPF_USER = readline("►►►►► CPF: ");
        $DATA_NASC_USER = readline("►►►►► DATA DE NASCIMENTO: ");
        $SENHA_USER = md5(readline("►►►►► SENHA: "));

        $SQL = "INSERT INTO usuario VALUES(null, '$NOME_USER', '$CPF_USER', '$DATA_NASC_USER', '$SENHA_USER')";
        mysqli_query($connect, $SQL);

        $USER_ON = true;
    }

    while ($USER_ON == true) {
        echos(0);

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
            $QUANTIDADE_PROD = readline("c Qual a quantidade do produto ");
            echo "\n\n";

            // Realizar os inserts na tabela produto e estoque
            $SQL = "INSERT INTO produto VALUES(null, '$NOME_PROD', '$VALOR_PROD', '$QUANTIDADE_PROD')";
            mysqli_query($connect, $SQL);
            $LAST_ID = mysqli_insert_id($connect);

            $SQL = "INSERT INTO estoque VALUES(NULL, '$NOME_PROD', '$QUANTIDADE_PROD', $LAST_ID)";
            mysqli_query($connect, $SQL);



            echo "O produto($NOME_PROD) foi cadastrado com sucesso!";
        } elseif ($OPTION == 2) {

            echos(1);

            $REQUEST = readline("Informe a opção desejada: ");
            if ($REQUEST == 1) {
                $SQL = "SELECT * FROM estoque";

                $RESULT = mysqli_query($connect, $SQL);
                echo "\n\n\tNOME" . "\t\tQUANTIDADE\n\n";

                while ($DADOS = mysqli_fetch_array($RESULT)) {
                    echo "\t" . $DADOS['nome_esto'] . "\t\t", $DADOS['quantidade_esto'] . "\n";
                }
            } else {

                $VL = readline("Qual o nome do produto? ");

                $SQL = "SELECT * FROM estoque WHERE nome_esto LIKE '%$VL%'";
                $RESULT = mysqli_query($connect, $SQL);
                $DADOS;
                $SUBMIT = [];
                echo "\n\n\tNOME" . "\t\tQUANTIDADE\n\n";
                while ($DADOS = mysqli_fetch_array($RESULT)) {
                    echo "\t" . $DADOS['nome_esto'] . "\t\t", $DADOS['quantidade_esto'] . "\n";
                    $SUBMIT[] = $DADOS['nome_esto'] . "|" . $DADOS['quantidade_esto'];
                }
                print_r($SUBMIT);
            }

            $SAVE_ARQ = strtoupper(readline("Deseja salva o arquivo?(S/N)"));

            if ($SAVE_ARQ == 'S') {
                save_dados($SUBMIT);
            }
        } elseif ($OPTION == 3) {
            echo "
    1 - Visualiazar Histórico completo
    2 - Pesquisar Histórico de um produto\n\n";
            $REQUEST = readline("Informe a opção desejada:");

            if ($REQUEST == 1) {
                $SQL = "SELECT * FROM modificacao_estoque";
                $RESULT = mysqli_query($connect, $SQL);
                echo "\n" . "┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
| NOME DO PRODUTO\t\t" . "USUÁRIO\t\t" . "DATA\t\t" . "HORÁRIO\t\t" . "QUANTIDADE ANTERIOR\t\t" . "QUANTIDADE ATUALIZADA\t|\n┗---------------------------------------------------------------------------------------------------------------------------------------┛\n";
                while ($DADOS = mysqli_fetch_array($RESULT)) {
                    echo "   " .
                        $DADOS['nome_prod_mod_esto'] . "\t\t\t" .
                        $DADOS['nome_user_mod_esto'] . "\t\t" .
                        $DADOS['data__mod_esto'] . "\t" .
                        $DADOS['hora__mod_esto'] . "\t" .
                        $DADOS['qtd_anterior_mod_esto'] . "\t\t\t\t" .
                        $DADOS['qtd_modificada_mod_esto'] . "\n";
                }
            } elseif ($REQUEST == 2) {

                $VL = readline("Qual o nome do produto que deseja visualizar? ");

                $SQL = "SELECT * FROM modificacao_estoque WHERE nome_prod_mod_esto LIKE '%$VL%'";

                $RESULT = mysqli_query($connect, $SQL);
                echo "┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
| NOME DO PRODUTO\t\t" . "USUÁRIO\t\t" . "DATA\t\t" . "HORÁRIO\t\t" . "QUANTIDADE ANTERIOR\t\t" . "QUANTIDADE ATUALIZADA\t|\n┗---------------------------------------------------------------------------------------------------------------------------------------┛\n";
            }

            while ($DADOS = mysqli_fetch_array($RESULT)) {
                echo "   " .
                    $DADOS['nome_prod_mod_esto'] . "\t\t\t" .
                    $DADOS['nome_user_mod_esto'] . "\t\t" .
                    $DADOS['data__mod_esto'] . "\t" .
                    $DADOS['hora__mod_esto'] . "\t" .
                    $DADOS['qtd_anterior_mod_esto'] . "\t\t\t\t" .
                    $DADOS['qtd_modificada_mod_esto'] . "\n";
            }

            // REALIZAR BAIXA NO ESTOQUE
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
            $OLD_QTD = $DADOS['quantidade_esto'];
            $NEW_QTD = $OLD_QTD - $QUANTIDADE;


            $SQL = "UPDATE estoque SET quantidade_esto = '$NEW_QTD' WHERE id_esto = '$INDICE'";
            mysqli_query($connect, $SQL);

            $SQL = "UPDATE produto SET quantidade_prod = $NEW_QTD WHERE id_prod = $INDICE";
            mysqli_query($connect, $SQL);

            echo "\n\n\nO ESTOQUE DO ITEM {$DADOS['nome_esto']}, FOI ATUALIZADO COM SUCESSO!\n\n\n";

            // SALVANDO O HISTÓRICO DA MODIFICAÇÃO            
            $USER_LOG = $USER_LOGADO['nome_user'];
            $ID_USER = $USER_LOGADO['id_user'];
            $PROD_MOD = $DADOS['nome_esto'];
            $DATA = date('d/m/Y');
            $HORA = date('H:i:s');


            $SQL = "INSERT INTO modificacao_estoque VALUES(null, '$PROD_MOD', '$USER_LOG', '$DATA', '$HORA', '$OLD_QTD', '$NEW_QTD', '$ID_USER')";
            mysqli_query($connect, $SQL);
        } elseif ($OPTION == 5) {

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
            $OLD_QTD = $DADOS['quantidade_esto'];
            $NEW_QTD = $OLD_QTD + $QUANTIDADE;


            $SQL = "UPDATE estoque SET quantidade_esto = '$NEW_QTD' WHERE id_esto = '$INDICE'";
            mysqli_query($connect, $SQL);

            $SQL = "UPDATE produto SET quantidade_prod = $NEW_QTD WHERE id_prod = $INDICE";
            mysqli_query($connect, $SQL);

            echo "\n\n\nO ESTOQUE DO ITEM {$DADOS['nome_esto']}, FOI ATUALIZADO COM SUCESSO!\n\n\n";

            // SALVANDO O HISTÓRICO DA MODIFICAÇÃO
            $USER_LOG = $USER_LOGADO['nome_user'];
            $ID_USER = $USER_LOGADO['id_user'];
            $PROD_MOD = $DADOS['nome_esto'];
            $DATA = date('d/m/Y');
            $HORA = date('H:i:s');


            $SQL = "INSERT INTO modificacao_estoque VALUES(null, '$PROD_MOD', '$USER_LOG', '$DATA', '$HORA', '$OLD_QTD', '$NEW_QTD', '$ID_USER')";
            mysqli_query($connect, $SQL);
        } elseif ($OPTION == 6) {
            break;
        } elseif ($OPTION == 7) {
            return false;
        }
    }
}

function echos($indice)
{
    switch ($indice) {
        case 0:
            echo "\n\n
┗━━━━━━━━━━━━━━━| MENU |━━━━━━━━━━━━━━━┛

        1 - CADASTRAR PRODUTO
        2 - VERIFICAR ESTOQUE
        3 - MODIFICAÇÕES NO ESTOQUE
        4 - DOWN ESTO
        5 - UP ESTO
        6 - TROCAR USUÁRIO
        7 - SAIR\n\n";
            break;
        case 1:
            echo "
            1 - Estoque completo
            2 - Estoque de um produto\n\n";
            break;
        case 2:

            break;
        case 3:

            break;
        case 4:

            break;
        case 5:

            break;
        case 6:

            break;
    }
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

function save_dados($DADOS)
{
    $fp = fopen('saves.txt', 'w');
    foreach ($DADOS as $value) {
        fwrite($fp, $value . "\n");
    }
    fclose($fp);
}
