<?php
include('conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sqlBusca = "SELECT * FROM CLIENTE WHERE email = '$email'";
$resultadoBusca = $pdo->query($sqlBusca);

if ($resultadoBusca->rowCount() > 0) {
 
    echo "<script>alert('Este e-mail já está cadastrado!'); window.history.back();</script>";
} else {
  
    $sqlSalvar = "INSERT INTO CLIENTE (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    $resultadoSalvar = $pdo->query($sqlSalvar);

    if ($resultadoSalvar) {
        header("Location: dashboard.html");
        exit; 
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>
