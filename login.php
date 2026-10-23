<?php
include('conexao.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM CLIENTE WHERE email = '$email'";
$resultado = mysqli_query($conexao, $sql);

$usuario = mysqli_fetch_assoc($resultado);

if ($usuario && $senha == $usuario['senha']) {
    
    session_start();
    $_SESSION['nome'] = $usuario['nome'];

    header("Location: index.html");
    exit();

} else {

    echo "<script>alert('E-mail ou senha incorretos!'); window.location.href='login.html';</script>";
}
?>
