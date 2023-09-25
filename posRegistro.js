document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('register-login').addEventListener('click', function (event) {
        var formData = new FormData();
        var nomeArtistico = document.getElementById('nome').value.trim();
        var descricao = document.getElementById('descricao').value.trim();
        var nacionalidade = document.getElementById('nacionalidade').value.trim();
        var dataCriacao = document.getElementById('dataCriacao').value.trim();
        var favDialog = document.getElementById("favDialog");
        var codGenero; 
        const data = new Date(); // Obtém a data atual
        const dataVerificacao = data.toISOString().slice(0, 10);

        if (nomeArtistico == '' || descricao == '' || nacionalidade == '' || dataCriacao == '' || favDialog == '') {
            alert('Todos os campos do formulário devem ser preenchidos.');
            return;
        }
        switch (generoMusicalSelect.value) {
            case 'Rock':
                codGenero = 30;
                break;
            case 'Pop':
                codGenero = 31;
                break;
            case 'Sertanejo':
                codGenero = 32;
                break;
            case 'Gaucha':
                codGenero = 33;
                break;
            case 'Eletronica':
                codGenero = 34;
                break;
            default:
                // Trate casos em que nenhum gênero foi selecionado
                alert('Selecione um gênero musical válido.');
                return;
        }
        formData.append('nomeArtistico', nomeArtistico);
        formData.append('descricao', descricao);
        formData.append('nacionalidade', nacionalidade);
        formData.append('dataCriacao', dataCriacao);
        formData.append('dataVerificacao', dataVerificacao);
        formData.append('codGenero', codGenero);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'posRegistro.php', true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log('Resposta do servidor:', xhr.responseText);
                // Aqui você pode atualizar a página ou tomar outras ações com base na resposta do servidor
                //window.location.href = "main.html";
            }
        };

        // Envie os dados para o servidor
        xhr.send(formData);
    });
    cancelButton.addEventListener('click', function () {
        generoMusicalDialog.close();
    });
});