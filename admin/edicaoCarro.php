<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

// Verifica se o ID do usuário foi fornecido na URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];


  // Escapa o ID para evitar ataques de SQL injection
  $escapedId = $conn->real_escape_string($id);

  // Busca as informações do usuário pelo ID
  $query = "SELECT * FROM veiculos WHERE id = $escapedId";
  $result = $conn->query($query);

  // Verifica se a consulta foi bem-sucedida
  if ($result !== false && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $modelo = $row['modelo'];
    $marca = $row['marca'];    
    $cor = $row['cor'];    
    $placa = $row['placa'];
    $renavam = $row['renavam'];
    $km = $row['km'];
  } else {
    echo "<p class='error'>Veículo não encontrado.</p>";
    exit();
  }

  // Processamento do formulário de edição
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST["modelo"];
    $marca = $_POST["marca"];    
    $cor = $_POST["cor"];    
    $placa = $_POST["placa"];
    $renavam = $_POST["renavam"];
    $km = $_POST["km"];

    // Atualiza as informações do usuário no banco de dados
    $query = "UPDATE veiculos SET modelo='$modelo', marca='$marca', cor='$cor', placa='$placa', renavam='$renavam', km='$km' WHERE id=$escapedId";
    if ($conn->query($query) === TRUE) {
      echo "<p>Informações atualizadas com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao atualizar informações: " . $conn->error . "</p>";
    }
  }

} else {
  echo "<p class='error'>ID do veículo não fornecido.</p>";
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="..\css\reset.css">
    <link rel="stylesheet" href="..\css\cadastro.css">
    <link rel="stylesheet" href="..\css\responsiva.css">
  <title>Edição de Veículo</title>
  
</head>
<body>
  <h2>Edição de Veículo</h2>
  <form id="userForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>">
    <label for="id">Id:</label>
    <input type="text" id="cad" name="id" value="<?php echo $id; ?>" readonly>
    <label for="modelo">Modelo:</label><br>
    <input type="radio" name="modelo" value="Gol"  <?php if ($modelo == "Gol") echo "checked"; ?>>Gol<br>
    <input type="radio" name="modelo" value="Strada" <?php if ($modelo == "Strada") echo "checked"; ?>>Strada<br>
    <input type="radio" name="modelo" value="Fiorino" <?php if ($modelo == "Fiorino") echo "checked"; ?>>Fiorino<br>
    <input type="radio" name="modelo" value="HB20" <?php if ($modelo == "HB20") echo "checked"; ?>>HB20<br>
    <input type="radio" name="modelo" value="Argo" <?php if ($modelo == "Argo") echo "checked"; ?>>Argo<br><br>
    <label for="marca">Marca:</label><br>
    <input type="radio" name="marca" value="Volkswagen"  <?php if ($marca == "Volkswagen") echo "checked"; ?>>Volkswagen<br>
    <input type="radio" name="marca" value="Fiat" <?php if ($marca == "Fiat") echo "checked"; ?>>Fiat<br>
    <input type="radio" name="marca" value="Chevrolet" <?php if ($marca == "Chevrolet") echo "checked"; ?>>Chevrolet<br>
    <input type="radio" name="marca" value="Ford" <?php if ($marca == "Ford") echo "checked"; ?>>Ford<br>
    <input type="radio" name="marca" value="Hyundai" <?php if ($marca == "Hyundai") echo "checked"; ?>>Hyundai<br><br>
    <label for="cor">Cor:</label><br>
    <input type="radio" name="cor" value="Preto"  <?php if ($cor == "Preto") echo "checked"; ?>>Preto<br>
    <input type="radio" name="cor" value="Branco" <?php if ($cor == "Branco") echo "checked"; ?>>Branco<br>
    <input type="radio" name="cor" value="Cinza" <?php if ($cor == "Cinza") echo "checked"; ?>>Cinza<br>
    <input type="radio" name="cor" value="Vermelho" <?php if ($cor == "Vermelho") echo "checked"; ?>>Vermelho<br>
    <input type="radio" name="cor" value="Azul" <?php if ($cor == "Azul") echo "checked"; ?>>Azul<br><br>
    <label for="placa">Placa:</label>
    <input type="text" id="cad" name="placa" value="<?php echo $placa; ?>" autofocus required>
    <label for="remavam">Renavam:</label>
    <input type="text" id="cad" name="renavam" value="<?php echo $renavam; ?>" required>
    <label for="km">KM:</label>
    <input type="text" id="cad" name="km" value="<?php echo $km; ?>" required>
    <input class="botoes" type="submit" value="Cadastrar"><br>
  </form>
  <div id="botoes">
 <a href="cadastroCarro.php"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
</div>
</body>
</html>