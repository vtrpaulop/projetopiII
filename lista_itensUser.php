 <?php
//Herda do banco
require_once 'autentica.php';



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
        
        echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='3'>Nenhum item cadastrado.</td></tr>";
    }
    ?>
  </table>

<a href="painelUser.html"><input id="voltar"  type="submit" name="voltar" value="Voltar" ></a>
  
</body>
</html>

  