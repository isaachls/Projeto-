<?php
require_once('verificacao_adm.php');
require_once('../conexao.php');

$busca = $_GET['busca'] ?? '';

$sql = "SELECT
    p.id_produto,
    p.nome_produto,
    p.marca,
    c.nome_categoria AS categoria,
    v.id_variacao,
    v.tamanho,
    cor.nome AS cor,
    v.preco,
    v.estoque,
    img.caminho_imagem AS foto
FROM produto p
LEFT JOIN variacao v
    ON p.id_produto = v.id_produto
LEFT JOIN categoria c
    ON p.id_categoria = c.id_categoria
LEFT JOIN cor
    ON v.id_cor = cor.id_cor
LEFT JOIN imagem img
    ON img.id_produto = p.id_produto
    AND img.id_cor = v.id_cor
WHERE p.nome_produto LIKE :busca
ORDER BY p.id_produto DESC, v.id_variacao ASC";


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':busca', '%' . $busca . '%');
$stmt->execute();

$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql = "SELECT id_categoria, nome_categoria FROM categoria";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
</select>
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
              <button class="adm-botao" id="geral" onclick="window.location.href='index_adm.php'"><img src="">Visão geral</button>
              <button class="adm-botao" id="produtos"><img src="">Produtos</button>
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
          <h2>Produtos</h2>
          <p>Adicione, remova ou edite produtos do catálogo.</p>   
          </div>

          
      <div class="barra-acoes">
        <form method="GET" action="" class="form-busca">
            <input
                type="search"
                id="busca"
                name="busca"
                placeholder="Buscar por nome..."
                class="input-busca"
                value="<?= htmlspecialchars($busca) ?>"
            >
        </form>

        <a href="cadastro_produto.php" class="btn-novo">
            + Novo cadastro
        </a>
    </div>

        <div class="tabela-container">
          <table class="tabela-produtos">
            <thead>
              <tr>
                <th>Produto</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Tamanho</th>
                <th>Cor</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
              </tr>
            </thead>

            <tbody id="lista-produtos">
              <?php if (empty($itens)): ?>
                <tr>
                    <td colspan="8" style="text-align: center; padding: 24px;">
                        <?php if ($busca !== ''): ?>
                            Nenhum produto encontrado para essa pesquisa.
                        <?php else: ?>
                            Nenhum produto cadastrado no momento.
                        <?php endif; ?>
                    </td>
                </tr>

              <?php else: ?>
                <?php foreach ($itens as $item): ?>
                  <tr>
                    <td>
                      <?php if (!empty($item['foto'])): ?>
                        <img src="../../<?= htmlspecialchars($item['foto']) ?>" alt="<?= htmlspecialchars($item['nome_produto']) ?>" class="foto-tabela">
                      <?php else: ?>
                        <span>Sem foto</span>
                      <?php endif; ?>
                    </td>

                    <td><?= htmlspecialchars($item['marca'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($item['categoria'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($item['tamanho'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($item['cor'] ?? '-') ?></td>
                    <td>
                      <?= $item['preco'] !== null ? 'R$ ' . number_format($item['preco'], 2, ',', '.') : '-' ?>
                    </td>
                    <td><?= $item['estoque'] !== null ? (int) $item['estoque'] : 0 ?></td>
                    <td>
                      <a href="editar.php?id_produto=<?= (int) $item['id_produto'] ?>&id_variacao=<?= (int) $item['id_variacao'] ?>" class="btn-tabela">Editar</a>
                      <a href="excluir.php?id_variacao=<?= (int) $item['id_variacao'] ?>" class="btn-tabela btn-excluir" onclick="return confirm('Tem certeza que deseja excluir esta variação do produto?');">Excluir</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>

    <script src="../../js/adm.js"></script>

  </body>
</html>
