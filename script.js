document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('register-login').addEventListener('click', function (event) {
        event.preventDefault();
        console.log('Botão de registro clicado.');

        // Resto do seu código...

        var formData = new FormData();
        var nome = document.getElementById('nome').value.trim();
        var email = document.getElementById('email').value.trim();
        var usuario = document.getElementById('usuario').value.trim();
        var cpf = document.getElementById('cpf').value.trim().replace(/\D/g, ''); // Remover não números
        var telefone = BigInt(document.getElementById('telefone').value.trim()); // Converter para BigInt
        var senha = document.getElementById('senha').value.trim();
        var confirmarSenha = document.getElementById('confirmar-senha').value.trim();

        // Verifique se as senhas coincidem
        if (senha !== confirmarSenha) {
            alert('As senhas não coincidem. Tente novamente.');
            return;
        }

        // Verifique se há campos vazios
        if (email === '' || nome === '' || usuario === '' || cpf === '' || telefone === '' || senha === '') {
            alert('Todos os campos do formulário devem ser preenchidos.');
            return;
        }

        // Anexe os dados do formData à solicitação AJAX
        formData.append('nome', nome);
        formData.append('email', email);
        formData.append('usuario', usuario);
        formData.append('cpf', BigInt(cpf)); // Converter a string de CPF em BigInt
        formData.append('telefone', telefone);
        formData.append('senha', senha);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'dados.php', true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log('Resposta do servidor:', xhr.responseText);
                // Aqui você pode atualizar a página ou tomar outras ações com base na resposta do servidor
            }
        };

        // Envie os dados para o servidor
        xhr.send(formData);
    });
});