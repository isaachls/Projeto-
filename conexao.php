<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";          
$banco = "banco_bremster"; 

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    echo "Conexão falhou";
    exit();
}
?>
