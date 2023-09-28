<?php
include("conexao.php");
include("protect.php");

if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];

    // Consulta para obter todas as músicas que o usuário deu like
    $query = "SELECT M.titulo AS Título, A.nomeAlbum AS Álbum, CC.nomeArtistico AS Artista
              FROM avaliacao AS L
              JOIN musica AS M ON L.codigoMusica = M.codigoMusica
              JOIN album AS A ON M.codigoAlbum = A.codigoAlbum
              JOIN possui AS P ON M.codigoMusica = P.codigoMusica
              JOIN codigoArtista AS CA ON P.codigoArtista = CA.NumeroISWC
              JOIN criadorConteudo AS CC ON CA.cpf = CC.cpfCriador
              WHERE L.cpf = '$cpf'";

    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Exibir a lista de músicas favoritas
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Minhas Músicas Favoritas</title>
        </head>
        <body>
            <h1>Minhas Músicas Favoritas</h1>
            <ul>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li>
                        <?php echo $row['Título'] . ' - ' . $row['Artista'] . ' (' . $row['Álbum'] . ')'; ?>
                    </li>
                <?php } ?>
            </ul>
        </body>
        </html>
        <?php
    } else {
        echo "Você ainda não deu like em nenhuma música.";
    }
} else {
    echo "Você não está logado.";
}
?>