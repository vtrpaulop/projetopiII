<!DOCTYPE html>
    
<html>
<head>
  <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="..\..\css\reset.css">
    <link rel="stylesheet" href="..\css\cadastro.css">
    <link rel="stylesheet" href="..\css\responsiva.css">
  <title>Cadastro de Veículo</title>
</head>
<body>
  <h2>Cadastro de Veículo</h2>
  <?php
//Herda do banco
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

  // Processamento do formulário de cadastro
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST["modelo"];
    $marca = $_POST["marca"];    
    $cor = $_POST["cor"];    
    $placa = $_POST["placa"];
    $renavam = $_POST["renavam"];
    $km = $_POST["km"];
    

    // Verifica se o usuário já existe no banco de dados
    $query = "SELECT * FROM veiculos WHERE placa = '$placa'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      echo "<p class='error'>Veículo já cadastrado.</p>";
    } else {
// Insere o novo usuário no banco de dados
$query = "INSERT INTO veiculos (modelo, marca, cor, placa, renavam, km) VALUES ('$modelo', '$marca', '$cor', '$placa', '$renavam', '$km')";
if ($conn->query($query) === TRUE) {
  echo "<p>Veículo cadastrado com sucesso.</p>";
} else {
  echo "<p class='error'>Erro ao cadastrar Veículo: " . $conn->error . "</p>";
}
    }
  }

  // Processamento da exclusão de usuários
  if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["placa"])) {
    $username = $_GET["placa"];

    // Deleta o usuário do banco de dados
    $query = "DELETE FROM veiculos WHERE placa = '$placa'";
    if ($conn->query($query) === TRUE) {
      echo "<p>Veículo excluído com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao excluir veículo: " . $conn->error . "</p>";
    }
  }
  ?>

  <form id="userForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="Modelo">Modelo:</label><br>
    <input type="radio" name="modelo" value="Gol" checked>Gol<br>
    <input type="radio" name="modelo" value="Strada">Strada<br>
    <input type="radio" name="modelo" value="Fiorino">Fiorino<br>
    <input type="radio" name="modelo" value="HB20">HB20<br>
    <input type="radio" name="modelo" value="Onix">Onix<br>
    <input type="radio" name="modelo" value="Argo">Argo<br><br>
    <label for="marca">Marca:</label><br>
    <input type="radio" name="marca" value="Volkswagen" id="marcaVolkswagen">Volkswagen<br>
    <input type="radio" name="marca" value="Fiat" id="marcaFiat">Fiat<br>
    <input type="radio" name="marca" value="Chevrolet" id="marcaChevrolet">Chevrolet<br>
    <input type="radio" name="marca" value="Ford" id="marcaFord">Ford<br>
    <input type="radio" name="marca" value="Hyundai" id="marcaHyundai">Hyundai<br><br>
    <label for="cor">Cor:</label><br>
    <input type="radio" name="cor" value="Preto" checked>Preto<br>
    <input type="radio" name="cor" value="Branco">Branco<br>
    <input type="radio" name="cor" value="Cinza">Cinza<br>
    <input type="radio" name="cor" value="Vermelho">Vermelho<br>
    <input type="radio" name="cor" value="Azul">Azul<br><br>
    <label for="placa">Placa:</label>
    <input type="text" id="cad" name="placa" placeholder="Exemplo: AAA0000" required>
    <label for="renavam">Renavam:</label>
    <input type="text" id="cad" name="renavam" placeholder="11 dígitos" required>
    <label for="km">KM:</label>
    <input type="text" id="cad" name="km" placeholder="000000000" required>
    <input class="botoes" type="submit" value="Cadastrar"><br>
</form>

<script>
    // Adicione um ouvinte de eventos para os radio buttons de "modelo"
    var modeloRadioButtons = document.getElementsByName("modelo");
    for (var i = 0; i < modeloRadioButtons.length; i++) {
        modeloRadioButtons[i].addEventListener("click", function() {
            var selectedModel = this.value;
            // Desmarque todas as opções de marca
            var marcaRadioButtons = document.getElementsByName("marca");
            for (var j = 0; j < marcaRadioButtons.length; j++) {
                marcaRadioButtons[j].checked = false;
            }
            // Marque automaticamente a marca correspondente com base no modelo selecionado
            if (selectedModel === "Gol") {
                document.getElementById("marcaVolkswagen").checked = true;
            } else 
            if (selectedModel === "Strada") {
                document.getElementById("marcaFiat").checked = true;
            } else 
            if (selectedModel === "Fiorino") {
                document.getElementById("marcaFiat").checked = true;
            } else 
            if (selectedModel === "HB20") {
                document.getElementById("marcaHyundai").checked = true;
            } else 
            if (selectedModel === "Argo") {
                document.getElementById("marcaFiat").checked = true;
            } else 
            if (selectedModel === "Onix") {
                document.getElementById("marcaChevrolet").checked = true;
            }
        });
    }
</script>


  <br>
  <div id="botoes">
<a href="lista_carro.php"><input class="botoes" type="submit" value="Listar Veículos"></a>
<a href="painel.html"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
  </div>
</body>
</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>