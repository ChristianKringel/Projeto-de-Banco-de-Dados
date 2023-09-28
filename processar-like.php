<?php
include("conexao.php");
include("protect.php");

// Função para obter o número de "likes" de uma música
function getLikes($conn, $codigoMusica)
{
    $query = "SELECT COUNT(*) AS total_likes FROM avaliacao WHERE codigoMusica = $codigoMusica";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['total_likes'];
}

if (isset($_POST['codigoMusica'])) {
    $codigoMusica = $_POST['codigoMusica'];
    $cpf = intval($_SESSION['cpf']);

    // Verifique se o usuário já deu like nesta música
    $verificarLike = mysqli_prepare($conn, "SELECT * FROM avaliacao WHERE cpf = ? AND codigoMusica = ?");
    
    if ($verificarLike) {
        mysqli_stmt_bind_param($verificarLike, "si", $cpf, $codigoMusica);
        mysqli_stmt_execute($verificarLike);
        $resultadoVerificar = mysqli_stmt_get_result($verificarLike);

        if (mysqli_num_rows($resultadoVerificar) == 0) {
            // O usuário ainda não deu like nesta música, registre o like
            $inserirLike = mysqli_prepare($conn, "INSERT INTO avaliacao (codigoMusica, cpf) VALUES (?, ?)");
            
            if ($inserirLike) {
                mysqli_stmt_bind_param($inserirLike, "is", $codigoMusica, $cpf);
            
                if (mysqli_stmt_execute($inserirLike)) {
                    // Like inserido com sucesso
                    echo getLikes($conn, $codigoMusica); // Retorne a contagem atualizada de likes
                } else {
                    // Erro na inserção
                    echo "Erro ao inserir like: " . mysqli_error($conn);
                }

                // Feche a consulta
                mysqli_stmt_close($inserirLike);
            } else {
                // Erro na preparação da consulta de inserção
                echo "Erro na preparação da consulta de inserção: " . mysqli_error($conn);
            }
        } else {
            // O usuário já deu like nesta música
            echo "Você já deu like nesta música.";
        }

        // Feche a consulta de verificação
        mysqli_stmt_close($verificarLike);
    } else {
        // Erro na preparação da consulta de verificação
        echo "Erro na preparação da consulta de verificação: " . mysqli_error($conn);
    }
} else {
    echo "Parâmetros ausentes.";
}
?>
