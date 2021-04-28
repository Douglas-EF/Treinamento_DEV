<?php
// Variáveis de ativação de determinados Loops
$start_game = true;
$play = true;
$loop_name = true;
$new_play = true;

$nome_player;
$numero_informado = "";
$list_rank = array();

$pts = 100;

const OPT_INICIAR = 1;
const OPT_RANK = 2;
const OPT_SAIR = 3;

$options_menu = array(OPT_INICIAR => "Iniciar", OPT_RANK => "Ver Rank", OPT_SAIR => "Sair");

while (true) :
    // Função pra exibir Menu
    $option_selected = exibe_menu();

    // Selecionada a opção 1
    if ($option_selected == OPT_INICIAR) :
        $start_game = true;
        $play = true;
        $nome_player = "";
        echo "\n \n \n" . "┗━━━━━━━━━━━━━━━| STARTING THE GAME |━━━━━━━━━━━━━━━┛" . "\n \n";

        // Dando Start no Game
        while ($start_game == true) :
            // Verificar se o nome do player esta vazio
            if (empty($nome_player)) {
                $nome_player = ler_nome();
            }

            $primeiro_nome = explode(" ", $nome_player);
            $numero_aleatorio = random_int(1, 100);
            echo "\n";

            while ($play == true) :
                echo $numero_aleatorio . "\n";
                $new_play = true;

                // Função para verificar se a pontuação do player chegou a Zero
                if (verificar_pts() == false) {
                    continue;
                }

                $numero_informado = intval(readline("►►►►►►►►►►►►►►►►►►►► DIGITE UM NÚMERO(entre 1 e 100): ") . "\n\n");

                if (empty($numero_informado) || !(is_int($numero_informado)) || $numero_informado > 100) {
                    msg_erro();
                    continue;
                }

                // Verificar se o número informado é > que o numero aleatório
                if ($numero_informado > $numero_aleatorio) :
                    $_diff1 = $numero_informado - $numero_aleatorio;
                    // Chamando a função para apresentar dicas quando o número informado for >
                    inform_dica_maior($_diff1);

                elseif ($numero_informado < $numero_aleatorio) :
                    $_diff2 = $numero_aleatorio - $numero_informado;
                    // Chamando a função para apresentar dicas quando o número informado for <
                    inform_dica_menor($_diff2);

                else :
                    // Verificar se o usuário atingiu sua pontuaçã máxima e chamar func para formatar variáveis para exibilas nas mensagens
                    $tabela_geral = consultaPontuacao();
                    $pontuacao = [];
                    foreach ($tabela_geral as $name) {
                        if ($name['nome'] == $nome_player) {
                            $pontuacao[] = $name['pts'];
                        }
                    }
                    format_variables();


                    if ($maior_pts == true) {
                        if ((int)$tota_pts <= (int)$maior_pts) {
                            // Função para exibir msg de Game Over
                            msg_game_over($tota_pts_1, $maior_pts_1);
                        } elseif ((int)$tota_pts > (int)$maior_pts) {
                            // Função para exibir msg de acerto & inserir os dados do jogador no arquivo rank.txt 
                            msg_acerto($pri_name, $tota_pts);
                            insert_rank($nome_player, $pts);
                        }
                    } elseif ($maior_pts == false) {
                        // Função para exibir msg de acerto & inserir os dados do jogador no arquivo rank.txt
                        msg_acerto($pri_name, $tota_pts);
                        insert_rank($nome_player, $pts);
                    }

                    while ($new_play == true) :

                        echo "-------------------------------------------" . "\n ";
                        $return =  strtoupper(readline("Deseja jogar novamente? (S/N):"));
                        echo "-------------------------------------------" . "\n ";

                        // Verificar e redirecionar o usuário conforme sua resposta
                        if (!($return == "S" || $return == "N")) {
                            echo "\n \n" . "►►►►►►►►►► OPA, NÃO ENTENDI O QUE VOCÊ DIGITOU, TENTE NOVAMENTE..." . "\n \n";
                            continue;
                        }

                        if ($return == "S") :
                            // Função para reiniciar o Game
                            restart_game();

                        elseif ($return == "N") :
                            // Função para voltar ao Menu
                            exit_game();

                        endif;

                    endwhile;

                endif;

            endwhile;

        endwhile;


    // Selecionado a Opção 2
    elseif ($option_selected == OPT_RANK) :
        // Chamando a função para exibiro o Rank        
        exibir_rank();

    // Selecionado a Opção 3    
    elseif ($option_selected == OPT_SAIR) :
        return false;

    endif;

endwhile;



//--------------------------| FUNÇÕES |--------------------------\


