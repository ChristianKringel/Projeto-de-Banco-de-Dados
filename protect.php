<?php

    if(!isset($_SESSION))
        session_start();

        if(!isset($_SESSION['cpf']))
            die("Voce não pode acessar esta página porque não está logado . <p><a href=\"main.php\">Entrar</a></p>")
?>
