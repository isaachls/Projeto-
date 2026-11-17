CREATE TABLE `CATEGORIA` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(100) NOT NULL
);

CREATE TABLE `CLIENTE` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL DEFAULT '2000-01-01'
);


CREATE TABLE `CUPOM` (
  `Primeiracompra` varchar(14) DEFAULT NULL
);

CREATE TABLE `PEDIDO` (
  `id_pedido` int(11) NOT NULL,
  `data_pedido` datetime NOT NULL,
  `status_pedido` tinyint(4) NOT NULL DEFAULT '0',
  `id_cliente` int(11) NOT NULL,
  `id_variacao` int(11) NOT NULL
);

CREATE TABLE `PRODUTO` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL
);

CREATE TABLE `VARIACAO` (
  `id_variacao` int(11) NOT NULL,
  `tamanho` varchar(10) NOT NULL,
  `cor` varchar(30) NOT NULL,
  `id_produto` int(11) NOT NULL
);
