<?php
include_once("conexao.php");

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

    // Verifique se já existe um registro com o mesmo CPF
    $cpf_exists_query = mysqli_query($conn, "SELECT * FROM conta WHERE cpf = '$cpf'");
    if (mysqli_num_rows($cpf_exists_query) > 0) {
        echo "Já existe uma conta com este CPF.";
        exit; // Encerre o script
    }

    // Verifique se já existe um registro com o mesmo telefone
    $telefone_exists_query = mysqli_query($conn, "SELECT * FROM conta WHERE telefone = '$telefone'");
    if (mysqli_num_rows($telefone_exists_query) > 0) {
        echo "Já existe uma conta com este número de telefone.";
        exit; // Encerre o script
    }

    $usuario_exists_query = mysqli_query($conn, "SELECT * FROM conta Where usuario = '$usuario'");
    if(mysqli_num_rows($usuario_exists_query) > 0){
        echo "Já existe uma conta com este usuário.";
        exit;
    }

    // instrução preparada
    $query = mysqli_prepare($conn, "INSERT INTO conta(nome, email, usuario, cpf, telefone, senha) 
    VALUES (?, ?, ?, ?, ?, ?)");

    // Vinculando os valores às placeholders
    mysqli_stmt_bind_param($query, "ssssss", $nome, $email, $usuario, $cpf, $telefone, $senha);

    // Executando a consulta preparada
    $result = mysqli_stmt_execute($query);

    if ($result) {
        echo "Registro bem-sucedido!";
    } else {
        echo "Erro ao registrar: " . mysqli_error($conn);
    }

    // Fechando a consulta
    mysqli_stmt_close($query);
} else {
    echo "Todos os campos do formulário devem ser preenchidos.";
} 

// Feche a conexão com o banco de dados
mysqli_close($conn);
?>