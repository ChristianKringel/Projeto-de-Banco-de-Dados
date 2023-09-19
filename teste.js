const loginForm = document.getElementById("login-usuario-form");
const msgAlertErroLogin = document.getElementById("msgAlertErroLogin");
var email = document.getElementById('email').value;
var senha = document.getElementById('senha').value;
//const msgAlertErroLogin = document.getElementById("msgAlertErroLogin");
var buttonLogin = document.getElementById('button-login');

buttonLogin.addEventListener('click', async (e) => {
    e.preventDefault();
    console.log('Botão de login clicado');
    if (document.getElementById("email").value === "") {
        msgAlertErroLogin.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo usuário!</div>";
    } else if (document.getElementById("senha").value === "") {
        msgAlertErroLogin.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>";
    } else {
        const dadosForm = new FormData(loginForm);

        const dados = await fetch("teste.php", {
            method: "POST",
            body: dadosForm
        });

        const resposta = await dados.json();

        if (resposta['erro']) {
            msgAlertErroLogin.innerHTML = resposta['msg'];
        } else {
            document.getElementById("dados-usuario").innerHTML = "Bem-vindo " + resposta['dados'].nome + "<br><a href='sair.php'>Sair</a><br>";
            msgAlertErroLogin.innerHTML = ""; // Limpa qualquer mensagem de erro anterior
            loginForm.reset();
            loginModal.hide();
        }
    }
});