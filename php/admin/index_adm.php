<?php
require_once('verificacao_adm.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../../css/style_adm.css">
</head>
<body class="body_adm">
    <nav class="sidebar">
        <div class="logo">Br</div>
        <div class="botoes">
            <button class="adm-botao" id="geral"><img src="">Visão geral</button>
            <button class="adm-botao" id="produtos" onclick="window.location.href='produto_adm.php'"><img src="">Produtos</button>
            <button class="adm-botao" id="categorias"><img src="">Categorias</button>
            <button class="adm-botao" id="cores_tam"><img src="">Cores e tamanhos</button>
            <button class="adm-botao" id="pedidos"><img src="">Pedidos</button>
            <button class="adm-botao" id="cupons"><img src="">Cupons</button>
            <button class="adm-botao" id="usuarios"><img src="">Usuários</button>
            <button class="adm-botao" id="relatorios"><img src=""> Relatórios</button>
        </div>

        <div class="conf-sair">
        <button class="adm-botao" id="config">Configurações</button>
        <button class="sair">Sair</button>
        </div>
    </nav>
    
    <div class="direita">
    <section class="adm_superior">

        <div class="vis-adm">
            <p>Visão geral</p>
            <p class="balao-adm">Administrador</p>
        </div>

    </section>

    <main class="adm_main">
        <div class="msg-adm">
        <h2>Olá, administrador!</h2>
        <p>Acompanhe o desempenho da Bremster.</p>   
        </div>

        <div class="containers">
            <div class="container">
                <div class="texto-container">
                <h1>6</h1>
                <p>Produtos cadastrados</p>   
                </div>

                <div>
                    <img src="">
                </div>
            </div>

            <div class="container">
                <div class="texto-container">
                <h1>5</h1>
                <p>Pedidos realizados</p>   
                </div>

                <div>
                    <img src="">
                </div>
            </div>

            <div class="container">
                <div class="texto-container">
                <h1>9</h1>
                <p>Vendas efetuadas</p>   
                </div>

                <div>
                    <img src="">
                </div>
            </div>
        </div>

        <div class="containers-2-3">

        <div class="container2">
            <h2>Pedidos recentes</h2>
            <div class="ped-cli">
                <div class="ped">
                    <p>Pedido</p>
                    <p>Pedido</p>
                    <p>Pedido</p>
                </div>
                <div class="cli">
                    <p>Cliente</p>
                    <p>Cliente</p>
                    <p>Cliente</p>
                </div>
            </div>
        </div>

        <div class="container2">
            <h2>Estoque baixo</h2>
            <div class="estoque">
                <p>Produto A</p>
                <p>Produto B</p>
                <p>Produto C</p>
            </div>
        </div>

        </div>
        
    </main>

    </div>
    
</body>
</html>
