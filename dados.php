<?php
include_once("conexao.php");
session_start();
// Verificando se os campos do formulário estão definidos antes de acessá-los
if (
    isset($_POST['nome']) &&
    isset($_POST['email']) &&
    isset($_POST['usuario']) &&
    isset($_POST['cpf']) &&
    isset($_POST['telefone']) &&
    isset($_POST['senha'])
) {
    // Obtendo os valores dos campos enviados pelo JavaScript
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $usuario = addslashes($_POST['usuario']);
    $cpf = addslashes($_POST['cpf']);
    $telefone = addslashes($_POST['telefone']);
    $senha = addslashes($_POST['senha']); 

    $email_exists_query = mysqli_query($conn, "SELECT * FROM conta WHERE email = '$email'");
    if (mysqli_num_rows($email_exists_query) > 0) {
        echo "Já existe uma conta com este email.";
        exit; // Encerre o script
    }

    // Verifica se já existe uma conta com o mesmo CPF
    $cpf_exists_query = mysqli_query($conn, "SELECT * FROM conta WHERE cpf = '$cpf'");
    if (mysqli_num_rows($cpf_exists_query) > 0) {
        echo "Já existe uma conta com este CPF.";
        exit; // Encerre o script
    }

    // Verifica se já existe alguma conta com este numero de telefone
    $telefone_exists_query = mysqli_query($conn, "SELECT * FROM conta WHERE telefone = '$telefone'");
    if (mysqli_num_rows($telefone_exists_query) > 0) {
        echo "Já existe uma conta com este número de telefone.";
        exit; // Encerre o script
    }

    //Verifica se já existe alguma conta com este usuário
    /*
    $usuario_exists_query = mysqli_query($conn, "SELECT * FROM conta Where usuario = '$usuario'");
    if(mysqli_num_rows($usuario_exists_query) > 0){
        echo "Já existe uma conta com este usuário.";
        exit;
    }
    */
    // instrução preparada
    $query = mysqli_prepare($conn, "INSERT INTO conta(nome, email, endereco, cpf, telefone, senha) 
    VALUES (?, ?, ?, ?, ?, ?)");

    // Vinculando os valores às placeholders
    mysqli_stmt_bind_param($query, "ssssss", $nome, $email, $usuario, $cpf, $telefone, $senha);

    // Executando a consulta preparada
    $result = mysqli_stmt_execute($query);

    if ($result) {

        if ($result) {
            if(!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['cpf'] = $cpf; 
            // Mensagem de sucesso
            echo "Registro bem-sucedido!";
            // Redirecionamento
            header("Location: posRegistro.php");
            exit();
        } else {
            // Mensagem de erro
            echo "Erro ao registrar: " . mysqli_error($conn);
        }
    }

    // Fechando a consulta
    mysqli_stmt_close($query);
} else {
    echo "Todos os campos do formulário devem ser preenchidos.";
} 


// Feche a conexão com o banco de dados
mysqli_close($conn);
?>