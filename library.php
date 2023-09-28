<?php
include_once("conexao.php");
include_once("protect.php");
$cpf_logado = intval($_SESSION['cpf']);

// Verificando se os campos do formulário estão definidos antes de acessá-los
if (
    isset($_POST['titulo']) &&
    isset($_POST['duracao']) &&
    isset($_POST['codigoAlbum'])
) {
    $titulo = addslashes($_POST['titulo']);
    $duracao = addslashes($_POST['duracao']);
    $codigoAlbum = addslashes($_POST['codigoAlbum']);

    // Verifique se o álbum existe no banco de dados
    $consultaAlbum = mysqli_prepare($conn, "SELECT * FROM album WHERE codigoAlbum = ?");
    mysqli_stmt_bind_param($consultaAlbum, "i", $codigoAlbum);
    mysqli_stmt_execute($consultaAlbum);
    $resultadoAlbum = mysqli_stmt_get_result($consultaAlbum);

    if (mysqli_num_rows($resultadoAlbum) == 0) {
        // O álbum não existe, exiba uma mensagem de erro
        echo "Álbum com o número $codigoAlbum não encontrado. Por favor, verifique o número do álbum.";
    } else {
        // O álbum existe, continue com a inserção da música

        // Preparar a consulta SQL para inserção da música
        $queryMusica = mysqli_prepare($conn, "INSERT INTO musica (titulo, duracao, codigoAlbum) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($queryMusica, "ssd", $titulo, $duracao, $codigoAlbum);

        // Executar a consulta para inserir a música
        if (mysqli_stmt_execute($queryMusica)) {
            // A inserção da música foi bem-sucedida
            $codigoMusica = mysqli_insert_id($conn);

            // Obtém o código da música recém-inserido
            $codigoArtista = null; // Inicialize com null para evitar problemas
            $codigoArtistaQuery = mysqli_prepare($conn, "SELECT codigoArtista FROM artista A JOIN codigoArtista CA on CA.numeroISWC = A.numeroISWC WHERE CA.cpf = ? ");
            mysqli_stmt_bind_param($codigoArtistaQuery, "s", $cpf_logado);
            mysqli_stmt_execute($codigoArtistaQuery);
            $result2 = mysqli_stmt_get_result($codigoArtistaQuery);

            if ($row2 = mysqli_fetch_assoc($result2)) {
                $codigoArtista = $row2['codigoArtista'];
            }

            // Verifique se o código do artista foi obtido com sucesso
            if ($codigoArtista !== null) {
                // Insira a relação entre o código do artista e o código da música
                $queryRelacao = mysqli_prepare($conn, "INSERT INTO possui (codigoArtista, codigoMusica) VALUES (?, ?)");
                mysqli_stmt_bind_param($queryRelacao, "ii", $codigoArtista, $codigoMusica);

                if (mysqli_stmt_execute($queryRelacao)) {
                    echo "Registro bem-sucedido!";
                } else {
                    echo "Erro ao registrar a relação: " . mysqli_error($conn);
                }
            } else {
                // Código do artista não encontrado, trate o erro aqui
                echo "Erro: Código do artista não encontrado.";
            }

            // Fechar a consulta de relação
            mysqli_stmt_close($queryRelacao);
        } else {
            // Erro na inserção da música
            echo "Erro ao registrar a música: " . mysqli_error($conn);
        }

        // Fechar a consulta da música
        mysqli_stmt_close($queryMusica);
    }

    // Fechar a consulta do álbum
    mysqli_stmt_close($consultaAlbum);
}
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="library.js"></script>
    <title>Registro de Música</title>
</head>

<body>
    <div class="main-login">
        <div class="login-esquerda">
            <h1>Registre sua música<br>e comece a fazer sucesso!</h1>
            <img src="jazz-trumpet-animate" class="login-esquerda-image" alt="animacao-login">
        </div>
        <div class="login-direita">
            <div class="card-login">
                <h1>REGISTRO DE MÚSICA</h1>
                <div class="text-fill">
                    <label for="titulo">Título de música</label>
                    <input type="text" name="titulo" placeholder="Título da música" id="titulo">
                </div>
                <div class="text-fill">
                    <label for="duracao">Duração</label>
                    <input type="duracao" name="duracao" placeholder="Duração da música" id="duracao">
                </div>
                <div class="text-fill">
                    <label for="codigoAlbum">Código do Álbum pertencente</label>
                    <input type="text" name="codigoAlbum" placeholder="Código do álbum ao qual a música pertence"
                        id="codigoAlbum">
                </div>
                <button type="submit" id="register-login" class="register-login">Registrar</button>
                <p><span class="conta">Deseja voltar para o menu?</span> <a class="loginLink" href="principal.php">Clique
                        aqui</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>