// Função para estruturar o menu
function exibe_menu()
{
    global $options_menu;
    echo "\n" . "┗━━━━━━━━━━━━━━━| GAME MENU |━━━━━━━━━━━━━━━━┛" . "\n \n";
    echo "\t \t" . "┏━━━━━━━━━━━━┓" . "\n";
    foreach ($options_menu as $indice => $opc) {
        echo "\t \t|" . $indice . " - " . mb_str_pad($opc, 8, " ") . "|\n";
    }
    echo "\t \t┗━━━━━━━━━━━━┛" . "\n";

    $option_selected = (int) readline("Informe o número da opção desejada: ");

    if (!in_array($option_selected, array_keys($options_menu))) {
        echo "\n \n" . "►►►►►►►►►► OPS, NÃO CONSEGUI ENTENDER O QUE VC DIGITOU, TENTE NOVAMENTE..." . "\n \n";
        return exibe_menu();
    }

    return $option_selected;
}

// Função para verificar pontução
function verificar_pts()
{
    global $verificador, $start_game, $play, $new_play, $pts;
    if ($pts <= 0) {
        msg_end_game();
        $start_game = false;
        $play = false;
        $new_play = false;
        $pts = 100;
    } else {
    }

    return $play;
}

// Função para informar Dicas quando o nº informado for >
function inform_dica_maior($diferença)
{
    global $pts;

    if ($diferença <= 10) :

        if ($diferença <= 5) {
            echo "►►►►►►►►►►►►► DICA: Seu número bateu na trave!" . "\n";
            echo "►►►►►►► Tente novamente..." . "\n \n \n";
            ponts_down($pts);
        } else {
            echo "►►►►►►►►►►►►► DICA: Seu número chegou perto!" . "\n";
            echo "►►►►►►► Tente novamente..." . "\n \n \n";
            ponts_down($pts);
        }

    elseif ($diferença >= 20 and $diferença <= 40) :
        echo "►►►►►►►►►► DICA: Chutou muito alto!" . "\n";
        echo "►►►►► Tente novamente..." . "\n \n \n";
        ponts_down($pts);

    elseif ($diferença > 40) :
        echo "►►►►►►►►►► DICA: Chutou EXTREMAMENTE alto!" . "\n";
        echo "►►►►► Tente novamente..." . "\n \n \n";
        ponts_down($pts);

    else :
        echo "►►►►►►►►►► DICA: Chutou alto!" . "\n";
        echo "►►►►► Tente novamente..." . "\n \n \n";
        ponts_down($pts);

    endif;
}

// Função para informar Dicas quando o nº informado for <
function inform_dica_menor($diferença)
{
    global $pts;

    if ($diferença <= 10) :
        if ($diferença <= 5) {
            echo "►►►►►►►►►►►►► DICA: Seu número bateu na trave!" . "\n";
            echo "►►►►►►► Tente novamente..." . "\n \n \n";
            ponts_down($pts);
        } else {
            echo "►►►►►►►►►►►►► DICA: Seu número chegou perto!" . "\n";
            echo "►►►►►►► Tente novamente..." . "\n \n \n";
            ponts_down($pts);
        }

    elseif ($diferença >= 20 and $diferença <= 40) :
        echo "►►►►►►►►►► DICA: Chutou muito baixo!" . "\n";
        echo "►►►►► Tente novamente..." . "\n \n \n";
        ponts_down($pts);
    elseif ($diferença > 40) :
        echo "►►►►►►►►►► DICA: Chutou EXTREMAMENTE baixo!" . "\n";
        echo "►►►►► Tente novamente..." . "\n \n \n";
        ponts_down($pts);
    else :
        echo "►►►►►►►►►► DICA: Chutou baixo!" . "\n";
        echo "►►►►► Tente novamente..." . "\n \n \n";
        ponts_down($pts);
    endif;
}

// Função para realizar a consulta de dados salvo no arquivo
function consultaPontuacao()
{
    $reg_linhas = [];

    if (file_exists("rank.txt")) {
        $arq_list = fopen("rank.txt", "r");
        while (($data = fgetcsv($arq_list, 0, "|")) != false) {
            $reg_linhas[] =
                [
                    'nome' => $data[0],
                    'pts' => $data[1]
                ];
        }
        fclose($arq_list);
        array_multisort(array_column($reg_linhas, 'pts'), SORT_DESC, array_column($reg_linhas, 'nome'), SORT_ASC,  $reg_linhas);
    }
    return $reg_linhas;
}

// Formatando variáveis
function format_variables()
{
    global $primeiro_nome, $pri_name, $tota_pts, $pts, $maior_pts, $pontuacao, $maior_pts_1, $tota_pts_1;

    $nick = strval($primeiro_nome[0]);
    $pri_name = mb_str_pad($nick, 9, " ");
    $tota_pts = mb_str_pad($pts, 4, " ");

    $maior_pts = current($pontuacao);
    $maior_pts_1 = mb_str_pad($maior_pts, 12, " ");
    $tota_pts_1 = mb_str_pad($pts, 11, " ");
}

