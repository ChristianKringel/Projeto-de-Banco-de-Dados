<?php
session_start();
include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['email'])) {
    $retorna = ['erro'=> true, 'msg' => "Erro: Necessário preencher o campo usuário!"];
} elseif (empty($dados['senha'])) {
    $retorna = ['erro'=> true, 'msg' => "Erro: Necessário preencher o campo senha!"];
} else {
    $query_usuario = "SELECT senha, email, usuario
                FROM conta
                WHERE email=:email
                LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $result_usuario->execute();

    if ($result_usuario->rowCount() == 1) {
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        $senha_armazenada = $row_usuario['senha'];

        // Verifique se a senha fornecida pelo usuário corresponde à senha armazenada no banco de dados
        if ($dados['senha'] === $senha_armazenada) {
            $_SESSION['usuario'] =  $dados['email'];

            $retorna = ['erro'=> false, 'msg' => "Login bem-sucedido!"];
        } else {
            $retorna = ['erro'=> true, 'msg' => "Erro: Usuário ou a senha inválida!"];
        }
    } else {
        $retorna = ['erro'=> true, 'msg' => "Erro: Usuário ou a senha inválida!"];
    }
}

header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON
echo json_encode($retorna);
?>
