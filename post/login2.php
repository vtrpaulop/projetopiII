<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';
session_start();

if (isset($_SESSION['login_error'])) {
    echo '<p style="color: red;">' . $_SESSION['login_error'] . '</p>';
    unset($_SESSION['login_error']); // Remove a mensagem de erro da sessão após exibição
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="\css\reset.css">    
    <link rel="stylesheet" href="\css\index.css">
    <link rel="stylesheet" href="\css\login2.css">
    <link rel="stylesheet" href="\css\responsiva.css">
    <title>Login</title>
</head>
<body>
    <div id="header">
    <img class="logo" src="..\img\logo3.png">
    <p class="titletop"> ESTE É O CABEÇALHO </p>
    <div id="login">
    <h1>Login</h1><br>
    <form action="autenticado.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" name="username" required><br><br>

        <label for="password">Senha:   </label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Entrar">
        <button type="button" name="voltar"><a href="novidades.php">Voltar</button></a>
        
    </form>
</div>
    
    <div id="footer"><p id="copy">&copy; Projeto PI II  </p></div>
</body>
</html>
