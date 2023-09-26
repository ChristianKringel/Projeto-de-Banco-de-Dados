document.addEventListener('DOMContentLoaded', function () {
// Encontre todos os botões de like na página
var likeButtons = document.querySelectorAll('.like-button');

likeButtons.forEach(function(likeButton) {
    likeButton.addEventListener('click', function() {
        // Obtenha o código da música a partir do atributo data
        var codigoMusica = this.getAttribute('data-codigo-musica');

        // Envie uma solicitação AJAX para o servidor
        fetch('processar-like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'codigoMusica=' + codigoMusica + '&cpfUsuario=' + cpfUsuario, // Certifique-se de passar o cpfUsuario
        })
        .then(response => response.text())
        .then(data => {
            // Atualize a contagem de likes na interface do usuário
            var likesCountSpan = this.nextElementSibling;
            likesCountSpan.textContent = data;
        })
        .catch(error => {
            console.error('Erro ao processar o like:', error);
        });
    });
});
})