// Função para inserir dados do usuário(nome e pontuação) em um arquivo
function insert_rank($nome_player, $pts)
{
    $fp = fopen('rank.txt', 'a');
    fwrite($fp, $nome_player . "|" . $pts . "\n");
    fclose($fp);
}
        

if (!($valor > 10)) {
    echo "";
}

// Função para redirecionar(a jogar novamente) o player ao término do Game
function restart_game()
{
    global $numero_aleatorio, $pts, $play, $start_game, $new_play;
    echo "\n \n" . "►►►►►►►►►► Obaaa, vamos lá então..." . "\n \n";
    $numero_aleatorio = random_int(1, 100);
    $pts = 100;
    $play = true;
    $start_game = true;
    $new_play = false;
}

// Função para redirecionar(ao menu) o player ao término do Game
function exit_game()
{
    global $start_game, $play, $new_play, $pts;
    echo "\n" . "►►►►►►►►►► Que pena :( até a próxima então..." . "\n\n\n";
    $start_game = false;
    $play = false;
    $new_play = false;
    $pts = 100;

    return $play;
}

// Função para realizar loop no nome do usário
function ler_nome()
{
    while (true) {
        $nome_player = strval(readline("►►►►► Qual o seu nome?: "));

        if (!empty($nome_player)) return $nome_player;

        echo "\n" . "►►►►►►►►►► PARA CONTINUAR É NECESSARIO INFORMAR O SEU NOME!" . "\n";
    }
}

// Função para determinar o prenchimento de uma string(Embelezamento)
function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT, $encoding = 'UTF-8')
{
    $mb_diff = mb_strlen($input, $encoding) - strlen($input);
    return str_pad($input, $pad_length - $mb_diff, $pad_string, $pad_type);
}

// Função para exibir o Rank
function exibir_rank()
{
    echo "\n" . "┏━━━━━━━━━━━━━━━━━━━━━━━━| RANK |━━━━━━━━━━━━━━━━━━━━━━━━━━━┓" . "\n";
    $rank = consultaPontuacao();

    foreach ($rank as $values) {
        echo "| Nome --> |" . mb_str_pad($values['nome'], 29, " ") . "Pontuação --> |" . mb_str_pad($values['pts'], 4, " ") . "|\n";
    }
    echo "┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛" . "\n \n \n";
}

// Função para diminuir pontos
function ponts_down(&$pts)
{
    $pts -= 25;
}

// Funções destinadas a exibirem mgs
function msg_erro()
{
    echo "\n" . "
     ▒▒▒▒▒    ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
    ▒─▄▒─▄▒---| ASSIM EU NÃO POSSO BRINCAR COM VOCÊ! |
    ▒▒▒▒▒▒▒   ┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
    ▒▒▒▒▒▒▒
    ▒ ▒ ▒ ▒" . "\n ";
}

function msg_acerto($pri_name, $tota_pts)
{
    echo "
    ╭━━━━╮   ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
    ┃╭╮╭╮┃┈┈ ┃ PARABÉNS $pri_name                        ┃
   ┗┫┏━━┓┣┛  ┃ VOCÊ ACERTOU!!!                           ┃
    ┃╰━━╯┃   ┃___________________________________________┃  
    ╰┳━━┳╯   ┃ PONTUAÇÃO: $tota_pts ┃
             ┗━━━━━━━━━━━━━━━━━┛" . "\n";
}

function msg_game_over($tota_pts_1, $maior_pts_1)
{
    echo "
    █████████    ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
    █▄█████▄█ ┈┈ ┃ VOCÊ ACERTOU, PORÉM NÃO CONSEGUIU ATINGIR SUA   ┃
    █▼▼▼▼▼       ┃ MAIOR PONTUAÇÃO!                                ┃
    █            ┃                                                 ┃
    GAME OVER!   ┃ PONTUAÇÃO DESTA PARTIDA: $tota_pts_1            ┃
    █▲▲▲▲▲       ┃ MAIOR PONTUAÇÃO: $maior_pts_1                   ┃
    █████████    ┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛                                                 
      ██ ██" . "\n \n";
}

function msg_end_game()
{
    echo "
    █████████    ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
    █▄█████▄█ ┈┈ ┃ VOCÊ É MUITO RUIM!         ┃
    █▼▼▼▼▼       ┃ CHEGOU A ZERO(0) PONTOS... ┃
    █            ┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
    GAME OVER!
    █▲▲▲▲▲
    █████████
      ██ ██" . "\n \n";
}
