<?php
include("conexao.php");
include("protect.php");

// Função para obter o número de "likes" de uma música
function getLikes($conn, $codigoMusica)
{
    $query = "SELECT COUNT(*) AS total_likes FROM likes WHERE codigoMusica = $codigoMusica";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['total_likes'];
}

if (isset($_GET['like'])) {
    // Verificar se o usuário já deu "like" para esta música antes
    $codigoMusica = $_GET['like'];
    $cpf_logado = $_SESSION['cpf'];

    $checkQuery = "SELECT * FROM likes WHERE codigoMusica = $codigoMusica AND cpfUsuario = '$cpf_logado'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows == 0) {
        // O usuário ainda não deu "like" nesta música, então podemos adicionar um "like"
        $insertQuery = "INSERT INTO likes (codigoMusica, cpfUsuario) VALUES ($codigoMusica, '$cpf_logado')";
        $conn->query($insertQuery);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
    <script src="busca.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Busca</title>
</head>

<body>
    <div class="busca">
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
        <div class="content-container">
            <h1 class="titulo-principal">Lista de músicas</h1>
            <form action="" class="box-busca">
                <input name="busca" placeholder="Digite os termos de pesquisa" type="text">
                <button type="submit">Pesquisar</button>
            </form>
            <br>
            <div class="music-list">
                <table class="listaMusica" width="600px" border="1">
                    <tr class="titulos">
                        <th>Titulo</th>
                        <th>Artista</th>
                        <th>Duração</th>
                        <th>Álbum</th>
                        <th>Like</th>
                    </tr>
                    <?php
                    $sql_query = null; // Inicialize $sql_query como nulo
                    
                    if (isset($_GET['busca'])) {
                        $pesquisa = $conn->real_escape_string($_GET['busca']);
                        $sql_code = "SELECT
            M.codigoMusica AS CodigoMusica,
            M.titulo AS Título,
            M.duracao AS Duração,
            A.nomeAlbum AS Álbum,
            CC.nomeArtistico AS Artista,
            COUNT(L.codigoMusica) AS QuantidadeLikes  -- Conta o número de likes para cada música
            FROM musica AS M
            LEFT JOIN album AS A ON M.codigoAlbum = A.codigoAlbum
            JOIN possui AS P ON M.codigoMusica = P.codigoMusica
            JOIN codigoArtista AS CA ON P.codigoArtista = CA.NumeroISWC
            JOIN criadorConteudo AS CC ON CA.cpf = CC.cpfCriador
            LEFT JOIN avaliacao AS L ON M.codigoMusica = L.codigoMusica  -- Junta a tabela de likes
            WHERE M.titulo LIKE '%$pesquisa%' OR cc.nomeArtistico LIKE '%$pesquisa%' OR a.nomeAlbum LIKE '%$pesquisa%' 
            GROUP BY M.codigoMusica, M.titulo, M.duracao, A.nomeAlbum, CC.nomeArtistico"; // Agrupa por música para contar os likes
                    

                        $sql_query = $conn->query($sql_code) or die("Erro ao consultar! " . $conn->error);
                    }

                    if ($sql_query && $sql_query->num_rows > 0) {
                        while ($dados = $sql_query->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $dados['Título']; ?>
                                </td>
                                <td>
                                    <?php echo $dados['Artista']; ?>
                                </td>
                                <td>
                                    <?php echo $dados['Duração']; ?>
                                </td>
                                <td>
                                    <?php echo $dados['Álbum']; ?>
                                </td>
                                <td>
                                    <!-- Botão de "Like" -->
                                    <a class="like-button" href="#"
                                        data-codigo-musica="<?php echo $dados['CodigoMusica']; ?>">Like</a>

                                    <!-- Quantidade de likes -->
                                    <span class="like-count">
                                        <?php echo $dados['QuantidadeLikes']; ?>
                                    </span>
                                </td>

                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">Nenhum resultado encontrado ...</td>
                        </tr>
                        <?php
                    }
                    ?>
                    <script>
                        var cpfUsuario = <?php echo json_encode($_SESSION['cpf']); ?>;
                    </script>

                </table>
            </div>
        </div>
    </div>
</body>

</html>