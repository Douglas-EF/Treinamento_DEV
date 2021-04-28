<?php
/*
$nome = "123";

//var_dump($nome);
if (is_string($nome)) :
    echo "É uma String!";

else :
    echo "Não é uma String!";
endif;
echo "<hr>";
class  Cliente
{
    private $nome;
    public function atribuirNome($nome)
    {
        $this->$nome = $nome;
    }
}

$cliente = new Cliente();
$cliente->atribuirNome("Douglas");
var_dump($cliente);

//ACESSANDO ESCOPOS DIFERENTE

$num_1 = 10;
$num_2 = 55;
$num_3 = 32;

function soma()
{
    global$num_1;
    global$num_2;
    global$num_3;        
    echo $num_1 + $num_2 + $num_3;

    echo "<hr>";
    echo $GLOBALS['num_1'] + $GLOBALS['num_2'] + $GLOBALS['num_3'];
}

soma();
echo "<hr>";

//CONSTANTES
define("NOME", "Douglas Jerônimo da Silva");
define("IDADE", 18);
define("ALTURA", 1.70);
define("CASADO", false);
echo 'Nome: ' . NOME . ', IDADE: ' . IDADE . ', ALTURA: ' . ALTURA . ', CASADO: ' . CASADO;

echo '<hr>';
define("TIMES", ['Vasco', 'Flamengo', 'Palmeiras']);
//echo TIMES[2];

function exibeTime()
{
    echo (TIMES[0]);
}

exibeTime();

//ARRAYS

//$carros = array(1=>"BMW", 2=>"Veloster", 3=>"Hilux"); //Definir o indice do Arrays
$carros = array("BMW", "Veloster", "Hilux");
$carros[] = "Amarok";
print_r($carros);

echo "<hr>", $carros[1], "<hr>";

$motos = array();
$motos[] = "Fazer 250";
$motos[] = "CB 300";
$motos[] = "XRE 300";
$motos[] = "XJ6";

print_r($motos);
echo "<hr>";

$cliente = ["Rodrigo", "Filipe", "Douglas"];
print_r($cliente);
echo "<hr>", "O Array cliente possui: ", count($cliente), " clientes...", "<hr>", "Array Motos <br>";

//FOREACH
foreach ($motos as $valor) { //Para cada elemento do Array, será atribuida a variavel valor(Cada elemento do Array motos sera atribuido a variaval valor)!
    echo  $valor . "<br>";
}
echo "<hr>", "Array Carros <br>";
foreach ($carros as $modelo) {
    echo $modelo, "<br>";
}
echo "<hr>";

//ARRAY ASSOCIATIVOS(Quando os indices são String e não int)
$pessoa = array("nome" => "Douglas", "idade" => 18, "peso" => 80);
echo $pessoa["nome"];
$pessoa["cidade"] = "Ji-Paraná";
echo "<hr>";
print_r($pessoa);
echo "<hr>";

foreach ($pessoa as $indice => $valor) {
    echo $indice . ":" . $valor . "<br>";
}

//ARRAY MULTIDIMENSIONAIS
$times = array(
    "cariocas"  => array("1º Cololcado" => "Vasco", "2º Cololcado" => "Flamengo", "3º Cololcado" => "Botafogo"),
    "paulistas" => array("1º Cololcado" => "Santos", "2º Cololcado" => "São paulo", "3º Cololcado" => "Palmeiras"),
    "baianos"    => array("1º Cololcado" => "Bahia", "2º Cololcado" => "Vitória", "3º Cololcado" => "Itabuna")
);
//echo "<hr>".$times["cariocas"][0];
echo "<hr>";

foreach ($times["cariocas"] as $indice => $valor) {
    echo $indice . ": " . $valor . "<br>";
}
echo "<hr>";
foreach ($times["paulistas"] as $indice => $valor) {
    echo $indice . ": " . $valor . "<br>";
}
echo "<hr>";
foreach ($times["baianos"] as $indice => $valor) {
    echo $indice . ": " . $valor . "<br>";
}

//FUNCÕES PHP
$numeros = array("Um", "Dois", "Três", "Quatro", "Cinco");
$keys = array("Campeão", "Vice-campeão", "Terceiro");
$nome_times = array("Vasco", "Flamengo", "Botafogo");
echo is_array($num_1); //Se é um Array

if (in_array("Douglas", $pessoa)) :  //Se possui determinada inf no array
    echo "Existe no Array";
else :
    echo "Não existe no Array";
endif;
echo "<hr>";

$name_times = array_keys($times); //Retorna um novo Array com as chaves(indices) do Array passado como parâmetro
print_r($name_times);
echo "<hr>";

$values = array_values($pessoa); //Retorna um novo Array com valores do Array passado como parâmetro
print_r($values);
echo "<hr>";

$veiculos = array_merge($pessoa, $numeros); //Agregar valores de dois Arrays
print_r($veiculos);
echo "<hr>";

echo "Delelei o: " . array_pop($numeros) . "<hr>"; //Exclui a ultima posição do Array
print_r($numeros);
echo "<hr>";

echo "Delelei o: " . array_shift($numeros) . "<hr>"; //Exclui a primeira posição do Array
print_r($numeros);
echo "<hr>";

array_unshift($numeros, "0", "1"); //Adiciona um ou mais itens no inicio do Array
print_r($numeros);
echo "<hr>";

array_push($numeros, "0", "1"); //Adiciona um ou mais itens no final do Array
print_r($numeros);
echo "<hr>";

$combine = array_combine($keys, $nome_times); //Para mesclar dois Arrays
print_r($combine);
echo "<hr>";

$soma =  array(5, 6, 7, 10);
$result = array_sum($soma); //Realiza a soma de um Array
echo $result . "<hr>";

$data = "13/04/2021";
$frase = "Programação é uma montanha russa de amor e ódio";

$nova_data = explode('/', $data); //Explode - Transforma Strings em um Array
$nova_frase = explode(" ", $frase);
print_r($nova_data);
echo "<br>";
print_r($nova_frase);
echo "<hr>";


$nomes = array("Douglas", "Dayane", "Maria", "Amanda",);
$nomes_novos = implode(", ", $nomes); //Transforma um Array em uma Strig
print_r($nomes_novos);
echo "<hr>";

//CONDICIONAI
$media = 6;
echo ($media >= 6) ? "Aprovado" : "Reprovado"; //Operador ternário(If Else simplificado)
echo "<hr>";

$cor = "Amarelo";
switch ($cor):
    case "Vermelho":
        echo "Cor vermelha!";
        break;

    case "Azul":
        echo "Cor azul!";
        break;

    case "Amarelo":
        echo "Cor Amarela!";
        break;

    default:
        echo "Bem estranho sua cor!";

endswitch;

//INCREMENTO
$numero_teste = 55;
echo "<hr>";
//echo ++$numero_teste;
//echo $numero_teste++;
//echo $numero_teste;
//echo "<br>";
//echo --$numero_teste;
//echo $numero_teste--;
echo $numero_teste;

$var0 = 45;
$var1 = 55;

$var0 += $var1; // Equivalente a ($var0 = $var0 + $var1) -- %(para capturar o reto da divisão)
echo "<hr>";
//OPERADORES DE COMPARAÇÃO

10 == 10 - Igual
10 === 10 - Identico
10 !== 10 - Não identico
10 <> 10 - Diferente
10 <=> 10 - Spaceship (lado direito < retorna 1, dois lados == return 0, se lado esquerdo for menor return -1)


//OPERADORS LÓGICOS
$nome_djs = "Douglas";
$idade_djs = 18;

// xor - Ou é um, ou é outro
// ! - Negação de uma determinada expressão
if (($nome_djs === "Douglas") and ($idade_djs >= 18)) :
 //   echo "<script> alert ('Olá, $nome_djs acababos de constatar que você possui $idade_djs anos!');</script>";
else :
endif;

// WHILE & DO WHILE
$cont = 1;
while ($cont <= 10) :
    echo "Contador é $cont <br>";
    $cont++;
endwhile;

$cont = 1;
echo "<hr>";

do {
    echo "Contador é $cont <br>";
    $cont++;
} while ($cont <= 10);
echo "<hr>";

// FOR & FOREACH
for ($contador = 1; $contador <= 10; $contador++) :
    echo "Contador é: $contador <br>";
endfor;

echo "<hr>";
$cores = array("Verde", "Vermelho", "Azul", "Rosa");

foreach ($cores as $indice => $val_cor) :
    echo $indice . " - " . $val_cor . "<br>";
endforeach;
echo "<hr>";

for ($contad = 0; $contad <= 10; $contad++) :
    echo "8 x $contad = ".($contad*8). "<br>";
endfor;
echo "<hr>";

//FUNÇÕES PARA STRINGS
$nome_fs = "douglas jeronimo da silva";
echo strtoupper($nome_fs);
echo "<br>";
$nome_fs = "DOUGLAS JERONIMO DA SILVA";
echo strtolower($nome_fs);
echo "<hr>";

echo substr($nome_fs, 0, 7);
echo "<hr>";

$novo_nome_fs = str_pad($nome_fs, 35, "POLICARPO ", STR_PAD_LEFT); // Para atribuir novas caractres a String
echo $novo_nome_fs;
echo "<br>";
echo str_repeat($nome_fs, 5); //Repetir uma String
echo "<br>";
echo strlen($novo_nome_fs); //Conta os caractes de uma String
echo "<br>";

echo str_replace("POLICARPO ", "", $novo_nome_fs);
echo "<br>";

echo strpos($novo_nome_fs, "SILVA"); // Para saber a posição de algo em uma string
echo "<hr>";
*
// FUNÇÕES PARA NÚMEROS
$preco = 1499.99;
echo number_format($preco, 2, ",", "."); // Formatar algum número
echo "<br>";
echo round(3.492432123); // Aredondar um número
echo "<br>";
echo ceil(5.1); // Aredonda para cima
echo "<br>";
echo floor(5.99); // Aredonda para baixo
echo "<br>";
echo rand(1, 100); // Gera valores aleatórios
echo "<hr>";
*
// CRIANDO FUNÇÕES
function exibirNome($nome_informado)
{
    echo "Meu nome é $nome_informado";
}

exibirNome("Douglas Jerônimo da Silva");
echo "<hr>";

function calcularMedia($nome_informado, $nota1, $nota2, $nota3, $nota4)
{
    $soma_calc_media = ($nota1 + $nota2 + $nota3 + $nota4) / 4;
    $mesagem_func = "$nome_informado, sua média destas 4 notas informadas são: $soma_calc_media, e você foi";
    
    if($soma_calc_media >= 60):
        echo $mesagem_func." aprovado!";
    else:
        echo $mesagem_func." reprovado!";
    endif;
}

calcularMedia("Douglas", 68, 65, 90, 100);
echo "<hr>";

//VARIAVEIS SUPERGLOBAIS 
/*
    $_POST
    $_GET
    $_FILES
    $_ENV
    $_REQUEST
    $_COOKIE
    $_SESSION


echo $_SERVER['PHP_SELF'] . "<br>"; // Nome do arquivo do Script que esta sendo executado
echo $_SERVER['SERVER_NAME'] . "<br>"; // Nome do HOST do servidor
echo $_SERVER['SCRIPT_FILENAME'] . "<br>"; // Caminho absoluto do Script
echo $_SERVER['DOCUMENT_ROOT'] . "<br>"; // Retorna o diretório raiz do Script
echo $_SERVER['SERVER_PORT'] . "<br>"; // Retorna a porta do servidor
echo $_SERVER['REMOTE_ADDR'] . "<br>"; // Retorna o IP de onde o usuário esta acessando a pagina

<body>
<!DOCTYPE html>
<html lang="en">
    <form action="dados.php" method="POST"><br>
        Nome: <input type="text" name="nome" required><br><br>
        Email: <input type="email" name="email" required><br><br>

        <button type="submit">ENVIAR</button>
    </form>

    <!--
        <a href="dados.php?idade=25&sobrenome=Jerônimo">Enviar Dados</a> 
        Passando dados utilizando o GET através de um Link
    -->

</body>

</html>


if (isset($_POST['enviar_formulario'])) :
    //Criada a array de Erros
    $erros = array();
    //Validações
    if (!$idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT)) :
        //echo "<script> alert ('Sua idade é um inteiro');</script>";
        $erros[] = "Sua idade precisa ser um número inteiro";
    endif;

    if (!$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) :
        $erros[] = "Email inválido";
    endif;

    if (!$email = filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_FLOAT)) :
        $erros[] = "Peso precisa ser um float";
    endif;

    if (!$email = filter_input(INPUT_POST, 'ip', FILTER_VALIDATE_IP)) :
        $erros[] = "IP inválido";
    endif;

    if (!$email = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL)) :
        $erros[] = "URL inválido";
    endif;

    //Exibindo Mensagens de Erro
    if (!empty($erros)) :
        foreach ($erros as $erro) :
            echo "<li> $erro </li>";
        endforeach;

    else :
        echo "<script> alert ('Parabéns, todos os dados informados estão corretos!');</script>";

    endif;

endif;
*/

