<?php

$usuario = 'root';
$senha = '';
$database = 'testefinal';
$host = 'localhost';

$conn = new mysqli($host, $usuario, $senha, $database);

if($conn->error) {
    die("Falha ao conectar ao banco de dados: " . $conn->error);
}
?>