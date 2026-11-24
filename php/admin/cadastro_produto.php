<?php
require_once('verificacao_adm.php');
require_once('../conexao.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $pdo->beginTransaction();

        $nome = trim($_POST['nome_produto']);
        $marca = trim($_POST['marca']);
        $descricao = trim($_POST['descricao']);
        $categoria = $_POST['id_categoria'];

        $sql = "INSERT INTO produto
                (nome_produto, marca, id_categoria, descricao)
                VALUES (:nome, :marca, :categoria, :descricao)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':marca' => $marca,
            ':categoria' => $categoria,
            ':descricao' => $descricao
        ]);

        $idProduto = $pdo->lastInsertId();

        $sqlVariacao = "INSERT INTO variacao
                        (tamanho, id_cor, id_produto, preco, estoque)
                        VALUES (:tamanho, :cor, :produto, :preco, :estoque)";

        $stmtVariacao = $pdo->prepare($sqlVariacao);

        foreach ($_POST['tamanho'] as $i => $tamanho) {
            $stmtVariacao->execute([
                ':tamanho' => $tamanho,
                ':cor' => $_POST['id_cor'][$i],
                ':produto' => $idProduto,
                ':preco' => $_POST['preco'][$i],
                ':estoque' => $_POST['estoque'][$i]
            ]);
        }

        $sqlImagem = "INSERT INTO imagem
                      (id_cor, id_produto, caminho_imagem)
                      VALUES (:cor, :produto, :caminho)";

        $stmtImagem = $pdo->prepare($sqlImagem);

        foreach ($_POST['imagem_id_cor'] as $i => $cor) {

            if (
                !isset($_FILES['imagem_cor']['error'][$i]) ||
                $_FILES['imagem_cor']['error'][$i] !== UPLOAD_ERR_OK
            ) {
                throw new Exception("Erro no envio de uma imagem.");
            }

            $arquivo = $_FILES['imagem_cor']['name'][$i];
            $temporario = $_FILES['imagem_cor']['tmp_name'][$i];

            $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
            $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($extensao, $extensoesPermitidas)) {
                throw new Exception("Formato de imagem inválido.");
            }

            $nomeArquivo = uniqid('produto_', true) . '.' . $extensao;
            $destino = __DIR__ . '/../../img/' . $nomeArquivo;

            if (!move_uploaded_file($temporario, $destino)) {
                throw new Exception("Não foi possível salvar a imagem.");
            }

            $caminho = 'img/' . $nomeArquivo;

            $stmtImagem->execute([
                ':cor' => $cor,
                ':produto' => $idProduto,
                ':caminho' => $caminho
            ]);
        }

        $pdo->commit();

        echo "<script>alert('Produto cadastrado com sucesso!');</script>";

    } catch (Exception $erro) {

        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        echo "<script>alert(" .
            json_encode('Erro ao cadastrar: ' . $erro->getMessage()) .
            ");</script>";
    }
}


$sql = "SELECT id_categoria, nome_categoria FROM categoria";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT id_cor, nome FROM cor";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$cores = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <button class="adm-botao" id="geral" onclick="window.location.href='index_adm.php'">Visão geral</button>
            <button class="adm-botao" id="produtos" onclick="window.location.href='produto_adm.php'">Produtos</button>
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
        <h2>Cadastro de produtos</h2>
        <p>Adicione produtos ao estoque.</p>   
        </div>

        <form method="POST" enctype="multipart/form-data" class="form-cadastro-produto">

            <h3>Informações do produto</h3>
            
            <div class="info-prod">
            <div class="lado">
            <label for="nome_produto">Nome do produto</label>
            <input type="text" id="nome_produto" name="nome_produto" required>

            <label for="marca">Marca</label>
            <input type="text" id="marca" name="marca" required>
            </div>

            <div class="lado">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <label for="id_categoria">Categoria</label>
            <select name="id_categoria" id="id_categoria" required>
                <option value="">Selecione uma categoria</option>

                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id_categoria'] ?>">
                        <?= htmlspecialchars($categoria['nome_categoria']) ?>
                    </option>
                <?php endforeach; ?>

            </select>
             </div>
            </div>
            
            <hr>

            <h3>Imagens por cor</h3>

            <div id="lista-imagens">
                <div class="imagem-cor info-prod">
                    <div class="lado">
                    <label>Cor</label>
                    <select name="imagem_id_cor[]" required>
                        <option value="">Selecione uma cor</option>

                        <?php foreach ($cores as $cor): ?>
                            <option value="<?= $cor['id_cor'] ?>">
                                <?= htmlspecialchars($cor['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select></div>
                    <div class="lado">
                    <label>Imagem</label>
                    <input type="file" name="imagem_cor[]" accept="image/*" required>
                    
                    <button type="button" class="remover-imagem">
                        Remover imagem
                    </button>
                </div>
            </div>

            </div>

            <button type="button" id="adicionar-imagem">
                + Adicionar imagem de outra cor
            </button>

            <hr>

            <h3>Variações do produto</h3>

            <div id="lista-variacoes">
                
                    <div class="variacao">
                        <div class="info-prod">
                            <div class="lado">
                                <label>Tamanho</label>
                                <input type="text" name="tamanho[]" required>

                                <label>Cor</label>
                                <select name="id_cor[]" required>
                                    <option value="">Selecione uma cor</option>

                                    <?php foreach ($cores as $cor): ?>
                                        <option value="<?= $cor['id_cor'] ?>">
                                            <?= htmlspecialchars($cor['nome']) ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="lado">
                            <label>Preço</label>
                            <input type="number" name="preco[]" step="0.01" min="0" required>

                            <label>Estoque</label>
                            <input type="number" name="estoque[]" min="0" required>

                            <button type="button" class="remover-variacao">
                                Remover variação
                            </button></div>

                     </div>
                </div>
            </div>

            <button type="button" id="adicionar-variacao">
                + Adicionar variação
            </button>

            <button type="submit" class="cad-prod">
                Cadastrar produto
            </button>

        </form>

        
    </main>

    </div>
    
    <script src="../../js/adm.js"></script>
</body>
</html>
