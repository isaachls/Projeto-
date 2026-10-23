

CREATE TABLE `CATEGORIA` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(100) NOT NULL
);


INSERT INTO `CATEGORIA` (`id_categoria`, `nome_categoria`) VALUES
(12, 'Alfaiataria'),
(13, 'Peças de frio'),
(32, 'Retro'),
(123, 'Casual'),
(321, 'Retro');

CREATE TABLE `CLIENTE` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL DEFAULT '2000-01-01'
);


INSERT INTO `CLIENTE` (`id_cliente`, `nome`, `email`, `senha`, `endereco`, `data_nascimento`) VALUES
(1, 'carlinhos', 'carlinhos@gmail.com', '123', 'Número 13 Rua legal, Ibura ', '2000-01-01'),
(2, 'lurdinha', 'carlinhos@gmail.com', '123', 'Número 14 Rua legal, Ibura ', '1982-01-01'),
(3, 'ana', 'ana@gmail.com', '1234', 'Número 15 Rua ruim, Ibura ', '2007-05-14'),
(4, 'sonia', 'sonia@gmail.com', '12345', 'Número 16 Rua legal, Ibura ', '2000-01-01'),
(5, 'isaac', 'isaac@gmail.com', '123456', 'Número 17 Rua legal, Ibura ', '2008-06-07');


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


INSERT INTO `PRODUTO` (`id_produto`, `nome_produto`, `preco`, `descricao`, `id_categoria`) VALUES
(1, 'Camisa Branca', 69.90, 'Tecido leve com botoes para trabalho.', 12),
(2, 'Blusa de Crepe', 49.90, 'Gola laco charmosa que nao amassa.', 12),
(3, 'Blazer Slim', 99.90, 'Terceira peca barata em tecido maleavel.', 12),
(4, 'Calca Reta', 89.90, 'Modelo classico duravel com otimo caimento.', 12),
(5, 'Calca Pantalona', 79.90, 'Modelagem larga, fluida e confortavel.', 12),
(6, 'Saia Lapis', 59.90, 'Tecido macio que imita camurca elegante.', 12),
(7, 'Colete Alongado', 69.90, 'Sobreposicao que alonga e afina a silhueta.', 12),
(8, 'Vestido Tubinho', 49.90, 'Modelo basico justo para usar sob casacos.', 12),
(9, 'Macacao Pantacourt', 79.90, 'Peca unica pratica em malha crepe.', 12),
(10, 'Sapatilha Fina', 59.90, 'Conforto com bico fino para o escritorio.', 12),
(11, 'Sueter de Trico', 69.90, 'Blusa quente para usar pura ou sobre camisas.', 13),
(12, 'Casaco Sobretudo', 149.90, 'Modelo longo que protege do vento com elegancia.', 13),
(13, 'Segunda Pele', 39.90, 'Blusa termica justa para reter o calor.', 13),
(14, 'Cachecol Pashmina', 29.90, 'Lenco macio para proteger o pescoco com estilo.', 13),
(15, 'Bota Cano Curto', 119.90, 'Calcado resistente que mantem os pes aquecidos.', 13),
(16, 'Camiseta Basica', 39.90, 'Algodao confortavel para o dia a dia.', 123),
(17, 'Shorts Jeans', 59.90, 'Modelo despojado com barra desfiada.', 123),
(18, 'Tenis Branco', 89.90, 'Calcado curinga para looks descontraidos.', 123),
(19, 'Jaqueta Jeans', 119.90, 'Casaco versatil para sobreposicao casual.', 123),
(20, 'Vestido de Malha', 59.90, 'Peca unica fresca e soltinha no corpo.', 123),
(21, 'Calca Mom Jeans', 99.90, 'Cintura alta e corte vintage anos 90.', 32),
(22, 'Vestido Poá', 89.90, 'Estampa de bolinhas com caimento rodado.', 32),
(23, 'Oculos Gatinho', 29.90, 'Acessorio classico com armacao retro marcante.', 32),
(24, 'Camisa Vintage', 69.90, 'Estampa retro de botoes e gola polo.', 32),
(25, 'Sapato Oxford', 109.90, 'Calcado estruturado com amarracao tradicional.', 32);


CREATE TABLE `VARIACAO` (
  `id_variacao` int(11) NOT NULL,
  `tamanho` varchar(10) NOT NULL,
  `cor` varchar(30) NOT NULL,
  `id_produto` int(11) NOT NULL
);

ALTER TABLE `CATEGORIA`
  ADD PRIMARY KEY (`id_categoria`);


ALTER TABLE `CLIENTE`
  ADD PRIMARY KEY (`id_cliente`);

ALTER TABLE `PEDIDO`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_variacao` (`id_variacao`);

ALTER TABLE `PRODUTO`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id_categoria` (`id_categoria`);

ALTER TABLE `VARIACAO`
  ADD PRIMARY KEY (`id_variacao`),
  ADD KEY `id_produto` (`id_produto`);


ALTER TABLE `CATEGORIA`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

ALTER TABLE `CLIENTE`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `PEDIDO`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `PRODUTO`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;


ALTER TABLE `VARIACAO`
  MODIFY `id_variacao` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `PEDIDO`
  ADD CONSTRAINT `PEDIDO_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `CLIENTE` (`id_cliente`),
  ADD CONSTRAINT `PEDIDO_ibfk_2` FOREIGN KEY (`id_variacao`) REFERENCES `VARIACAO` (`id_variacao`);


ALTER TABLE `PRODUTO`
  ADD CONSTRAINT `PRODUTO_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `CATEGORIA` (`id_categoria`);


ALTER TABLE `VARIACAO`
  ADD CONSTRAINT `VARIACAO_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `PRODUTO` (`id_produto`);
COMMIT;
