const campoBusca = document.querySelector('#busca');
const listaProdutos = document.querySelector('#lista-produtos');

campoBusca.addEventListener('input', function() {
    const termo = campoBusca.value;

    fetch(`busca_produtos.php?busca=${encodeURIComponent(termo)}`)
        .then(resposta => resposta.text())
        .then(dados => {
            listaProdutos.innerHTML = dados;
        });
});
