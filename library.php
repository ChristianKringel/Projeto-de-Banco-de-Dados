<?php
include_once("conexao.php");
include_once("protect.php");
$cpf_logado = intval($_SESSION['cpf']);

// Verificando se os campos do formulário estão definidos antes de acessá-los
if (
    isset($_POST['titulo']) &&
    isset($_POST['duracao'])
) {
    if (isset($_POST['codigoAlbum']) && $_POST['codigoAlbum'] !== '') {
        $codigoAlbum = addslashes($_POST['codigoAlbum']);
    } else {
        $codigoAlbum = null; // Defina como nulo se não foi enviado
    }

    // Obtendo os valores dos campos enviados pelo JavaScript
    $titulo = addslashes($_POST['titulo']);
    $duracao = addslashes($_POST['duracao']);
    // $codigoAlbum = addslashes($_POST['codigoAlbum']);

    // Verifique se os dados estão sendo recebidos
    echo "titulo Artístico: " . $titulo . "<br>";
    echo "Descrição: " . $duracao . "<br>";
    echo "codigoAlbum: " . $codigoAlbum . "<br>";

    // Verifique se o álbum existe no banco de dados
    $query = mysqli_prepare($conn, "SELECT * FROM album WHERE codigoAlbum = ?");
    mysqli_stmt_bind_param($query, "i", $codigoAlbum);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);


    if (mysqli_num_rows($result) == 0) {
        // O álbum não existe, exiba um alerta
        echo "Álbum com o número $codigoAlbum não encontrado. Por favor, verifique o número do álbum.";
    } else {
        // Preparar a consulta SQL corretamente
        $query = mysqli_prepare($conn, "INSERT INTO musica ( titulo, duracao, codigoAlbum) VALUES (?, ?, ?)");
        $codArt = mysqli_prepare($conn, "SELECT codigoArtista from Artista A JOIN codigoartista CA on CA.numeroISWC = A.numeroISWC WHERE CA.cpf = 'cpf' ");
        $codigoMusica = mysqli_insert_id($conn);
        $resultado = mysqli_query($conn, $cod);
        if ($resultado) {
            $linha = mysqli_fetch_assoc($resultado);
            $codigoArtista = $linha['codigoArtista'];
        }
        $query2 = myslqi_prepare($conn, "INSERT INTO possui(codigoArtista, codigoMusica) VALUES (?, ?)");
        mysqli_stmt_bind_param($query2, "ii", $codigoArtista, $codigoMusica);
        mysqli_stmt_execute($query2);
        
        // Verifique se a preparação da consulta foi bem-sucedida
        if ($query) {
            // Vinculando os valores às placeholders
            mysqli_stmt_bind_param($query, "sdi", $titulo, $duracao, $codigoAlbum);

            // Executando a consulta preparada
            if (mysqli_stmt_execute($query)) {
                echo "Registro bem-sucedido!";
            } else {
                echo "Erro ao registrar: " . mysqli_error($conn);
            }


            // Fechar a consulta    
            mysqli_stmt_close($query);
        } else {
            echo "Erro na preparação da consulta: " . mysqli_error($conn);
        }
    }
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
            <h1>Registre sua<br>e comece a fazer sucesso!</h1>
            <img src="animacao.svg" class="login-esquerda-image" alt="animacao-login">
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
                <p><span class="conta">Deseja voltar para o menu?</span> <a class="loginLink" href="main.html">Clique aqui</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>