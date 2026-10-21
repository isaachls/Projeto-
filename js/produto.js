const ultimoProduto = JSON.parse(localStorage.getItem("produtoEscolhido"));
const imagemProduto = document.querySelector("#imagem-produto");
const infoProduto = document.querySelector("#info-roupa");

let tamanhoEscolhido = "";
let corEscolhida = "";



function mostrarImagem () {

    const divItem = document.createElement("div");
    divItem.classList.add("imagem-produto");

    divItem.innerHTML = `
      <div class="balao-roupa-carrinho">
          <img src="${ultimoProduto.imagem}" alt="${ultimoProduto.nome}">
      </div>
    `;
    imagemProduto.appendChild(divItem);

}

function mostrarInfos() {

    const divItem = document.createElement("div");
    divItem.classList.add("infos-produto");

    let htmlCores = "";

    if (ultimoProduto.imagensCores && ultimoProduto.imagensCores.length > 0) {
        for (let i = 0; i < ultimoProduto.imagensCores.length; i++) {
            let fotoCor = ultimoProduto.imagensCores[i];
            htmlCores += `
                <div class="balao-roupa cor-opcao" data-imagem="${fotoCor}">
                    <img src="${fotoCor}">
                </div>
            `;
        }
    } else {
        htmlCores = `
            <div class="balao-roupa cor-opcao" data-imagem="${ultimoProduto.imagem}">
                <img src="${ultimoProduto.imagem}">
            </div>
        `;
    }

    divItem.innerHTML = `
        
    <div class="infos-marca">
                <div class="marca">
                  <img src="img/Y.png"> 
                  <p>Y2Bros</p>
                </div>
                <p>Código</p>
            </div>

            <div class="nome-preco">
                <h2>${ultimoProduto.nome}</h2>
                <h2>R$${ultimoProduto.preco.toFixed(2).replace(".", ",")}</h2>
            </div>
            
            <div class="cor">
            <p>Cor</p>
            
            <div class="foto-cores">
                ${htmlCores}
            </div>
        </div>
                <p>Tamanho</p>
            <div class="TAM">
                

                <div class="balao-roupa">
                      <button>P</button>
                </div>

                <div class="balao-roupa">
                      <button>M</button>
                </div>

                <div class="balao-roupa">
                      <button>G</button>
                </div>

                
            </div>
            <p class="guia">Guia de tamanhos</p>
                <div class="add-carrinho">
                    <button class="botao-produto" id="botao-prosseguir">Prosseguir</button>
                </div>

    `

    infoProduto.appendChild(divItem);

    const botoesTamanho = divItem.querySelectorAll(".TAM .balao-roupa");

botoesTamanho.forEach(function(botao) {
    botao.addEventListener("click", function() {

        botoesTamanho.forEach(b => b.classList.remove("selecionado"));
        
        botao.classList.add("selecionado");


        tamanhoEscolhido = botao.textContent.trim();

    });
});

    const opcoesCor = divItem.querySelectorAll(".cor-opcao");

    opcoesCor.forEach(function(balao) {
        balao.addEventListener("click", function() {
            opcoesCor.forEach(b => b.classList.remove("selecionado"));
            
            balao.classList.add("selecionado");

            corEscolhida = balao.getAttribute("data-imagem");

            const imgPrincipal = document.querySelector(".imagem-produto img");
            if (imgPrincipal) {
                imgPrincipal.src = corEscolhida;
            }

        });
    });

    const botaoProsseguir = divItem.querySelector("#botao-prosseguir");

    botaoProsseguir.addEventListener("click", function() {

        if (!tamanhoEscolhido) {
            alert("Por favor, selecione um tamanho antes de prosseguir!");
            return;
        }
        if (!corEscolhida) {
            alert("Por favor, selecione uma cor antes de prosseguir!");
            return;
        }

        ultimoProduto.tamanhoSelecionado = tamanhoEscolhido;
        ultimoProduto.corSelecionada = corEscolhida;
        ultimoProduto.quantidade = 1;

        let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

        let itemExistente = carrinho.find(function(produto) {
            return produto.nome === ultimoProduto.nome &&
                   produto.tamanhoSelecionado === ultimoProduto.tamanhoSelecionado &&
                   produto.corSelecionada === ultimoProduto.corSelecionada;
        });

        if (itemExistente) {
            itemExistente.quantidade += 1;
        } else {
            carrinho.push(ultimoProduto);
        }

        localStorage.setItem("carrinho", JSON.stringify(carrinho));


        window.location.href = "dashboard.html";
    });
    
    
}
mostrarImagem();
mostrarInfos();
