<?php
require_once('conexao.php');

header('Content-Type: application/json; charset=utf-8');

$id_produto = $_GET['id'] ?? null;

if (!$id_produto || !filter_var($id_produto, FILTER_VALIDATE_INT)) {
    echo json_encode(['erro' => 'Produto inválido']);
    exit();
}

$sql = "SELECT
            p.id_produto,
            p.nome_produto,
            p.marca,
            v.id_variacao,
            v.tamanho,
            v.id_cor,
            c.nome AS cor,
            v.preco,
            v.estoque,
            img.caminho_imagem AS imagem
        FROM produto p
        INNER JOIN variacao v
            ON p.id_produto = v.id_produto
        LEFT JOIN cor c
            ON v.id_cor = c.id_cor
        LEFT JOIN imagem img
            ON img.id_produto = p.id_produto
            AND img.id_cor = v.id_cor
        WHERE p.id_produto = :id_produto";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id_produto', $id_produto, PDO::PARAM_INT);
$stmt->execute();

$variacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$variacoes) {
    echo json_encode(['erro' => 'Produto não encontrado']);
    exit();
}

$produto = [
    'id_produto' => $variacoes[0]['id_produto'],
    'nome' => $variacoes[0]['nome_produto'],
    'marca' => $variacoes[0]['marca'],
    'preco' => $variacoes[0]['preco'],
    'imagem' => $variacoes[0]['imagem'],
    'variacoes' => $variacoes
];

echo json_encode($produto);