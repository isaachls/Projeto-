
const campoBusca = document.querySelector('#busca');
const listaProdutos = document.querySelector('#lista-produtos');

if (campoBusca && listaProdutos) {
    campoBusca.addEventListener('input', function() {
        const termo = campoBusca.value;

        fetch(`busca_produtos.php?busca=${encodeURIComponent(termo)}`)
            .then(resposta => resposta.text())
            .then(dados => {
                listaProdutos.innerHTML = dados;
            });
    });
}

const listaVariacoes = document.querySelector('#lista-variacoes');
const botaoAdicionar = document.querySelector('#adicionar-variacao');

if (listaVariacoes && botaoAdicionar) {
    botaoAdicionar.addEventListener('click', function() {
        const primeiraVariacao = listaVariacoes.querySelector('.variacao');
        const novaVariacao = primeiraVariacao.cloneNode(true);

        novaVariacao.querySelectorAll('input').forEach(function(campo) {
            campo.value = '';
        });

        novaVariacao.querySelectorAll('select').forEach(function(campo) {
            campo.selectedIndex = 0;
        });

        listaVariacoes.appendChild(novaVariacao);
    });

    listaVariacoes.addEventListener('click', function(event) {
        if (event.target.classList.contains('remover-variacao')) {
            const variacoes = listaVariacoes.querySelectorAll('.variacao');

            if (variacoes.length > 1) {
                event.target.closest('.variacao').remove();
            }
        }
    });
}

const listaImagens = document.querySelector('#lista-imagens');
const botaoAdicionarImagem = document.querySelector('#adicionar-imagem');

if (listaImagens && botaoAdicionarImagem) {
    botaoAdicionarImagem.addEventListener('click', function() {
        const primeiraImagem = listaImagens.querySelector('.imagem-cor');
        const novaImagem = primeiraImagem.cloneNode(true);

        novaImagem.querySelector('select').selectedIndex = 0;
        novaImagem.querySelector('input[type="file"]').value = '';

        listaImagens.appendChild(novaImagem);
    });

    listaImagens.addEventListener('click', function(event) {
        if (event.target.classList.contains('remover-imagem')) {
            const imagens = listaImagens.querySelectorAll('.imagem-cor');

            if (imagens.length > 1) {
                event.target.closest('.imagem-cor').remove();
            }
        }
    });
}
