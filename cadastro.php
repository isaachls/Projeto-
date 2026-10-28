<?php
session_start();
include('conexao.php');

$mensagemErro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $dataNascimento = new DateTime($nascimento);
    $dataHoje = new DateTime('today');
    $idade = $dataNascimento->diff($dataHoje)->y;

    if ($idade < 18) {
        $mensagemErro = "Você precisa ter pelo menos 18 anos para se cadastrar!";
    } else {
      
        $sqlBusca = "SELECT * FROM CLIENTE WHERE email = '$email'";
        $resultadoBusca = mysqli_query($conexao, $sqlBusca);

        if (mysqli_num_rows($resultadoBusca) > 0) {
            $mensagemErro = "Este e-mail já está cadastrado!";
        } else {
     
            $sqlSalvar = "INSERT INTO CLIENTE (nome, nascimento, email, senha) VALUES ('$nome', '$nascimento', '$email', '$senha')";
            $resultadoSalvar = mysqli_query($conexao, $sqlSalvar);

            if ($resultadoSalvar) {
                $_SESSION['nome'] = $nome;
                header("Location: login.php");
                exit();
            } else {
                $mensagemErro = "Erro ao cadastrar usuário no banco de dados.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="topo"></div>
    <header class="cabecalho">
        <nav class="menu-esquerdo">
            <ul class="menu-esquerdo-ul">
                <li class="tem-menu">
                    <button class="botao-menu"><a href="contato.php">Contato</a></button>
                    <ul class="submenu">
                        <li>
                            <button class="botao-transparente"><a href="contato.php">Enviar recado</a></button>
                        </li>
                        <li>
                            <button class="botao-transparente"><a href="contato.php">Avaliar</a></button>
                        </li>
                     </ul>
                </li>
                <li class="tem-menu">
                    <button class="botao-menu"><a href="sobre.php">Sobre nós</a></button>
                    <ul class="submenu">
                        <li>
                            <button class="botao-transparente"><a href="sobre.php">Quem somos?</a></button>
                        </li>
                     </ul>
                </li>
            </ul>
        </nav>

        <a class="logo" href="index.php">Bremster</a>

        <nav class="menu-direito">
            <ul class="menu-direito-ul">
                 <li class="tem-menu">
                     <button class="botao-menu"><a href="index.php">Explorar</a></button>
                     <ul class="submenu">
                        <li>
                            <button class="botao-transparente"><a href="index.php">Promoções</a></button>
                        </li>
                        <li>
                            <button class="botao-transparente"><a href="index.php">Para você</a></button>
                        </li>
                     </ul>
                </li>


                <?php if (isset($_SESSION['nome'])): ?>

                    <li class="tem-menu">
                     <button class="botao-menu"><a href="dashboard.php">Carrinho</a></button>
                     <ul class="submenu">
                        <li>
                            <button class="botao-transparente"><a href="dashboard.php">Minha sacola</a></button>
                        </li>
                     </ul>
                    </li>

                    <li class="tem-menu">
                        <button class="botao-menu botao-sair"><a href="logout.php">Sair</a></button>
                    </li>
                <?php else: ?>
                    <li class="tem-menu">
                         <button class="botao-menu"><a href="login.php">Login</a></button>
                         <ul class="submenu">
                            <li>
                                <button class="botao-transparente"><a href="login.php">Entrar</a></button>
                            </li>
                            <li>
                                <button class="botao-transparente"><a href="cadastro.php">Cadastrar</a></button>
                            </li>
                         </ul>
                    </li>
                <?php endif; ?>


                 
            </ul>
        </nav>
            
    </header>

    <main class="conteudo-cadastro">

        <?php if (!empty($mensagemErro)): ?>
            <script>alert("<?php echo $mensagemErro; ?>");</script>
        <?php endif; ?>

        <form class="form-cadastro" action="cadastro.php" method="POST">
            <h1>Cadastre-se</h1>
            
            <label>Nome</label>
            <input type="text" name="nome" placeholder="Seu nome" required>

            <label>Data de Nascimento</label>
            <input type="date" name="nascimento" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="Seu email" required>

            <label>Senha</label>
            <input type="password" name="senha" placeholder="Sua senha" required>

            <button type="submit">Cadastrar</button>
        </form>

        <div class="imagem-login">
            <img class="moda" src="img/Moda.png" alt="Mulher e Moda">
        </div>

    </main>
    <footer class="rodape">
        <div class="conteudo">
            <div class="coluna-1">
                <div class="logo-rodape">
                    <h1>Br</h1>
                    <p>Bremster</p>
                </div>

                <p>Rua xx, <br> Recife, Pernambuco</p>

                <div class="copyright">
                    <p> © 2026 Bremster. All rights reserved</p>
                </div>
            </div>
            <div class="coluna-2">
                <h4>Email</h4>
                <p>bremster@gmail.com</p>

                <h4>Telefone</h4>
                <p>(81) 9 1234-5678</p>

            </div>
            <div class="coluna-3">
                <h4>Horário</h4>
                <p>Segunda - sexta</p>
                <p>08am - 06pm</p>

            </div>
            <div class="coluna-4">
                <h4>Nos siga</h4>
                <a href="">Instagram</a> <br>
                <a href="">Facebook</a> <br>
                <a href="">Twitter</a>

            </div>

        </div>

    </footer>

    <script src="js/cadastro.js"></script>

</body>

</html>
