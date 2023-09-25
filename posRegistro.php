<?php
include_once("conexao.php");
include_once("protect.php");
$cpf_logado = intval($_SESSION['cpf']);

// Verificando se os campos do formulário estão definidos antes de acessá-los
if (
    isset($_POST['nomeArtistico']) &&
    isset($_POST['descricao']) &&
    isset($_POST['nacionalidade']) &&
    isset($_POST['dataCriacao']) &&
    isset($_POST['dataVerificacao']) &&
    isset($_POST['codGenero']) 
) {
    // Obtendo os valores dos campos enviados pelo JavaScript
    $nomeArtistico = addslashes($_POST['nomeArtistico']);
    $descricao = addslashes($_POST['descricao']);
    $nacionalidade = addslashes($_POST['nacionalidade']);
    $dataCriacao = addslashes($_POST['dataCriacao']);
    $dataVerificacao = addslashes($_POST['dataVerificacao']);
    $codGenero = addslashes($_POST['codGenero']);

    // Verifique se os dados estão sendo recebidos
    echo "Nome Artístico: " . $nomeArtistico . "<br>";
    echo "Descrição: " . $descricao . "<br>";
    echo "Nacionalidade: " . $nacionalidade . "<br>";

   // Preparar a consulta SQL corretamente
$query = mysqli_prepare($conn, "INSERT INTO criadorConteudo (nomeArtistico, descricao, nacionalidadeArtista, cpfCriador) VALUES (?, ?, ?, ?)");
$query2 = mysqli_prepare($conn, "INSERT INTO codigoArtista (dataCriacao, dataVerificacao, cpf) VALUES (?, ?, ?)");
$query3 = mysqli_prepare($conn, "INSERT INTO artista(anoInicio, codigoGenero, numeroISWC) VALUES (?, ?, ?)");
// Verifique se a preparação da consulta foi bem-sucedida
if ($query && $query2 && $query3) {
    // Vinculando os valores às placeholders
    mysqli_stmt_bind_param($query, "sssi", $nomeArtistico, $descricao, $nacionalidade, $cpf_logado);
    mysqli_stmt_bind_param($query2, "ssi", $dataCriacao, $dataVerificacao, $cpf_logado);

    // Executar a consulta 2 para obter o número ISWC
    if (mysqli_stmt_execute($query2)) {
        // Obter o último número ISWC gerado pelo banco de dados
        $numeroISWC = mysqli_insert_id($conn);

        // Vincular o número ISWC na consulta 3 e continuar
        mysqli_stmt_bind_param($query3, "sii", $dataCriacao, $codGenero, $numeroISWC);

        // Executar a consulta 3
        if (mysqli_stmt_execute($query3)) {
            echo "Registro bem-sucedido!";
        } else {
            echo "Erro ao registrar: " . mysqli_error($conn);
        }
    } else {
        echo "Erro ao inserir na tabela codigoArtista: " . mysqli_error($conn);
    }

    // Fechar as consultas
    mysqli_stmt_close($query);
    mysqli_stmt_close($query2);
    mysqli_stmt_close($query3);
} else {
    echo "Erro na preparação da consulta: " . mysqli_error($conn);
}
}
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="posRegistro.js"></script>
    <title>Registro do Artista</title>
</head>

<body>
    <div class="main-login">
        <div class="login-esquerda">
            <h1>Registre seu artista<br>e comece a fazer sucesso!</h1>
            <img src="animacao.svg" class="login-esquerda-image" alt="animacao-login">
        </div>
        <div class="login-direita">
            <div class="card-login">
                <h1>REGISTRO</h1>
                <div class="text-fill">
                    <label for="nome">Nome Artístico</label>
                    <input type="text" name="nome" placeholder="Nome" id="nome">
                </div>
                <div class="text-fill">
                    <label for="descricao">Descrição</label>
                    <input type="descricao" name="descricao" placeholder="Digite uma breve descrição sua"
                        id="descricao">
                </div>
                <div class="text-fill">
                    <label for="nacionalidade">Nacionalidade</label>
                    <input type="text" name="nacionalidade" placeholder="Nacionalidade" id="nacionalidade">
                </div>
                <div class="text-fill">
                    <label for="dataCriacao">Data de criação da banda</label>
                    <input type="text" name="dataCriacao" placeholder="Data de criação" id="dataCriacao">
                </div>

                <dialog open id="generoMusical" >
                    <form method="dialog">
                        <p>
                            <label for="generoMusical" class="text-fill">Gênero musical:</label>
                            <select id="generoMusicalSelect" class="text-fill">
                                <option></option>
                                <option>Rock</option>
                                <option>Pop</option>
                                <option>Sertanejo</option>
                                <option>Gaucha</option>
                                <option>Eletronica</option>
                            </select>
                        </p>
                        <menu>
                            <button type="button" id="cancel-button">Cancelar</button>
                        </menu>
                    </form>
                </dialog>
                <button type="submit" id="register-login" class="register-login">Registrar</button>
                <p><span class="conta">Já tem uma conta?</span> <a class="loginLink" href="main.php">Faça login aqui</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>