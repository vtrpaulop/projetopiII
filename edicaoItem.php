<?php
require_once 'autentica.php';

// Verifica se o ID do usuário foi fornecido na URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];


  // Escapa o ID para evitar ataques de SQL injection
  $escapedId = $conn->real_escape_string($id);

  // Busca as informações do usuário pelo ID
  $query = "SELECT * FROM itens WHERE id = $escapedId";
  $result = $conn->query($query);

  // Verifica se a consulta foi bem-sucedida
  if ($result !== false && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome = $row['nome'];
    $descricao = $row['descricao'];
    $setor = $row['setor'];
    $preco = $row['preco'];
    
  } else {
    echo "<p class='error'>Item não encontrado.</p>";
    exit();
  }

  // Processamento do formulário de edição
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $setor = $_POST["setor"];
    $preco = $_POST["preco"];

    // Atualiza as informações do usuário no banco de dados
    $query = "UPDATE itens SET nome='$nome', descricao='$descricao', setor='$setor', preco='$preco' WHERE id=$escapedId";
    if ($conn->query($query) === TRUE) {
      echo "<p>Informações atualizadas com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao atualizar informações: " . $conn->error . "</p>";
    }
  }

} else {
  echo "<p class='error'>ID do item não fornecido.</p>";
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="\css\reset.css">
    <link rel="stylesheet" href="\css\cadastro.css">
  <title>Edição de Item</title>
  
</head>
<body>
  <h2>Edição de Item</h2>
  <form id="userForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>">
    <label for="id">Id:</label>
    <input type="text" id="cad" name="id" value="<?php echo $id; ?>" readonly>
    <label for="nome">Nome:</label>
    <input type="text" id="cad" name="nome" value="<?php echo $nome; ?>" required>
    <label for="descricao">Descrição:</label>
    <input type="text" id="cad" name="descricao" value="<?php echo $descricao; ?>" required>
    <label for="setor">Setor:</label>
    <input type="text" id="cad" name="setor" value="<?php echo $setor; ?>" required>
    <label for="preco">Preço:</label>
    <input type="text" id="cad" name="preco" value="<?php echo $preco; ?>" required>
    
    <input type="submit" value="Salvar">
  </form>
  <div id="botoes">
 <a href="cadastroItem.php"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
</div>
</body>
</html>