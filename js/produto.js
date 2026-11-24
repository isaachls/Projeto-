
const ultimoProduto = JSON.parse(localStorage.getItem("produtoEscolhido"));
const imagemProduto = document.querySelector("#imagem-produto");
const infoProduto = document.querySelector("#info-roupa");

let corEscolhida = null;
let variacaoEscolhida = null;

const cores = [];

ultimoProduto.variacoes.forEach(function(variacao) {

    const existe = cores.some(function(cor) {
        return cor.id_cor == variacao.id_cor;
    });

    if (!existe && variacao.id_cor !== null) {
        cores.push({
            id_cor: variacao.id_cor,
            nome: variacao.cor,
            imagem: variacao.imagem
        });
    }

});

function mostrarImagem() {

    imagemProduto.innerHTML = `
        <div class="imagem-produto">
            <div class="balao-roupa-carrinho">
                <img src="../${cores[0].imagem}" alt="${ultimoProduto.nome}">
            </div>
        </div>
    `;

}

function mostrarInfos() {

    const divItem = document.createElement("div");
    divItem.classList.add("infos-produto");

    let htmlCores = "";

    cores.forEach(function(cor) {

        htmlCores += `
            <div class="balao-roupa cor-opcao" data-cor="${cor.id_cor}">
                <img src="../${cor.imagem}" alt="${cor.nome}">
            </div>
        `;

    });

    divItem.innerHTML = `
        <div class="infos-marca">
            <div class="marca">
                <p>${ultimoProduto.marca}</p>
            </div>
            <p>Código: ${ultimoProduto.id_produto}</p>
        </div>

        <div class="nome-preco">
            <h2>${ultimoProduto.nome}</h2>
            <h2 id="preco-produto"></h2>
        </div>

        <div class="cor">
            <p>Cor</p>
            <div class="foto-cores">
                ${htmlCores}
            </div>
        </div>

        <p>Tamanho</p>
        <div class="TAM" id="lista-tamanhos"></div>

        <p class="guia">Guia de tamanhos</p>

        <div class="add-carrinho">
            <button class="botao-produto" id="botao-prosseguir">
                Prosseguir
            </button>
        </div>
    `;

    infoProduto.innerHTML = "";
    infoProduto.appendChild(divItem);

    const opcoesCor = divItem.querySelectorAll(".cor-opcao");
    const listaTamanhos = divItem.querySelector("#lista-tamanhos");
    const precoProduto = divItem.querySelector("#preco-produto");

    opcoesCor.forEach(function(balao) {

        balao.addEventListener("click", function() {

            opcoesCor.forEach(function(opcao) {
                opcao.classList.remove("selecionado");
            });

            balao.classList.add("selecionado");

            corEscolhida = balao.dataset.cor;
            variacaoEscolhida = null;

            const corAtual = cores.find(function(cor) {
                return cor.id_cor == corEscolhida;
            });

            imagemProduto.querySelector("img").src = "../" + corAtual.imagem;

            listaTamanhos.innerHTML = "";

            const variacoesCor = ultimoProduto.variacoes.filter(
                function(variacao) {
                    return variacao.id_cor == corEscolhida;
                }
            );

            variacoesCor.forEach(function(variacao) {

                const botao = document.createElement("div");
                botao.classList.add("balao-roupa");

                botao.innerHTML = `<button>${variacao.tamanho}</button>`;

                if (variacao.estoque <= 0) {
                    botao.classList.add("indisponivel");
                    botao.querySelector("button").disabled = true;
                }

                botao.addEventListener("click", function() {

                    listaTamanhos.querySelectorAll(".balao-roupa")
                        .forEach(function(item) {
                            item.classList.remove("selecionado");
                        });

                    botao.classList.add("selecionado");

                    variacaoEscolhida = variacao;

                    precoProduto.textContent =
                        "R$" + Number(variacao.preco)
                        .toFixed(2).replace(".", ",");

                });

                listaTamanhos.appendChild(botao);

            });

        });

    });

    const botaoProsseguir = divItem.querySelector("#botao-prosseguir");

    botaoProsseguir.addEventListener("click", function() {

        if (!usuarioLogado) {
            alert("Você precisa estar logado para adicionar itens ao carrinho!");
            window.location.href = "login.php";
            return;
        }

        if (!corEscolhida) {
            alert("Selecione uma cor!");
            return;
        }

        if (!variacaoEscolhida) {
            alert("Selecione um tamanho!");
            return;
        }

        if (variacaoEscolhida.estoque <= 0) {
            alert("Essa variação está sem estoque!");
            return;
        }

        const corAtual = cores.find(function(cor) {
            return cor.id_cor == corEscolhida;
        });

        const produtoCarrinho = {
            id_produto: ultimoProduto.id_produto,
            id_variacao: variacaoEscolhida.id_variacao,
            nome: ultimoProduto.nome,
            marca: ultimoProduto.marca,
            preco: Number(variacaoEscolhida.preco),
            imagem: "../" + corAtual.imagem,
            tamanhoSelecionado: variacaoEscolhida.tamanho,
            corSelecionada: corAtual.nome,
            id_cor_selecionada: corAtual.id_cor,
            quantidade: 1
        };

        let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

        const itemExistente = carrinho.find(function(produto) {
            return produto.id_variacao === produtoCarrinho.id_variacao;
        });

        if (itemExistente) {

            if (itemExistente.quantidade >= variacaoEscolhida.estoque) {
                alert("Você atingiu o limite de estoque dessa variação!");
                return;
            }

            itemExistente.quantidade += 1;

        } else {
            carrinho.push(produtoCarrinho);
        }

        localStorage.setItem("carrinho", JSON.stringify(carrinho));

        window.location.href = "dashboard.php";

    });

}

mostrarImagem();
mostrarInfos();
