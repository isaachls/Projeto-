const estrelas = document.querySelectorAll(".nota button");
const avaliado = document.querySelector("#avaliacao")


estrelas.forEach(function (buttonClicado) {
    buttonClicado.addEventListener("click", function () {
        const idClicado = Number(buttonClicado.id);

        estrelas.forEach(function (outroBotao) {
            const idAtual = Number(outroBotao.id);

            if (idAtual <= idClicado) {
                outroBotao.classList.remove("opacidade-baixa");
            } else {
                outroBotao.classList.add("opacidade-baixa");
            }
        });

        console.log("Nota selecionada: " + idClicado);
    });
});

avaliado.addEventListener("click", function () {
    alert("Agradecemos sua avaliação!")
})
