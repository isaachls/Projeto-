### Tabela: `usuario`

| Coluna | Tipo | Obrigatório | Chave | Descrição |
| :--- | :--- | :---: | :---: | :--- |
| `id_usuario` | `INT, AUTO_INCREMENT` | Sim | PK | Número único do usuário|
| `nome` | `VARCHAR(100)` | Sim |— | Nome do usuário |
| `email` | `VARCHAR(100)` | Sim | — | Email de cadastro ou login |
| `senha_hash` | `VARCHAR(255)` | Sim | — | Senha do usuário. Salva em hash no banco |
| `tipo` | `VARCHAR(20)` | Sim | — | Tipo de acesso ao site. Padrão: Cliente |
| `data_nascimento` | `DATE` | Sim | — | Data de nascimento do usuário |



