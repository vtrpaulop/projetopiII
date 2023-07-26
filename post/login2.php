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
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="autenticado.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" name="username" required><br>

        <label for="password">Senha:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
