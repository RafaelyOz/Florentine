function mostrarFormulario(opcao) {
    var formCliente = document.getElementById("formCliente");
    var formAtendente = document.getElementById("formAtendente");
    var formCadastro = document.getElementById("formCadastro");

    
    formCliente.style.display = "none";
    formAtendente.style.display = "none";
    formCadastro.style.display = "none";

    if (opcao === "cliente") {
        formCliente.style.display = "block";
    } else if (opcao === "atendente") {
        formAtendente.style.display = "block";
    } else if (opcao === "cadastro") {
        formCadastro.style.display = "block";
    }
}

var perfil = document.getElementById("perfil");
perfil.addEventListener("click", function() {
    mostrarFormulario("cliente"); 
});
