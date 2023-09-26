<?php
include_once("protect.php");
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

    <title>Tela de Navegação</title>
</head>

<body class="main cor-de-fundo" id="main">
    <h1 class="titulo-principal" id="titulo-principal">Bem-vindo ao nosso aplicativo de streaming de música!</h1>
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
                        <a href="menulibrary.php">
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
    </nav>
    <div class="imagem-principal">
        <img src="animacaoPrincipal.svg" class="principalImagen" alt="principalImagen">
    </div>
    <!-- </header> -->
    <main>
        <!-- Conteúdo principal da tela de navegação -->
    </main>
    </div>
</body>

</html>