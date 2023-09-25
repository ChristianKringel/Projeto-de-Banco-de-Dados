<?php
include("conexao.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca</title>
</head>

<body>
    <h1>Lista de músicas</h1>
    <form action="">
        <input name="busca" placeholder="Digite os termos de pesquisa" type="busca" type="text">
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table width="600px" border="1">
        <tr>
            <th>Titulo</th>
            <th>Artista</th>
            <th>Duração</th>
            <th>Álbum</th>
        </tr>
        <?php
        if (!isset($_GET['busca'])) {
            ?>
            <tr>
                <td colspan="4">Digite algo para pesquisar ...</td>
            </tr>
        <?php } else {
            $pesquisa = $conn->real_escape_string($_GET['busca']);
            /* $sql_code = "SELECT 
                    CC.nomeArtistico AS NomeCriadorConteudo,
                    M.titulo AS TituloMusica,
                    A.nomeAlbum AS NomeAlbum,
                    M.duracao AS DuracaoMusica
                FROM musica AS M
                JOIN possui AS P ON M.codigoMusica = P.codigoMusica
                JOIN codigoArtista AS CA ON P.codigoArtista = CA.numeroISWC
                JOIN criadorConteudo AS CC ON CA.cpf = CC.cpfCriador
                LEFT JOIN album AS A ON M.codigoAlbum = A.codigoAlbum
                WHERE M.titulo LIKE '%$pesquisa%' or CC.nomeArtistico LIKE '%$pesquisa%'"; */
            $sql_code = "SELECT
    M.titulo AS Título,
    M.duracao AS Duração,
    A.nomeAlbum AS Álbum,
    CC.nomeArtistico AS Artista
    FROM musica AS M
    LEFT JOIN album AS A ON M.codigoAlbum = A.codigoAlbum
    JOIN possui AS P ON M.codigoMusica = P.codigoMusica
    JOIN codigoArtista AS CA ON P.codigoArtista = CA.NumeroISWC
    JOIN criadorConteudo AS CC ON CA.cpf = CC.cpfCriador
    WHERE M.titulo like '%$pesquisa%' or cc.nomeArtistico LIKE '%$pesquisa%' or a.nomeAlbum like '%$pesquisa%'";

            $sql_query = $conn->query($sql_code) or die("Erro ao vonsultar! " . $conn->error);
            if ($sql_query->num_rows == 0) {
                ?>
                <td colspan="4">Nenhum resultado encontrado ...</td>
                <?php
            } else {
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
                    </tr>
                    <?php
                }
            }
            ?>
            <?php
        } ?>
    </table>
</body>

</html>