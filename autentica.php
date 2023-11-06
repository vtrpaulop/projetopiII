<?php

$host = "wpmysql0004.locaweb.com.br";
$usuario_bd = "wp_1029984403";
$senha_bd = "bd57b27549";
$banco = "wp_1029984403";


$conn = new mysqli($host, $usuario_bd, $senha_bd, $banco);


if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>