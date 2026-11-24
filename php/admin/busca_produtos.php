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

?>

<?php if (empty($itens)): ?>
    <tr>
        <td colspan="8" class="sem-resultados">
            Nenhum produto encontrado.
        </td>
    </tr>
<?php else: ?>


<?php foreach ($itens as $item): ?>
    <tr>
        <td>
            <?php if (!empty($item['foto'])): ?>
                <img
                    src="../../<?= htmlspecialchars($item['foto']) ?>"
                    alt="<?= htmlspecialchars($item['nome_produto']) ?>"
                    class="foto-tabela"
                >
            <?php else: ?>
                <span>Sem foto</span>
            <?php endif; ?>
        </td>

        <td><?= htmlspecialchars($item['marca'] ?? '-') ?></td>
        <td><?= htmlspecialchars($item['categoria'] ?? '-') ?></td>
        <td><?= htmlspecialchars($item['tamanho'] ?? '-') ?></td>
        <td><?= htmlspecialchars($item['cor'] ?? '-') ?></td>

        <td>
            <?= $item['preco'] !== null
                ? 'R$ ' . number_format($item['preco'], 2, ',', '.')
                : '-' ?>
        </td>

        <td><?= $item['estoque'] !== null ? (int) $item['estoque'] : 0 ?></td>

        <td>
            <a href="editar.php?id_produto=<?= (int) $item['id_produto'] ?>&id_variacao=<?= (int) $item['id_variacao'] ?>" class="btn-tabela">Editar</a>
            <a href="excluir.php?id_variacao=<?= (int) $item['id_variacao'] ?>" class="btn-tabela btn-excluir">Excluir</a>
        </td>
    </tr>
<?php endforeach; ?>
<?php endif; ?>
