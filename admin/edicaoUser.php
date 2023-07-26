<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

// Verifica se o ID do usuário foi fornecido na URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];


  // Escapa o ID para evitar ataques de SQL injection
  $escapedId = $conn->real_escape_string($id);

  // Busca as informações do usuário pelo ID
  $query = "SELECT * FROM users WHERE id = $escapedId";
  $result = $conn->query($query);

  // Verifica se a consulta foi bem-sucedida
  if ($result !== false && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $password = $row['password'];
    $nome = $row['nome'];
    $sobrenome = $row['sobrenome'];
    $dnascimento = $row['dnascimento'];
    $telefone = $row['telefone'];
    $email = $row['email'];
    $sexo = $row['sexo'];
  } else {
    echo "<p class='error'>Usuário não encontrado.</p>";
    exit();
  }

  // Processamento do formulário de edição
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $dnascimento = $_POST["dnascimento"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];

    // Atualiza as informações do usuário no banco de dados
    $query = "UPDATE users SET password='$password', nome='$nome', sobrenome='$sobrenome', dnascimento='$dnascimento', telefone='$telefone', email='$email', sexo='$sexo' WHERE id=$escapedId";
    if ($conn->query($query) === TRUE) {
      echo "<p>Informações atualizadas com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao atualizar informações: " . $conn->error . "</p>";
    }
  }

} else {
  echo "<p class='error'>ID do usuário não fornecido.</p>";
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="\css\reset.css">
    <link rel="stylesheet" href="\css\cadastro.css">
  <title>Edição de Usuário</title>
  
</head>
<body>
  <h2>Edição de Usuário</h2>
  <form id="userForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>">
    <label for="id">Id:</label>
    <input type="text" id="cad" name="id" value="<?php echo $id; ?>" readonly>
    <label for="username">Usuário:</label>
    <input type="text" id="cad"name="username" value="<?php echo $username; ?>" readonly>
    <label for="password">Password:</label>
    <input type="text" id="cad"name="password" value="<?php echo $password; ?>" required>
    <label for="nome">Nome:</label>
    <input type="text" id="cad" name="nome" value="<?php echo $nome; ?>" autofocus required>
    <label for="sobrenome">Sobrenome:</label>
    <input type="text" id="cad" name="sobrenome" value="<?php echo $sobrenome; ?>" required>
    <label for="dnascimento">Idade:</label>
    <input type="date" id="cad" name="dnascimento" value="<?php echo $dnascimento; ?>" required>
    <label for="telefone">Telefone:</label>
    <input type="text" id="cad" name="telefone" value="<?php echo $telefone; ?>" required>
    <label for="email">Email:</label>
    <input type="text" id="cad" name="email" value="<?php echo $email; ?>" required>
    <label for="sexo">Escolha seu sexo:</label><br>
    <input type="radio" name="sexo" value="masculino" <?php if ($sexo == "masculino") echo "checked"; ?>>Masculino<br>
    <input type="radio" name="sexo" value="feminino" <?php if ($sexo == "feminino") echo "checked"; ?>>Feminino<br>
    <input type="radio" name="sexo" value="outro" <?php if ($sexo == "outro") echo "checked"; ?>>Outro<br><br>
    <input type="submit" value="Salvar"><br>
  </form>
  <div id="botoes">
 <a href="cadastroUser.php"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
</div>
</body>
</html>