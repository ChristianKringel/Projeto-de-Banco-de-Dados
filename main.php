<?php
    include("conexao.php");

    if(isset($_POST['email']) || isset($_POST['senha'])){
        if(strlen($_POST['email']) == 0)
            echo "O email não pode estar vazio \n";
        if(strlen($_POST['senha']) == 0)
            echo "A senha não pode estar vazia";
        else{
            $email = $conn->real_escape_string($_POST['email']);
            $senha = $conn->real_escape_string($_POST['senha']);
    
            $sql_code = "SELECT * FROM conta WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);
    
            $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['cpf'] = $usuario['cpf'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: main.html");
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    
        }
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
            <form action="" method="POST">
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
</body>

</html>
