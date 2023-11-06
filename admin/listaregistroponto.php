<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

// Processamento da exclusão de itens
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
    $data_ini = $_GET['data_ini'] ?? '';
    $data_fim = $_GET['data_fim'] ?? '';

    function formatarData($data) {
        return date('d/m/Y', strtotime($data));
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="..\css\reset.css">
    <link rel="stylesheet" href="..\css\ponto.css">
    <link rel="stylesheet" href="..\css\responsiva.css">
    <title>Listagem de pontos registrados</title>
</head>

<body>

    <div class="container">
        <h2>Listagem de pontos registrados</h2>
        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="search">Filtrar por nome:</label>
            <input type="text" id="search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <br><br>
            <label for="data_ini">Data de Início:</label>
            <input type="date" id="data_ini" name="data_ini">
            <label for="data_fim">Data de Término:</label>
            <input type="date" id="data_fim" name="data_fim">
            <button type="submit">Filtrar</button>
        </form><br>
        <button id="printButton">Imprimir</button>
        <button id="exportButton">Salvar em PDF</button>
    </div>
    <h1>
        <br><?php 
        if (!empty($data_ini) && !empty($data_fim)) {
            echo "De: " . formatarData($data_ini) . " a " . formatarData($data_fim);
        } elseif (!empty($data_ini)) {
            echo "A partir de: " . formatarData($data_ini);
        } elseif (!empty($data_fim)) {
            echo "Até: " . formatarData($data_fim);
        } else {
            echo "Período não especificado";
        }
        ?></h1>
        <br>

        <div class="table-container">
            <?php
            // Busca todos os pontos no banco de dados
            $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
            $data_ini = $_GET['data_ini'] ?? '';
            $data_fim = $_GET['data_fim'] ?? '';

            if (!empty($data_ini) || !empty($data_fim) || !empty($search)) {
                // Monta a consulta SQL com os filtros de datas e nomes conjugados
                $query = "SELECT p.id AS ponto_id, u.id AS user_id, CONCAT(u.nome, ' ', u.sobrenome) AS nome_completo, p.timestamp
                          FROM pontos p INNER JOIN users u ON p.user_id = u.id
                          WHERE ";

                $conditions = array();

                if (!empty($data_ini)) {
                    $conditions[] = "p.timestamp >= '$data_ini 00:00:00'";
                }

                if (!empty($data_fim)) {
                    $conditions[] = "p.timestamp <= '$data_fim 23:59:59'";
                }

                if (!empty($search)) {
                    $conditions[] = "(u.nome LIKE '%$search%' OR u.sobrenome LIKE '%$search%')";
                }

                $query .= implode(" AND ", $conditions);

                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='row'>";
                        echo "<div class='cell'>" . "Id do log <br>" . $row["ponto_id"] . "</div>";
                        echo "<div class='cell'>" . "Id do Usuário  <br>" . $row["user_id"] . "</div>";
                        echo "<div class='cell'>" . "Nome do Usuário <br>" . ucwords($row["nome_completo"]) . "</div>";
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
            }
            ?>
        </div><br>
        <a href="../admin/painel.html"><input id="voltar" type="submit" name="voltar" value="Voltar"></a>
    </div>
<script>
    document.getElementById("printButton").addEventListener("click", function() {
        window.print();
    });

    document.getElementById("exportButton").addEventListener("click", function() {
        const content = document.getElementById("conteudo"); // Substitua "conteudo" pelo ID do elemento que deseja exportar

        html2pdf().from(content).save("arquivo.pdf");
    });
</script>
</body>

</html>
