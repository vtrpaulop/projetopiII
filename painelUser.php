<?php
session_start();

require_once 'autentica.php'; // HERDA BANCO

// Verifica se o formulário de registro de ponto foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrarPonto'])) {
  // Obter o ID do usuário da sessão
  if (isset($_SESSION['user_id'])) {
    $user_Id = $_SESSION['user_id'];

    // Inserir o registro de ponto no banco de dados
    $query = "INSERT INTO pontos (user_id, timestamp) VALUES ('$user_Id', NOW())";
    if ($conn->query($query) === TRUE) {
      echo "<p>Ponto registrado com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao registrar ponto: " . $conn->error . "</p>";
    }
  } else {
    echo "<p class='error'>Usuário não identificado.</p>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css\reset.css">
        <link rel="stylesheet" href="css\painel.css">
        <link rel="stylesheet" href="css\responsiva.css">
        <title>Página Protegida</title>
</head>
<body>
  <div id="header">
               <img class="logo" src="img\logo3.png">
                <div class="botao-log">
                    <form action="logout.php" method="post">
                     <input type="submit" value="Logout" onclick="mostrarMensagem()">

                     <script>
                     function mostrarMensagem() {
                     alert('Logout realizado com sucesso!');
                     return false;
                      }
                     </script>
                    </form>
                </div>
            </div>
            <h2>Bem-vindo!</h2><br>
        <p>Esta é uma página protegida.</p>
        </div><br>

        <script>
                     function ponto() {
                     alert('Ponto registrado com sucesso!');
                     return false;
                      }
                     </script>

   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="registrarPonto" value="Registrar Ponto" onclick="ponto()">
   <button> <a href="espelhoponto.php">Gerar espelho ponto</button></a>
  </form><br>


 <div id="footer"><p id="copy">&copy; vtR Project's </p></div>
</body>
</html>
