<?php 
    include("conexao.php");
    include("protect.php");
    session_start(); 
    // include("dados.php");
?> 

 <?php
        if(isset($_SESSION['id']) and (isset($_SESSION['nome']))){
            echo "Bem vindo " . $_SESSION['nome'] . "<br>";
            echo "<a href='sair.php'>Sair</a><br>";
        }else{
            echo "<div id='dados-usuario'>";
            echo "<button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#loginModal'>Acessar</button>";
            echo "</div>";
        }

        ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>
    <div class="main-login">
        <div class="login-esquerda">
            <h1>Faça login<br>E venha ouvir muita música!</h1>
            <img src="animacao.svg" class="login-esquerda-image" alt="animacao-login">
        </div>
        <div class="login-direita">
            <div class="card-login">
            <form id="login-usuario-form">
            <span id="msgAlertErroLogin"></span>
                <h1>LOGIN</h1>
                <div class="text-fill">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Email" id="email">
                </div>
                <div class="text-fill">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha" id="senha">
                </div>
                <button type="submit" class="button-login" id="button-login">Login</button>
                <p><span class="conta">Ainda não tem uma conta?</span> <a class="registro"
                        href="Registro.html">Registre-se aqui</a></p>
            </div>
            </form>
        </div>
    </div>
    <script src="teste.js"></script>
</body>

</html>
