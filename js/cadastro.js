let senha = document.querySelector("#senha")
let senhaDois = document.querySelector("#segunda-senha")
const botao = document.querySelector("#cadastro")


botao.addEventListener('click', function() {
  const primeiraSenha = senha.value;
  const segundaSenha = senhaDois.value;
  
  if (segundaSenha === primeiraSenha){
    console.log("Senhas iguais")
  } else {
    alert("As senhas não coincidem.")
    return
  }

});
