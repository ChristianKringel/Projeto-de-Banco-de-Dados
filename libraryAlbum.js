document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('register-login').addEventListener('click', function (event) {
        // Limpar o valor anterior armazenado no LocalStorage (ou outro armazenamento) ao adicionar um novo álbum
        localStorage.removeItem("nroFaixas");

        // Definir o novo valor para o número de faixas
        
        var formData = new FormData();
        var dataLancamento = document.getElementById('dataLancamento').value.trim();
        var nroFaixas = document.getElementById('nroFaixas').value.trim();
        var nomeAlbum = document.getElementById('nomeAlbum').value.trim();
        localStorage.setItem("nroFaixas", nroFaixas);

        if (nomeAlbum == '' || nroFaixas == '') {
            alert('Todos os campos do formulário devem ser preenchidos.');
            return;
        }

        formData.append('nomeAlbum', nomeAlbum);
        formData.append('nroFaixas', nroFaixas);
        formData.append('dataLancamento', dataLancamento);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'libraryAlbum.php', true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                var resposta = xhr.responseText;
                console.log('Resposta do servidor:', xhr.responseText);
                alert('Resposta do servidor: ' + resposta);
                window.location.href = "library.php";
            }
        };

        // Envia os dados para o servidor
        xhr.send(formData);
    });
});