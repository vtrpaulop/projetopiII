<?php
//Herda do banco
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';
  

  // Processamento da exclusão de veículo
  if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Deleta o veículo do banco de dados
    $query = "DELETE FROM veiculos WHERE id = '$id'";
    if ($conn->query($query) === TRUE) {
      echo "<p>Veículo excluído com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao excluir veículo: " . $conn->error . "</p>";
    }
  }
  ?>
<!DOCTYPE html>
    
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="..\css\reset.css">
    <link rel="stylesheet" href="..\css\listagem.css">
    <link rel="stylesheet" href="..\css\responsiva.css">
  <title>Listagem de veículos cadastrados</title>
</head>
<body>

  <h2>Lista de Veículos</h2>
  <?php
// Busca todos os veículos no banco de dados
$query = "SELECT * FROM veiculos";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<div class='veiculo'>";
    echo "<p><strong>Id:</strong> " . $row["id"] ."</p>";
    echo "<p><strong>Modelo:</strong> " . $row["modelo"] . "</p>";
    echo "<p><strong>Marca:</strong> " . $row["marca"] . "</p>";
    echo "<p><strong>Cor:</strong> " . $row["cor"] . "</p>";
    echo "<p><strong>Placa:</strong> " . $row["placa"] . "</p>";
    echo "<p><strong>Renavam:</strong> " . $row["renavam"] . "</p>";
    echo "<p><strong>KM:</strong> " . $row["km"] . "</p>";
    echo "<div class='acoes'>";
    echo "<a href='edicaoCarro.php?id=" . $row['id'] . "'>Editar</a>";
    echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=delete&id=" . $row["id"] . "' onclick='return confirm(\"Deseja realmente excluir o veículo?\")'>Excluir</a>";
    echo "</div>"; // Fecha a div 'acoes'
    echo "</div>"; // Fecha a div 'veiculo'
  }
} else {
  echo "<div class='sem-veiculos'>Nenhum veículo cadastrado.</div>";
}
?>

<a href="cadastroCarro.php"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
<a href="listaVencimento.php"><input id="listar"  type="submit" name="listar" value="Licenciamento" ></a>
<a href="listaManutencao.php"><input id="listar"  type="submit" name="listar" value="Manutenção" ></a>
  
</body>
</html>
