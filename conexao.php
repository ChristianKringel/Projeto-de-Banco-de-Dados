<?php

$usuario = 'root';
$senha = '';
$database = 'database';
$host = 'localhost';

$conn = new mysqli($host, $usuario, $senha, $database);

if($conn->error) {
    die("Falha ao conectar ao banco de dados: " . $conn->error);
}
?>