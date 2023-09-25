<?php
include_once("conexao.php");
//include_once("protect.php");

//$cpf_logado = intval($_SESSION['cpf']);

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

    // Verificar se os dados estão sendo recebidos
    /*echo "Codigo da música: " . $codigoAlbum . "<br>";
    echo "nomeAlbum Artístico: " . $nomeAlbum . "<br>";
    echo "Descrição: " . $nroFaixas . "<br>";
    echo "codigoAlbum: " . $codigoAlbum . "<br>"; */

    // Preparar a consulta SQL corretamente
    $query = mysqli_prepare($conn, "INSERT INTO album (nomeAlbum, nroFaixas, dataLancamento) VALUES (?, ?, ?)");

    // Verificar se a preparação da consulta foi bem-sucedida
    if ($query) {

        // Vinculando os valores às placeholders
        mysqli_stmt_bind_param($query, "sis", $nomeAlbum, $nroFaixas, $dataLancamento);

        // Executando a consulta preparada
        if (mysqli_stmt_execute($query)) {
            $resposta = "Registro bem-sucedido!";
        } else {
            $resposta = "Erro ao registrar: " . mysqli_error($conn);
        }

        // Fechar a consulta
        mysqli_stmt_close($query);
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
            <img src="animacao.svg" class="login-esquerda-image" alt="animacao-login">
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
                <p><span class="conta">Deseja voltar para o menu?</span> <a class="loginLink" href="main.html">Clique aqui</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>