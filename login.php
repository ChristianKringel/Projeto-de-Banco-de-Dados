<?php
include_once("conexao.php");
session_start(); // Inicia a sessão, se ainda não estiver iniciada

if (isset($_POST['email']) && isset($_POST['senha'])) {
    // Inclui o arquivo de conexão com o banco de dados (conexao.php)
    include_once("conexao.php");
 
    $email = $conexao->real_escape_string($_POST['email']);
    $senha = $conexao->real_escape_string($_POST['senha']);
 
    // Consulta SQL para verificar as credenciais
    $sql_code = "SELECT usuario FROM conta WHERE email = '$email' AND senha = '$senha' limit 1";
    $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);
 
    $quantidade = $sql_query->num_rows;

    if ($quantidade == 1) {
        $usuario = $sql_query->fetch_assoc();
        $_SESSION['usuario'] = $usuario['usuario'];
        header("Location: main.html"); // Redireciona após o login bem-sucedido
    } else {
        echo "Email ou senha incorretos";
    }
// $resultado = mysqli_stmt_get_result($sql_query);

/*if ($resultado) {
    if (mysqli_num_rows($consulta) > 0) {
        $response = array("sucesso" => true, "mensagem" => "Conectado com sucesso!");
    } else {
        $response = array("sucesso" => false, "mensagem" => "Credenciais inválidas");
    }
    mysqli_free_result($resultado);
} else {
    // Tratamento de erro, se necessário
    $response = array("sucesso" => false, "mensagem" => "Erro na consulta SQL: " . mysqli_error($conexao));
}*/
} 
// Feche a conexão com o banco de dados
mysqli_close($conexao);

// Configure o cabeçalho HTTP para indicar que a resposta é JSON
header('Content-Type: application/json');

// Saída da resposta como JSON
echo json_encode($quantidade);

// Saída da resposta como JSON

/* 
// Verifica se os campos de email e senha foram enviados via POST
if (isset($_POST['email']) && isset($_POST['senha'])) {
   // Inclui o arquivo de conexão com o banco de dados (conexao.php)
   include_once("conexao.php");

   $email = $conexao->real_escape_string($_POST['email']);
   $senha = $conexao->real_escape_string($_POST['senha']);

   // Consulta SQL para verificar as credenciais
   $sql_code = "SELECT * FROM conta WHERE email = '$email' AND senha = '$senha'";
   $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

   $quantidade = $sql_query->num_rows;

   if ($quantidade == 1) {
       $usuario = $sql_query->fetch_assoc();
       $_SESSION['usuario'] = $usuario['usuario'];
       header("Location: main.html"); // Redireciona após o login bem-sucedido
   } else {
       echo "Email ou senha incorretos";
   }

   // Fecha a conexão com o banco de dados
   $conexao->close();
} else {
   // Se os campos estão faltando, retorne uma resposta de erro
   echo "Campos em falta";
}


*/



/*
if (isset($_POST['usuario']) || isset($_POST['senha'])) {
    if(strlen($_POST['usuario']) == 0){
        echo "Campo usuário em branco!";
    }
    else if(strlen($_POST['senha']) == 0)
        echo "Campo senha em branco!";
    else {
        $email = $conexao->real_escape_string($_POST['email']);
        $senha = $conexao->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM conta WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conexao->query($sql_code) or die ("Falha na execução do código SQL: " . $conexao->error);

        $quantidade = $sql_query->$mysqli_num_rows;

        if($quantidade == 1){
            $usuario = $sql_query->fetch_assoc();
            if(!isset($_SESSION))
                session_start();

                $_SESSION['usuario'] = $usuario['usuario'];
                header("Location: main.html");
        }
        else
            echo "Email ou senha incorretos";
    }
    /*
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar as credenciais (sem preparação)
    $consulta = "SELECT * FROM conta WHERE usuario = '$usuario' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $consulta);

    if ($resultado) {
        if (mysqli_num_rows($resultado) > 0) {
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false]);
        }
        mysqli_free_result($resultado);
    } /* else {
        // Tratamento de erro, se necessário
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro na consulta SQL']);
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
}  else {
    <script src="./login.php"></script>
    // Se campos estão faltando, retorne uma resposta de erro
    echo json_encode(['sucesso' => false, 'mensagem' => 'Campos em falta']);
}
}
// Encerre o script PHP
exit();
?> */
?>