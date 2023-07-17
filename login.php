<?php
//Herda do banco
require_once 'autentica.php';

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

        // Aqui você pode fazer o redirecionamento usando a função header()
        header("Location: painel.html");
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
    <link rel="stylesheet" href="\css\reset.css">
    <link rel="stylesheet" href="\css\login.css">
    <title>Tela de Login:</title>
</head>
<body>
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
                <a id="under" href="index.html"><button type="button" name="voltar">Voltar</button></a>
            </div></form>

      <div id="footer"><p id="copy">&copy; vtR Project's </p></div>
</body>
</html>

<?php

$conn->close();
?>