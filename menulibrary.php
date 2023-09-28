<?php
include_once("protect.php");
include_once("conexao.php"); // Certifique-se de incluir o arquivo de conexão ao banco de dados.

// Consulta SQL para selecionar todas as músicas do usuário logado.
$cpfUsuario = $_SESSION['cpf'];
$sql = "SELECT m.titulo, m.duracao FROM musica m  JOIN possui P on p.codigoMusica = m.codigoMusica
JOIN artista art on art.codigoArtista = p.codigoArtista JOIN codigoArtista CA on CA.numeroISWC = art.numeroISWC JOIN criadorConteudo on criadorConteudo.cpfCriador = CA.cpf
WHERE criadorConteudo.cpfCriador = '$cpfUsuario'";
$result = $conn->query($sql);
if ($result === false) {
    die("Erro na consulta SQL: " . $conn->error);
}

if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="style.css">
        <script src="menu.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

        <title>Biblioteca do usuário</title>
    </head>

    <body class="main cor-de-fundo" id="main">
        <h1 class="titulo-principal" id="titulo-principal">Cadastre suas criações aqui!!</h1>
        <nav class="menu-lateral">
            <div class="btn-expand">
                <i class="bi bi-list" id="btn-exp"></i>
                <!-- <header> -->
                <div>
                    <ul>
                        <li class="item-menu">
                            <a href="principal.php">
                                <span class="icon"> <i class="bi bi-house" id="home"></i></span>
                                <span class="txt-link">Home</span>
                            </a>
                        </li>
                        <li class="item-menu">
                            <a href="busca.php">
                                <span class="icon"> <i class="bi bi-search" id="search"></i></span>
                                <span class="txt-link">Search</span>
                            </a>
                        </li>
                        <li class="item-menu">
                            <a href="#">
                                <span class="icon"> <i class="bi bi-music-note-list" id="library"></i></span>
                                <span class="txt-link">Library</span>
                            </a>
                        </li>
                        <li class="item-menu">
                            <a href="profile.php">
                                <span class="icon"> <i class="bi bi-person-fill" id="prof"></i></span>
                                <span class="txt-link" id="profile">Profile</span>

                            </a>
                        </li>
                        <li class="item-menu">
                            <a href="logout.php">
                                <span class="icon"> <i class="bi bi-box-arrow-left" id="logout"></i></span>
                                <span class="txt-link">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
        <div class="cadastro-buttons">
        <a href="library.php">
            <button type="button" class="btn-cadastrar-musica">
                Cadastrar Música
            </button>
        </a>
        <a href="libraryAlbum.php">
            <button type="button" class="btn-cadastrar-album">
                Cadastrar Álbum
            </button>
        </a>
    </div>
        <main>
            <!-- Conteúdo principal da tela de navegação -->

            <h2 class="suasMusicas">Suas Músicas</h2>
            <div class="grid-container">
                <div class="grid-item">
                    <table>
                        <div class="php-content">
                            <ul>
                                <div class="alinhamento">
                                <?php
                                // Loop para exibir cada música do usuário.
                                while ($row = $result->fetch_assoc()) {
                                    echo "<li>" . $row["titulo"] . "</li>";
                                    // Você pode exibir outras informações da música aqui.
                                }
                                ?>
                                </div>
                            </ul>
                        </div>
                    </table>
        </main>
        </div>
    </body>

    </html>
    <?php
} else {
    // O usuário não possui músicas.
    echo "Você não possui músicas cadastradas.";
}
?>