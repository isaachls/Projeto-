
const buttons = document.querySelectorAll(".adicionar-carrinho");
const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

buttons.forEach(function(button){button.addEventListener("click", function() {

    const produto = button.closest(".produto");
    const nome = produto.querySelector(".nomeProduto").textContent;
    const precoTexto = produto.querySelector(".precoProduto").textContent;
    const imagem = produto.querySelector(".balao-roupa img").src;
    const preco = parseFloat(precoTexto.replace("R$", "").replace(",", ".").trim());

    console.log(nome, preco);

    const itemExistente = carrinho.find(item => item.nome === nome);

    if (itemExistente) {
        itemExistente.quantidade += 1;
    } else {
        carrinho.push({
            nome: nome,
            preco: preco,
            imagem: imagem,
            quantidade: 1
        });
    }

    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    alert(`${nome} foi adicionado ao carrinho!`);
    console.log(carrinho)


});});

// selecionando o produto certo
