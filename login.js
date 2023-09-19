document.addEventListener('DOMContentLoaded', function () {
    var buttonLogin = document.getElementById('button-login');

    buttonLogin.addEventListener('click', function (event) {
        event.preventDefault();
        console.log('Botão de login clicado');

        var email = document.getElementById('email').value;
        var senha = document.getElementById('senha').value;
        console.log('Botão de login clicado 2xx');

        // Verifique se há campos vazios
        if (email === '' || senha === '') {
            alert('Por favor, preencha todos os campos.');
            return;
        }
        else {
            // Faça uma solicitação AJAX para verificar as credenciais no servidor
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'login.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
            
                    try {
                        var resposta = JSON.parse(xhr.responseText);
                        console.log(resposta);
            
                        if (resposta.quantidade == 1) { // Use == em vez de === para verificar igualdade de valor
                            console.log('Conexão bem-sucedida!');
                            alert('Conexão bem-sucedida!');
                            // Redirecione para a página principal ou faça outras ações
                        } else {
                            console.log('Email ou senha incorretos. Por favor, tente novamente.');
                            alert('Email ou senha incorretos. Por favor, tente novamente.');
                        }
                    } catch (e) {
                        console.log('Resposta JSON inválida ou vazia.');
                    }
                }
            };
            // Envie os dados para o servidor
            var dados = 'email=' + encodeURIComponent(email) + '&senha=' + encodeURIComponent(senha);
            xhr.send(dados);
        }
    });

});