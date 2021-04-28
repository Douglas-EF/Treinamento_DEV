<?php
while (true) {    
    echo "MENU\n1-iniciar o jogo\n2-Ver o rank\n3-Para sair\n";
    $options_menu = (int) readline("");
    
    if ($options_menu == 1) {
        $numero_aleatorio = random_int(1, 100);
        $numero_informado = 0;        
        $nome = "";

        while ($nome == "") {
            $nome = readline("Informe seu nome:");            
        }

        while ($numero_informado != $numero_aleatorio) {
            echo "Informe um número entre 1 a 100\n";
            $numero_informado = (int) readline("");
            
            if ($numero_informado < $numero_aleatorio) {
                echo $numero_aleatorio." Informe um numero maior\n";
            }

            if ($numero_informado > $numero_aleatorio) {
                echo $numero_aleatorio." Informe um numero menor\n";                
            }

            if ($numero_informado == $numero_aleatorio) {
                echo "Voce acertou !!!\n";

                echo "Para iniciar o jogo digite qualquer tecla\nPara sair do jogo digite 3\n";
                $opcao = (int) readline("");

                if ($opcao == 3) {
                    return false;
                }
            }
        }
    } elseif ($options_menu == 2) {
        echo "Opção 2";
    } elseif ($options_menu == 3) {        
        break;
    }
}
