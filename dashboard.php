<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
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

    <main class="conteudo-carrinho">

        <section class="carrinho">
            <h1> Meu <strong>carrinho</strong></h1>

            <div class="traco"></div>

            <div class="pedido" id="lista-carrinho">


            </div>


            <div class="traco"></div>

        </section>

        <section class="resumo">
            <h1> Resumo do <strong>pedido</strong></h1>

            <div class="traco"></div>


            <div class="valor">
                <h3> Subtotal com taxas </h3>
                <h3 id="subtotal-valor">R$ 0,00</h3>
            </div>



            <div class="traco"></div>


            <div class="valor-total">
                <h3> Total </h3>
                <h3 id="total-valor">R$ 0,00</h3>
            </div>


            <div class="traco"></div>

            <div class="cupom">

                <label>Cupom</label>
                <input id="cupom" type="text" placeholder="Insira o código de cupom">

                <button>Prosseguir</button>

            </div>

        </section>


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

    <script src="js/dashboard.js"></script>
</body>

</html>
