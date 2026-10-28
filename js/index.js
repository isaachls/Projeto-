
const buttons = document.querySelectorAll(".adicionar-carrinho");
const produtoEscolhido = JSON.parse(localStorage.getItem("produtoEscolhido")) || [];

buttons.forEach(function(button){button.addEventListener("click", function() {

    const produto = button.closest(".produto");
    const nome = produto.querySelector(".nomeProduto").textContent;
    const precoTexto = produto.querySelector(".precoProduto").textContent;
    const imagem = produto.querySelector(".balao-roupa img").src;
    const preco = parseFloat(precoTexto.replace("R$", "").replace(",", ".").trim());
    const produtoEscolhido = {
            nome: nome,
            preco: preco,
            imagem: imagem,
            imagensCores: [],
        };
        if (nome === "Jaqueta Y2Bros") {
            produtoEscolhido.imagensCores = [
                imagem, 
                "img/jaqueta.marrom.png" 
            ];
        }

    localStorage.setItem("produtoEscolhido", JSON.stringify(produtoEscolhido));
    console.log(produtoEscolhido);
    window.location.href = 'produto.php';
});
});
