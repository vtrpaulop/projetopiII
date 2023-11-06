<?php
//Herda do banco
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

// Verificando se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os valores enviados pelo formulário
    $username = strtoupper($_POST["username"]);
    $password = strtoupper($_POST["password"]);


    // Convertendo o nome de usuário e senha para letras maiúsculas
    $username = strtoupper($username);
    $password = strtoupper($password);


    //Consulta SQL para verificar se o usuário e a senha estão corretos
    $sql = "SELECT * FROM users WHERE UPPER(username) = '$username' AND password = '$password'";
    
    $resultado = $conn->query($sql);


   // Verificando se a consulta retornou algum resultado
if ($resultado->num_rows == 1) {
    // Login bem-sucedido
    echo "Login realizado com sucesso!";

    // Redirecionamento usando JavaScript
    echo "<script>window.location.href = 'painel.html';</script>";
} else {
    // Login inválido
    echo "Usuário ou senha incorretos.";
}
}
?>

<!DOCTYPE html>
<html>
<head>
     <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="..\css\reset.css">    
    <link rel="stylesheet" href="..\css\login.css">
    <link rel="stylesheet" href="..\css\index.css">
    <link rel="stylesheet" href="..\css\responsiva.css">
    
    <title>Tela de Login:</title>
</head>
<body>
    <img class="logo" src="..\img\logo3.png">
    <div id="header"><p class="titletop">  </p></div>
  

    <div id="body">
    <h1>Tela de Login</h1><br>


    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Usuário:</label>
        <input class="cad" type="text" name="username" placeholder="Digite seu nome de usuário" required><br><br>

        <label for="password">Senha:</label>
        <input class="cad" type="password" name="password" placeholder="Digite sua senha" required>

         <div class="botoes">
                <input type="submit" value="Entrar">
                <a id="back" href="../../index.html"><button type="button" name="voltar">Voltar</button></a>
            </div></form>
            <a id="id" href="..\esqueciSenha.html"><button type="button" name="esqueci">Esqueci minha senha</button></a>
</div>
      <div id="footer"><p id="copy">&copy; Projeto PI II  </p></div>
</body>

</html>

<?php

$conn->close();
?>