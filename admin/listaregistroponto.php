 <?php
//Herda do banco
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';


// Processamento da exclusão de items
  if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["ponto_id"])) {
    $ponto_id = $_GET["ponto_id"];

    // Deleta o item do banco de dados
    $query = "DELETE FROM pontos WHERE id = '$ponto_id'";
    if ($conn->query($query) === TRUE) {
      echo "<p>Ponto excluído com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao excluir ponto: " . $conn->error . "</p>";
    }
  }
  ?>

<!DOCTYPE html>
    
<html>
<head>
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="\css\reset.css">
    <link rel="stylesheet" href="..\css\ponto.css">
    <link rel="stylesheet" href="..\css\responsiva.css">
  <title>Listagem de pontos registrados</title>
</head>
<body>

  <div class="container">
  <h2>Listagem de pontos registrados</h2>
  <div class="table-container">
    <?php
    // Busca todos os pontos no banco de dados
    $query = "SELECT p.id AS ponto_id, u.id AS user_id, u.nome AS nome_usuario, u.sobrenome AS sobrenome_usuario, p.timestamp FROM pontos p INNER JOIN users u ON p.user_id = u.id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='row'>";
        echo "<div class='cell'>" . "Id do log <br>" . $row["ponto_id"] . "</div>";
        echo "<div class='cell'>" . "Id do Usuário  <br>" . $row["user_id"] . "</div>";
        echo "<div class='cell'>" . "Nome do Usuário <br>" . $row["nome_usuario"]. " " . $row["sobrenome_usuario"] . "</div>";
        echo "<div class='cell'>" . "Registro <br>" . date('d/m/Y H:i:s', strtotime($row["timestamp"])) . "</div>";
        echo "<div class='cell'>";
        echo "<a href='edicaoPonto.php?id=" . $row['ponto_id'] . "'>Editar</a> | ";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=delete&ponto_id=" . $row["ponto_id"] . "' onclick='return confirm(\"Deseja realmente excluir o ponto?\")'>Excluir</a>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "<div class='row'><div class='cell' colspan='4'>Nenhum ponto registrado.</div></div>";
    }
    ?>
  </div><br>
  <a href="../admin/painel.html"><input id="voltar" type="submit" name="voltar" value="Voltar"></a>
</div>

 
</body>
</html>
  