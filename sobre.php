<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre</title>
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

    <main class="conteudo-sobre">
        
        <div class="conteudo-1">
            <div class="frase-sobre">
            <h1>Quem <strong>somos</strong>?</h1>
            <p>Conheça nossa história e participe dela</p>
            </div>
            <div class="balao-texto-2">
                <p>Desde 2023, buscamos a curadoria certa para você encontrar peças 
                    que realmente combinam com o <strong>seu estilo</strong>.</p>
            </div>
        </div>

        <section class="conteudo-2"> 
            <div class="balao-texto">
                <p>Somos uma loja  de roupas com essência de brechó feita para quem valoriza estilo,
                 autenticidade e peças que <strong>fazem sentido!</strong></p>
            </div>

            <div class="balao-e-sorriso">
                <div class="balao-texto-2">
                    <p>Moda, para nós, também é sobre <strong>descobrir, reinventar e 
                    dar novos caminhos</strong> às peças.</p>
                </div>
                <img src="img/Sorriso.png" alt="Adesivo de sorriso">
            </div>
            <a href="dashboard.php">Explore a remster e encontre o que combina com você.</a>
        
            
        </section>

        
    </main>

    <footer class="rodape">
            <div class="conteudo">
                <div class="coluna-1">
                    <div class="logo-rodape">
                        <h1>Br</h1> <p>Bremster</p> 
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
</body>   
    
</html>
