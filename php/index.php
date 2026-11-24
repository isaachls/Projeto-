<?php
session_start();
require_once('conexao.php');

    $sql = "SELECT
    p.id_produto,
    p.nome_produto,
    p.marca,
    (
        SELECT v.preco
        FROM variacao v
        WHERE v.id_produto = p.id_produto
        ORDER BY v.id_variacao
        LIMIT 1
    ) AS preco,
    (
        SELECT img.caminho_imagem
        FROM variacao v
        INNER JOIN imagem img
            ON img.id_produto = v.id_produto
            AND img.id_cor = v.id_cor
        WHERE v.id_produto = p.id_produto
        ORDER BY v.id_variacao
        LIMIT 1
    ) AS imagem
    FROM produto p
    ORDER BY p.id_produto DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar - Bremster</title>
    <link rel="stylesheet" href="../css/style.css">
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

    <main class="conteudo-explorar">

        <?php if (isset($_SESSION['nome'])): ?>
            <h1 style="margin-bottom: 20px;">Olá, <strong><?php echo $_SESSION['nome']; ?></strong>!</h1>
        <?php endif; ?>


        <div class="header"> 
            <div class="texto-header">
                <p><strong>Roupas Y2K com</strong> <br> descontos de até</p>
                <h3>40%</h3> 
            </div>
            <div class="final-header">
                <p>Desconto de 10% na sua primeira compra</p>
                <p>CUPOM: Primeiracompra</p>
            </div>
        </div>  

        <h1>Novidades para <strong>você</strong></h1>

        <div class="lista-produtos">

        <?php foreach ($produtos as $produto): ?>

            <div class="produto">

                <a href="produto.php">
                    <div class="balao-roupa">
                        <img 
                            src="../<?= htmlspecialchars($produto['imagem']) ?>" 
                            alt="<?= htmlspecialchars($produto['nome_produto']) ?>"
                        >
                    </div>
                </a>

                <div class="info-roupa">
                    <p class="nomeProduto">
                        <?= htmlspecialchars($produto['nome_produto']) ?>
                    </p>

                    <p class="precoProduto">
                        R$<?= number_format($produto['preco'], 2, ',', '.') ?>
                    </p>
                </div>

                <button 
                    class="adicionar-carrinho"
                    data-id="<?= $produto['id_produto'] ?>"
                >
                    Adicionar ao carrinho
                </button>

            </div>

    <?php endforeach; ?>

</div>

    </main>

    <footer class="rodape">
        <div class="conteudo">
            <div class="coluna-1">
                <div class="logo-rodape">
                    <h1>Br</h1> <p>Bremster</p> 
                </div>
                <p>Rua xx, <br> Recife, Pernambuco</p>
                <div class="copyright">
                    <p>© 2026 Bremster. All rights reserved</p>
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

    <script src="../js/index.js"></script>
</body>    
</html>
