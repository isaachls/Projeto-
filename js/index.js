const buttons = document.querySelectorAll(".adicionar-carrinho");

buttons.forEach(function(button) {

    button.addEventListener("click", async function() {

        const idProduto = button.dataset.id;

        try {

            const resposta = await fetch(`buscar_produto.php?id=${idProduto}`);
            const produto = await resposta.json();

            if (produto.erro) {
                alert(produto.erro);
                return;
            }

            localStorage.setItem("produtoEscolhido", JSON.stringify(produto));

            window.location.href = "produto.php";

        } catch (erro) {

            console.error("Erro ao buscar produto:", erro);
            alert("Não foi possível carregar o produto.");

        }

    });

});