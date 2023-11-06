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
  <table>
    <tr>
      <th>Id</th>
      <th>Modelo</th>
      <th>Marca</th>
      <th>Cor</th>
      <th>Placa</th>
      <th>Renavam</th>
      <th>KM</th>
      <th>Ações</th>

    </tr>

    <?php
    // Busca todos os veículos no banco de dados
    $query = "SELECT * FROM veiculos";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] ."</td>";
        echo "<td>" . $row["modelo"] . "</td>";
        echo "<td>" . $row["marca"] . "</td>";
        echo "<td>" . $row["cor"] . "</td>";
        echo "<td>" . $row["placa"] . "</td>";
        echo "<td>" . $row["renavam"] . "</td>";
        echo "<td>" . $row["km"] . "</td>";
        echo "<td>";
        echo "<a href='edicaoCarro.php?id=" . $row['id'] . "'>Editar</a> | ";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=delete&id=" . $row["id"] . "' onclick='return confirm(\"Deseja realmente excluir o veículo?\")'>Excluir</a>";
        echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='3'>Nenhum veículo cadastrado.</td></tr>";
    }
    ?>
  </table>  

<a href="cadastroCarro.php"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
<a href="listaVencimento.php"><input id="listar"  type="submit" name="listar" value="Licenciamento" ></a>
  
</body>
</html>
