let senha = document.querySelector("#senha");
let senhaDois = document.querySelector("#segunda-senha");
const form = document.querySelector("#form-cadastro");

form.addEventListener('submit', function (e) {
  const primeiraSenha = senha.value;
  const segundaSenha = senhaDois.value;

  if (segundaSenha !== primeiraSenha) {
    alert("As senhas não coincidem.");
    e.preventDefault();
  }
});