if (isset($_POST['enviar_formulario'])) :
    //Criada a array de Erros
    $erros = array();

    //Sanitize
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    

    $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);
    if(!filter_var($idade, FILTER_VALIDATE_INT)):
        $erros[] = "Idade precisa ser um inteiro!";
    endif; 

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
        $erros[] = "Email inválido!";
    endif; 

    $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
    if(!filter_var($url, FILTER_VALIDATE_EMAIL)):
        $erros[] = "URL  inválido!";
    endif; 

    //Exibindo Mensagens de Erro
    if (!empty($erros)) :
        foreach ($erros as $erro) :
            echo "<li> $erro </li>";
        endforeach;

    else :
        //echo "<script> alert ('Parabéns, todos os dados informados estão corretos!');</script>";
        echo "<br>"."Parabéns, todos os dados informados estão corretos!"."<br>";
    endif;

endif;

?>
<!-- FILTROS DE VALIDAÇÃO -->
<!DOCTYPE html>
<html lang="en">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"><br>
    Nome: <input type="text" name="nome"><br><br>
    Idade: <input type="text" name="idade"><br><br>
    Email: <input type="text" name="email"><br><br>
    IP: <input type="text" name="ip"><br><br>
    URL: <input type="text" name="url"><br><br>

    <button type="submit" name="enviar_formulario">ENVIAR</button>
</form>

</body>

</html>