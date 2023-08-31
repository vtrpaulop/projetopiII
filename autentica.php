<?php

$host = "localhost:3306";
$usuario_bd = "root";
$senha_bd = "";
$banco = "projetopi";


$conn = new mysqli($host, $usuario_bd, $senha_bd, $banco);


if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>