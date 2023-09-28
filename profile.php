<?php
session_start();
include_once("conexao.php");
include("protect.php");

if (!isset($_SESSION['cpf'])) {
    die("Você não pode acessar esta página porque não está logado. <p><a href=\"index.html\">Entrar</a></p>");
}

$cpf_logado = $_SESSION['cpf'];
//$sql = "SELECT nome, email, endereco FROM conta where cpf = ?";
$sql = "SELECT c.nome, c.email, c.telefone, c.endereco FROM conta c WHERE cpf = ? ";
// SELECT c.nome, c.email, U.nickname, c.endereco FROM conta C JOIN usuarioComum U on U.cpfComum = c.cpf WHERE C.cpf = ;

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $cpf_logado);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $userData = $result->fetch_assoc();
} else {
    echo "Nenhum resultado encontrado para o CPF do usuário logado.";
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <title>PERFIL</title>
</head>

<body class="main cor-de-fundo" id="main">
    <h1 class="titulo-principal" id="titulo-principal">Bem-vindo ao seu Perfil!</h1>
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
                            <span class="icon"> <i class="bi bi-person-fill" id="profile"></i></span>
                            <span class="txt-link">Profile</span>
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

    <nav class="profile-settings">
        <div class="user-data">
            <h1>Perfil do Usuário</h1>
            <p>Nome: <?php echo $userData['nome']; ?></p>
            <p>Email: <?php echo $userData['email']; ?></p>
            <p>Usuário: <?php echo $userData['telefone']; ?></p>
            <p>Endereço: <?php echo $userData['endereco']; ?></p>
        </div>
    </nav>

    <div class="favorites">
        <h2>Músicas Favoritas</h2>
        <?php
        // Consulta para obter todas as músicas que o usuário deu like
        $query = "SELECT M.titulo AS Título, A.nomeAlbum AS Álbum, CC.nomeArtistico AS Artista
                  FROM avaliacao AS L
                  JOIN musica AS M ON L.codigoMusica = M.codigoMusica
                  JOIN album AS A ON M.codigoAlbum = A.codigoAlbum
                  JOIN possui AS P ON M.codigoMusica = P.codigoMusica
                  JOIN codigoArtista AS CA ON P.codigoArtista = CA.NumeroISWC
                  JOIN criadorConteudo AS CC ON CA.cpf = CC.cpfCriador
                  WHERE L.cpf = '$cpf_logado'";

        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            // Exibir a lista de músicas favoritas
            ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li>
                        <?php echo $row['Título'] . ' - ' . $row['Artista'] . ' (' . $row['Álbum'] . ')'; ?>
                    </li>
                <?php } ?>
            </ul>
            <?php
        } else {
            echo "<div class='no-favorites'>Você ainda não deu like em nenhuma música.</div>";
        }
        ?>
    </div>
</body>
</html