<?php
//Herda do banco
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';
  
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
    echo "<a href='vinculaCarro.php?id=" . $row['id'] . "'>Selecionar</a>";
    echo "</div>"; // Fecha a div 'acoes'
    echo "</div>"; // Fecha a div 'veiculo'
  }
} else {
  echo "<div class='sem-veiculos'>Nenhum veículo cadastrado.</div>";
}
?>
  

<a href="painelUser.php"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>

  
</body>
</html>
