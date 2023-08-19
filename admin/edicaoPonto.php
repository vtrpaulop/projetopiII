<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

// Verifica se o ID do ponto foi fornecido na URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Escapa o ID para evitar ataques de SQL injection
  $escapedId = $conn->real_escape_string($id);

  // Busca as informações do ponto pelo ID, incluindo o nome e o sobrenome do usuário
  $query = "SELECT p.id, p.user_id, u.nome, u.sobrenome, p.timestamp FROM pontos p INNER JOIN users u ON p.user_id = u.id WHERE p.id = $escapedId";
  $result = $conn->query($query);

  // Verifica se a consulta foi bem-sucedida
  if ($result !== false && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
    $nomeCompleto = $row['nome'] . ' ' . $row['sobrenome'];
    $timestamp = $row['timestamp'];
  } else {
    echo "<p class='error'>Ponto não encontrado.</p>";
    exit();
  }

  // Processamento do formulário de edição
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $nomeCompleto = $_POST["nomeCompleto"];
    $timestamp = $_POST["timestamp"];

    // Atualiza as informações do ponto no banco de dados
    $query = "UPDATE pontos SET user_id='$user_id', timestamp='$timestamp' WHERE id=$escapedId";
    if ($conn->query($query) === TRUE) {
      echo "<p>Informações atualizadas com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao atualizar informações: " . $conn->error . "</p>";
    }
  }
} else {
  echo "<p class='error'>ID do ponto não fornecido.</p>";
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="\css\reset.css">
  <link rel="stylesheet" href="\css\cadastro.css">
  <title>Edição de Ponto</title>
</head>
<body>
  <h2>Edição de Ponto</h2>
  <form id="pointForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>">
    <label for="id">Id:</label>
    <input type="text" id="cad" name="id" value="<?php echo $id; ?>" readonly>
    <label for="user_id">ID do Usuário:</label>
    <input type="text" id="cad" name="user_id" value="<?php echo $user_id; ?>" readonly>
    <label for="nomeCompleto">Nome do Usuário:</label>
    <input type="text" id="cad" name="nomeCompleto" value="<?php echo $nomeCompleto; ?>" readonly>
    <label for="timestamp">Registro:</label>
    <input type="text" id="cad" name="timestamp" value="<?php echo $timestamp; ?>" required>
    
    <input type="submit" value="Salvar">
  </form>
  <div id="botoes">
    <a href="listaregistroponto.php"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
  </div>
</body>
</html>
