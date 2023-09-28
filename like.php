<?php
include_once("conexao.php");
include_once("protect.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $likesCount = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT count(*) as likes from avaliacoes WHERE codigoMusica = $codigoMusica and status = 'like'"
        )
    )['likes'];
    $dislikesCount = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT count(*) as likes from avaliacoes WHERE codigoMusica = $codigoMusica and status = 'dislike'"
        )
    )['dislikes'];
    
   // $status = mysqli_query($conn, "SELECT s") Ele seleciona o status, se está como like ou não

    ?>
    
</body>

</html>