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


<script>
// Função para lidar com o clique no botão "Like"
$(document).on("click", "a.like-button", function (e) {
    e.preventDefault(); // Impede o comportamento padrão do link

    // Obtém o código da música a partir do atributo data
    var codigoMusica = $(this).data("codigo-musica");

    // Faça uma solicitação AJAX para adicionar um "like"
    $.ajax({
        url: "seu_script_php.php?like=" + codigoMusica, // Substitua pelo URL do seu script PHP
        method: "GET",
        success: function (response) {
            // Atualize a exibição de "likes" na página
            // Você pode atualizar a contagem de "likes" ou mostrar uma mensagem de sucesso aqui
            console.log("Like adicionado com sucesso!");
        },
        error: function (xhr, status, error) {
            // Lida com erros de solicitação, se houver algum
            console.error("Erro ao adicionar like: " + error);
        }
    });
});
</script>