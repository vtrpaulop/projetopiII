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
    <link rel="stylesheet" href="\css\login.css">
    <link rel="stylesheet" href="\css\responsiva.css">
    <title>Tela de Login:</title>
</head>
<body>
     
    <div id="header">
    <img class="logo" src="..\img\logo3.png">
    <p class="titletop"> RH Soluções - Projeto PI II</p>
  <div class="menu">   
  </div>  
  </div>

    <div id="body">
    <h1>Tela de Login</h1><br>


    <form method="POST" action="autenticado.php">
        <label for="username">Usuário:</label>
        <input class="cad" type="text" name="username" placeholder="Digite seu nome de usuário" required><br><br>

        <label for="password">Senha:</label>
        <input class="cad" type="password" name="password" placeholder="Digite sua senha" required>

         <div class="botoes">
                <input type="submit" value="Entrar">
                <a id="back" href="..\index.html">
                <button type="button" name="voltar">Voltar</button></a>
            </div></form>
            <a id="id" href="admin\esqueciSenha.html"><button type="button" name="esqueci">Esqueci minha senha</button></a>
</div>
      <div id="footer"><p id="copy">&copy; Projeto PI II  </p></div>
</body>

</html>
