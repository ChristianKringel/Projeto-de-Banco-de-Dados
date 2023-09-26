<?php
include_once("conexao.php");
include_once("protect.php");

$cpf_logado = intval($_SESSION['cpf']);

// Verificando se os campos do formulário estão definidos antes de acessá-los
if (
    isset($_POST['nomeAlbum']) &&
    isset($_POST['nroFaixas']) &&
    isset($_POST['dataLancamento'])
) {
    // Obtendo os valores dos campos enviados pelo JavaScript
    $nomeAlbum = addslashes($_POST['nomeAlbum']);
    $nroFaixas = addslashes($_POST['nroFaixas']);
    $dataLancamento = addslashes($_POST['dataLancamento']);

    // Preparar a consulta SQL corretamente
    $query = mysqli_prepare($conn, "INSERT INTO album (nomeAlbum, nroFaixas, dataLancamento) VALUES (?, ?, ?)");

    // Verificar se a preparação da consulta foi bem-sucedida
    if ($query) {

        // Vinculando os valores às placeholders
        mysqli_stmt_bind_param($query, "sis", $nomeAlbum, $nroFaixas, $dataLancamento);

        // Executando a consulta preparada para inserir o álbum
        if (mysqli_stmt_execute($query)) {
            $codigoAlbum = mysqli_insert_id($conn); // Obtém o ID do álbum inserido
            $resposta = "Registro bem-sucedido!";
        } else {
            $resposta = "Erro ao registrar: " . mysqli_error($conn);
        }

        // Verifique se o código do artista foi obtido com sucesso
        if ($codigoAlbum !== null) {
            $codigoArtistaQuery = mysqli_prepare($conn, "SELECT codigoArtista FROM artista A JOIN codigoArtista CA on CA.numeroISWC = A.numeroISWC WHERE CA.cpf = ?");
            mysqli_stmt_bind_param($codigoArtistaQuery, "s", $cpf_logado);
            mysqli_stmt_execute($codigoArtistaQuery);
            $result2 = mysqli_stmt_get_result($codigoArtistaQuery);

            if ($row2 = mysqli_fetch_assoc($result2)) {
                $codigoArtista = $row2['codigoArtista'];
            }

            // Insira a relação entre o código do artista e o código do álbum
            $queryRelacao = mysqli_prepare($conn, "INSERT INTO grava (codigoArtista, codigoAlbum) VALUES (?, ?)");
            mysqli_stmt_bind_param($queryRelacao, "ii", $codigoArtista, $codigoAlbum);

            if (mysqli_stmt_execute($queryRelacao)) {
                echo "Registro bem-sucedido!";
            } else {
                echo "Erro ao registrar a relação: " . mysqli_error($conn);
            }
        } else {
            // Código do álbum não encontrado, trate o erro aqui
            echo "Erro: Código do álbum não encontrado.";
        }
    } else {
        $resposta = "Erro na preparação da consulta: " . mysqli_error($conn);
    }
    header('Content-Type: text/plain');

    // Imprime a resposta
    echo $resposta;
    exit;
}
?>



<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="libraryAlbum.js"></script>
    <title>Registro de Álbum</title>
</head>

<body>
    <div class="main-login">
        <div class="login-esquerda">
            <h1>Registre seu álbum</h1>
            <img src="rock-band-animate" class="login-esquerda-image" alt="animacao-login">
        </div>
        <div class="login-direita">
            <div class="card-login">
                <h1>REGISTRO</h1>
                <div class="text-fill">
                    <label for="nomeAlbum">Nome do álbum</label>
                    <input type="text" name="nomeAlbum" placeholder="Nome do álbum" id="nomeAlbum">
                </div>
                <div class="text-fill">
                    <label for="nroFaixas">Número de faixas</label>
                    <input type="nroFaixas" name="nroFaixas" placeholder="Número de faixas do álbum" id="nroFaixas">
                </div>
                <div class="text-fill">
                    <label for="dataLancamento">Data de lançamento</label>
                    <input type="text" name="dataLancamento" placeholder="Data de lançamento do álbum"
                        id="dataLancamento">
                </div>
                <button type="submit" id="register-login" class="register-login">Registrar</button>
                <p><span class="conta">Deseja voltar para o menu?</span> <a class="loginLink"
                        href="principal.php">Clique aqui</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>