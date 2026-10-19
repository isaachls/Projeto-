let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
console.log(JSON.parse(localStorage.getItem("carrinho")));
let percentualDesconto = 0;
const listaCarrinho = document.querySelector("#lista-carrinho");
const subtotalElemento = document.querySelector("#subtotal-valor");
const totalElemento = document.querySelector("#total-valor");
const cupom = document.querySelector("#cupom");

function mostrarCarrinho () {
    listaCarrinho.innerHTML = ""; 

    if (!carrinho || carrinho.length === 0) {
    listaCarrinho.innerHTML = "<p>Seu carrinho ainda está vazio...</p>";
    if (subtotalElemento) subtotalElemento.textContent = "R$0,00";
    if (totalElemento) totalElemento.textContent = "R$0,00";
    return;
  }

    let totalGeral = 0;
        
    carrinho.forEach(function(produto, index){

    const precoItem = produto.preco * produto.quantidade;
    totalGeral += precoItem;

    const divItem = document.createElement("div");
    divItem.classList.add("produto-carrinho");

    divItem.innerHTML = `
            <div class="balao-roupa-carrinho">
                <img src="${produto.corSelecionada || produto.imagem}" alt="${produto.nome}">
            </div>
            <div class="infos-pedido">
                <h2 class="nome-info">${produto.nome}</h2>
                <p class="preco-info">Tam: ${produto.tamanhoSelecionado || 'N/A'}</p>
                <p class="preco-info">Qtd: ${produto.quantidade}</p>
            </div>
            <div class="preco">
                <h2 class="preco-produto">R$${precoItem.toFixed(2).replace(".", ",")}</h2>
                <button class="btn-remover" data-index="${index}">Remover</button>
            </div>
        `;
    
    listaCarrinho.appendChild(divItem);

    });

    const valorDesconto = totalGeral * percentualDesconto;
    const totalComDesconto = totalGeral - valorDesconto;

    if (subtotalElemento) {
      subtotalElemento.textContent = `R$ ${totalGeral.toFixed(2).replace(".", ",")}`;
    }

    if (totalElemento) {
      totalElemento.textContent = `R$ ${totalComDesconto.toFixed(2).replace(".", ",")}`;
    }

  ativarBotoesRemover();
}

function ativarBotoesRemover () {
    const botoesRemover = document.querySelectorAll(".btn-remover");
    botoesRemover.forEach(function(botao) {
        botao.addEventListener("click", function () {
            const index = botao.getAttribute("data-index");

            if (carrinho[index].quantidade >1) {
                carrinho[index].quantidade -= 1
            } else {
                carrinho.splice(index, 1);
            }

            localStorage.setItem("carrinho", JSON.stringify(carrinho));

            mostrarCarrinho();
        });
    });
}

function ativarCupom(){
    const inputCupom = document.querySelector("#cupom");
    const botaoCupom = document.querySelector(".cupom button");

    if (!botaoCupom || !inputCupom) return;

    botaoCupom.addEventListener("click", function(){
        const cupomDigitado = inputCupom.value.trim().toLowerCase();

        if (cupomDigitado === "primeiracompra"){
            if (percentualDesconto > 0){
                alert("Cupom 'Primeiracompra' já está aplicado!");
                return;
            } 
            
            percentualDesconto = 0.10;
            alert("Cupom de 10% OFF aplicado com sucesso!");
            mostrarCarrinho();

         } else if (cupomDigitado === ""){
            alert("Por favor, digite um cupom.");
        } else {
            alert("Cupom inválido")
        }
    })
    

}

    mostrarCarrinho();
    ativarCupom();
