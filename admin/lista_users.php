<?php
//Herda do banco
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';
  

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
<!DOCTYPE html>
    
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="\css\reset.css">
    <link rel="stylesheet" href="\css\listagem.css">
  <title>Listagem de itens cadastrados</title>
</head>
<body>

  <h2>Lista de Usuários</h2>
  <table>
    <tr>
      <th>Id</th>
      <th>Usuário</th>
      <th>Ações</th>
    </tr>

    <?php
    // Busca todos os usuários no banco de dados
    $query = "SELECT * FROM users";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] ."</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>";
        echo "<a href='edicaoUser.php?id=" . $row['id'] . "'>Editar</a> | ";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=delete&username=" . $row["username"] . "' onclick='return confirm(\"Deseja realmente excluir o usuário?\")'>Excluir</a>";
        echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='3'>Nenhum usuário cadastrado.</td></tr>";
    }
    ?>
  </table>  

<a href="cadastroUser.php"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
  
</body>
</html>
