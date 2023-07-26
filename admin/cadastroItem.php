<!DOCTYPE html>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="\css\reset.css">
    <link rel="stylesheet" href="\css\cadastro.css">
<html>
<head>
  <title>Cadastro de Item</title>
</head>
<body>
  <h2>Cadastro de Item</h2>
  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

  // Processamento do formulário de cadastro
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $setor = $_POST["setor"];
    $preco = $_POST["preco"];
    

    // Verifica se o item já existe no banco de dados
    $query = "SELECT * FROM itens WHERE nome = '$nome'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      echo "<p class='error'>Item já cadastrado.</p>";
    } else {
  // Insere o novo usuário no banco de dados
    $query = "INSERT INTO itens (nome, descricao, setor, preco) VALUES ('$nome', '$descricao', '$setor', '$preco')";
if ($conn->query($query) === TRUE) {
  echo "<p>Item cadastrado com sucesso.</p>";
} else {
  echo "<p class='error'>Erro ao cadastrar Item: " . $conn->error . "</p>";
}
    }
  }

  // Processamento da exclusão de items
  if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["nome"])) {
    $nome = $_GET["nome"];

    // Deleta o item do banco de dados
    $query = "DELETE FROM itens WHERE nome = '$nome'";
    if ($conn->query($query) === TRUE) {
      echo "<p>Item excluído com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao excluir Item: " . $conn->error . "</p>";
    }
  }
  ?>

  <form id="itemForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="nome">Nome:</label>
    <input type="Text" id="cad" name="nome" placeholder="Informe o nome do item" autofocus required>
    <label for="descricao">Descrição:</label>
    <input type="text" id="cad" name="descricao" placeholder="Informe a descrição do item"required>
    <label for="setor">Setor:</label>
    <input type="Text" id="cad" name="setor" placeholder="Informe o setor: Ex Bebidas"required>
    <label for="preco">Preço:</label>
    <input type="text" id="cad" name="preco" placeholder="Informe o preço" required><br><br>
    <input type="submit" value="Cadastrar"><br>

  </form>
<br>

<div id="botoes">
  <a href="lista_itens.php"><input type="submit" value="Listar Itens"></a>
  <a href="painel.html"><input id="voltar" type="submit" name="voltar" value="Voltar" ></a>
</div>
</body>
</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>