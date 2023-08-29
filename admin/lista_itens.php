 <?php
//Herda do banco
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';


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

<!DOCTYPE html>
    
<html>
<head>
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="\css\reset.css">
    <link rel="stylesheet" href="\css\listagem.css">
       <link rel="stylesheet" href="..\css\responsiva.css">
  <title>Listagem de itens cadastrados</title>
</head>
<body>


<h2>Lista de itens cadastrados</h2>
  <table>
    <tr>
      <th>Id</th>
      <th>Item</th>
      <th>Ações</th>
    </tr>

    <?php
    // Busca todos os itens no banco de dados
    $query = "SELECT * FROM itens";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] ."</td>";
        echo "<td>" . $row["nome"] . "</td>" ;
        echo "<td>";
        echo "<a href='edicaoItem.php?id=" . $row['id'] . "'> Editar</a> | ";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=delete&nome=" . $row["nome"] . "' onclick='return confirm(\"Deseja realmente excluir o item?\")'>Excluir</a>";
        echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='3'>Nenhum item cadastrado.</td></tr>";
    }
    ?>
  </table>

<a href="cadastroItem.php"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
  
</body>
</html>

  