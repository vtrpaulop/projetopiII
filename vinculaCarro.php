<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

// Verifique se o ID do veículo foi passado na URL
if (isset($_GET['id'])) {
    $veiculo_id = $_GET['id'];

    // Suponha que você tenha o ID do usuário a partir do sistema de autenticação
    $user_id = $_SESSION['user_id'];

    // Execute uma consulta SQL para vincular o veículo ao usuário
    // Substitua a seguir com a sua consulta SQL para fazer a vinculação.
    $sql = "UPDATE veiculos SET user_id = $user_id WHERE id = $veiculo_id";
    $result = $conn->query($sql);

    if ($result) {
        // Vinculação bem-sucedida, redirecione o usuário de volta à página de listagem de veículos
        header("Location: listar_veiculos.php");
        exit();
    } else {
        // Se houver um erro na consulta SQL, você pode exibir uma mensagem de erro
        echo "Erro ao vincular o veículo ao usuário.";
    }
} else {
    // Se o ID do veículo não foi fornecido, redirecione o usuário de volta à página de listagem de veículos
    header("Location: listar_veiculos.php");
    exit();
}
?>
