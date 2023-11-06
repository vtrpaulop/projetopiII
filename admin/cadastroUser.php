<!DOCTYPE html>
    
<html>
<head>
  <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="..\..\css\reset.css">
    <link rel="stylesheet" href="..\css\cadastro.css">
    <link rel="stylesheet" href="..\css\responsiva.css">
  <title>Cadastro de Usuário</title>
</head>
<body>
  <h2>Cadastro de Usuário</h2>
  <?php
//Herda do banco
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

  // Processamento do formulário de cadastro
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $dnascimento = $_POST["dnascimento"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];

    // Verifica se o usuário já existe no banco de dados
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      echo "<p class='error'>Usuário já cadastrado.</p>";
    } else {
// Insere o novo usuário no banco de dados
$query = "INSERT INTO users (username, password, nome, sobrenome, dnascimento, telefone, email, sexo) VALUES ('$username', '$password', '$nome', '$sobrenome', '$dnascimento', '$telefone', '$email', '$sexo')";
if ($conn->query($query) === TRUE) {
  echo "<p>Usuário cadastrado com sucesso.</p>";
} else {
  echo "<p class='error'>Erro ao cadastrar usuário: " . $conn->error . "</p>";
}
    }
  }

  // Processamento da exclusão de usuários
  if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["username"])) {
    $username = $_GET["username"];

    // Deleta o usuário do banco de dados
    $query = "DELETE FROM users WHERE username = '$username'";
    if ($conn->query($query) === TRUE) {
      echo "<p>Usuário excluído com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao excluir usuário: " . $conn->error . "</p>";
    }
  }
  ?>

  <form id="userForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="username" >Usuário:</label>
    <input type="text" id="cad" name="username" placeholder="Informe um usuário para login" autofocus required>
    <label for="password">Senha:</label>
    <input type="password" id="cad" name="password" placeholder="Digite uma senha"required>
    <label for="nome">Nome:</label>
    <input type="text" id="cad" name="nome" placeholder="Informe seu nome"required>
    <label for="sobrenome">Sobrenome:</label>
    <input type="text" id="cad" name="sobrenome" placeholder="Informe seu sobrenome"required>
    <label for="dnascimento">Idade:</label>
    <input type="date" id="cad" name="dnascimento"  required>
    <label for="telefone">Telefone:</label>
    <input type="text" id="cad" name="telefone" placeholder="(XX) X XXXX-XXXX"required>
    <label for="email">Email:</label>
    <input type="text" id="cad" name="email" placeholder="contato@contato.com.br"required>
    <label for="sexo">Escolha seu sexo:</label><br>
    <input type="radio" name="sexo" value="masculino" checked>Masculino<br>
   <input type="radio" name="sexo" value="feminino">Feminino<br>
     <input type="radio" name="sexo" value="outro">Outro<br><br>
    <input class="botoes" type="submit" value="Cadastrar"><br>
  </form>

  <br>
  <div id="botoes">
<a href="lista_users.php"><input class="botoes" type="submit" value="Listar Usuários"></a>
<a href="painel.html"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
  </div>
</body>
</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>