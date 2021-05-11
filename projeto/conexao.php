<?php
$SERVER = "localhost";
$USER = "root";
$SENHA = "root";
$NAME_BD = "bd_papelaria";

$connect = mysqli_connect($SERVER, $USER, $SENHA, $NAME_BD);
mysqli_set_charset($connect, "UTF-8");

if (mysqli_connect_error()) :
    echo "Falha na conexão: " . mysqli_connect_error();
endif;