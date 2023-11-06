<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';
session_start();

// Finaliza a sessão atual
session_destroy();

// Redireciona para o arquivo index.html
header('Location: https://www.resenhaprojetopi.com.br/index.html');
exit();
?>







