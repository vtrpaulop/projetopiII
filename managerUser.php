<?php
require_once 'autentica.php'; // Inclua o arquivo de autenticação
session_start();


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
  <!-- ... Outras informações do cabeçalho ... -->
  <title>Área do Usuário</title>
</head>
<body>
  <h2>Bem-vindo à Área do Usuário</h2>
  <!-- ... Outro conteúdo da página ... -->
  
  <!-- Formulário para registrar ponto -->
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="registrarPonto" value="Registrar Ponto">
  </form>
  <a href="painelUser.php"><button>Voltar</button></a>

  <!-- ... Outro conteúdo da página ... -->
</body>
</html>
