
# Requisitos funcionais (RF)

**RF01** O sistema deve permitir que o cliente se cadastre com nome, data de nascimento, e mail e senha. - *ALTA PRIORIDADE*

**RF02** O sistema deve permitir que o cliente adicione produtos ao carrinho. - *ALTA PRIORIDADE*

**RF03** O sistema deve permitir que o cliente altere tamanho e cor dos produtos. - *ALTA PRIORIDADE*

**RF04** O sistema deve permitir que o administrador altere o status do pedido. - *ALTA PRIORIDADE*

**RF05** O sistema deve permitir que o cliente utilize cupons.  - *MÉDIA PRIORIDADE*

**RF06** O sistema deve mostrar o histórico de pedidos do cliente.  - *MÉDIA PRIORIDADE*


# Requisitos não funcionais (RNF) 

**RF01** As senhas devem ser guardadas criptografadas com password_hash().

**RF02** O sistema deve funcionar em celulares (layout responsivo).

**RF03** O sistema deve ser feito em PHP 8 e MySQL 8.

# Regras de negócio (RN)

**RF01** Pedidos só podem ser feitos entre 8h e 18h.

**RF01** Um pedido só pode ser cancelado enquanto o status for "Recebido".

**RF01** Produto com estoque zero não aparece no catálogo.


# Histórias de usuário 

**H1** Como administrador, quero adicionar novos produtos, para atualizar meu catálogo.

    • Os produtos podem ser atualizados na tela "Cadastro de Produtos". 
    • O produto pode possuir uma ou mais variações, assim como imagens ou cor. 
    • O catálogo atualiza assim que o produto é cadastrado. 
    
**H2** Como cliente, quero ver quais produtos estão disponíveis em catálogo, para selecionar qual devo comprar.

    • Os produtos ficam exibidos na tela "Explorar" 
    • Os produtos possuem nome, foto e preço para melhor seleção. 
    
**H3** Como cliente, quero poder enviar mensagens para o vendedor, para retirar dúvidas ou realizar queixas.

    • O contato é realizado na tela "Contatos". 
    • Pode ser enviada uma avaliação ou comentário para o e-mail do vendedor. 
