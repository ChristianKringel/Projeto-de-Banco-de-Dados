document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('register-login').addEventListener('click', function (event) {

        var nroFaixas = localStorage.getItem("nroFaixas");
        var formData = new FormData();
        var titulo = document.getElementById('titulo').value.trim();
        var duracao = document.getElementById('duracao').value.trim();
        var codigoAlbum = document.getElementById('codigoAlbum').value.trim();

        if (duracao === '' || titulo === '') {
            alert('Todos os campos do formulário devem ser preenchidos.');
            return;
        }

        // Não é necessário verificar se o campo é vazio aqui

        formData.append('titulo', titulo);
        formData.append('duracao', duracao);
        formData.append('codigoAlbum', codigoAlbum);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'library.php', true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log('Resposta do servidor:', xhr.responseText);
                // Aqui você pode atualizar a página ou tomar outras ações com base na resposta do servidor
                window.location.href = "library.php";
            }
        };

        // Envie os dados para o servidor
        xhr.send(formData);
    });
});
