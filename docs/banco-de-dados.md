### Tabela: `usuario`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_usuario` | `INT, AUTO_INCREMENT` | Sim | PK | Número único do usuário|
| `nome` | `VARCHAR(100)` | Sim |— | Nome do usuário |
| `email` | `VARCHAR(100)` | Sim | — | Email de cadastro ou login |
| `senha_hash` | `VARCHAR(255)` | Sim | — | Senha do usuário. Salva em hash no banco |
| `tipo` | `VARCHAR(20)` | Sim | — | Tipo de acesso ao site. Padrão: Cliente |
| `data_nascimento` | `DATE` | Sim | — | Data de nascimento do usuário |


### Tabela: `categoria`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_categoria` | `INT(11), AUTO_INCREMENT` | Sim | PK | Identificador único da categoria |
| `nome_categoria` | `VARCHAR(100)` | Sim | — | Nome da categoria do produto |


### Tabela: `cor`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_cor` | `INT(11), AUTO_INCREMENT` | Sim | PK | Identificador único da cor |
| `nome` | `VARCHAR(50)` | Sim | — | Nome da cor |


### Tabela: `cupom`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_cupom` | `INT(11), AUTO_INCREMENT` | Sim | PK | Identificador único do cupom |
| `codigo` | `VARCHAR(50)` | Sim | — | Código promocional do cupom |
| `tipo_desconto` | `TINYINT(4)` | Sim | — | Tipo do desconto aplicado (ex: percentual ou fixo) |
| `valor_desconto` | `DECIMAL(10,2)` | Sim | — | Valor ou percentual de desconto |
| `data_validade` | `DATE` | Sim | — | Data limite de validade do cupom |
| `status` | `TINYINT(4)` | Sim | — | Status do cupom (ex: ativo ou inativo) |


### Tabela: `produto`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_produto` | `INT(11), AUTO_INCREMENT` | Sim | PK | Identificador único do produto |
| `nome_produto` | `VARCHAR(100)` | Sim | — | Nome do produto |
| `descricao` | `VARCHAR(100)` | Sim | — | Descrição curta do produto |
| `id_categoria` | `INT(11)` | Sim | FK → `categoria.id_categoria` | Categoria do produto |
| `marca` | `VARCHAR(100)` | Sim | — | Marca do produto |

### Tabela: `variacao`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_variacao` | `INT(11), AUTO_INCREMENT` | Sim | PK | Identificador único da variação do produto |
| `tamanho` | `VARCHAR(10)` | Sim | — | Tamanho da peça (ex: P, M, G) |
| `id_cor` | `INT(11)` | Não | FK → `cor.id_cor` | Cor associada à variação |
| `id_produto` | `INT(11)` | Sim | FK → `produto.id_produto` | Produto base da variação |
| `preco` | `DECIMAL(10,2)` | Sim | — | Preço da variação em reais |
| `estoque` | `INT(11)` | Sim | — | Quantidade disponível em estoque |


### Tabela: `imagem`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_imagem` | `INT(11), AUTO_INCREMENT` | Sim | PK | Identificador único da imagem |
| `id_produto` | `INT(11)` | Sim | FK → `produto.id_produto` | Produto exibido na imagem |
| `caminho_imagem` | `VARCHAR(255)` | Sim | — | Caminho ou URL do arquivo de imagem |
| `id_cor` | `INT(11)` | Sim | FK → `cor.id_cor` | Cor do produto mostrada na imagem |

---

### Tabela: `pedido`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_pedido` | `INT(11), AUTO_INCREMENT` | Sim | PK | Número único do pedido |
| `data_pedido` | `DATETIME` | Sim | — | Data e hora em que o pedido foi realizado |
| `status_pedido` | `TINYINT(4)` | Sim | — | Situação atual do pedido. Padrão: `0` |
| `id_usuario` | `INT(11)` | Sim | FK → `usuario.id_usuario` | Usuário que realizou o pedido |
| `id_cupom` | `INT(11)` | Não | FK → `cupom.id_cupom` | Cupom de desconto aplicado no pedido |
| `valor_total` | `DECIMAL(10,2)` | Sim | — | Valor total do pedido em reais |


### Tabela: `itens_pedido`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_itens` | `INT(11), AUTO_INCREMENT` | Sim | PK | Identificador único do item no pedido |
| `id_pedido` | `INT(11)` | Sim | FK → `pedido.id_pedido` | Pedido ao qual o item pertence |
| `id_variacao` | `INT(11)` | Sim | FK → `variacao.id_variacao` | Variação específica do produto comprado |
| `quantidade` | `INT(11)` | Sim | — | Quantidade comprada deste item |
| `preco_unitario` | `DECIMAL(10,2)` | Sim | — | Preço unitário no momento da compra |


### Tabela: `pagamento`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_pagamento` | `INT(11), AUTO_INCREMENT` | Sim | PK | Identificador único do pagamento |
| `id_pedido` | `INT(11)` | Sim | FK → `pedido.id_pedido` | Pedido referente ao pagamento |
| `metodo_pagamento` | `VARCHAR(50)` | Sim | — | Forma de pagamento escolhida (ex: PIX, Cartão) |
| `status_pagamento` | `TINYINT(4)` | Sim | — | Situação do pagamento (ex: pendente, aprovado) |
| `data_pagamento` | `DATETIME` | Não | — | Data e hora da confirmação do pagamento |




