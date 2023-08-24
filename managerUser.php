<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

// Verifica se o usuário está autenticado e obtém o ID do usuário
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Verifica se as coordenadas de latitude e longitude foram fornecidas
    if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        
        // Insere os dados no banco de dados
        $query = "INSERT INTO pontos (user_id, latitude, longitude, timestamp) VALUES ('$user_id', '$latitude', '$longitude', NOW())";
        
        if ($conn->query($query) === TRUE) {
            echo "Ponto registrado com sucesso!";
        } else {
            echo "Erro ao registrar ponto: " . $conn->error;
        }
    } else {
        echo "Coordenadas de latitude e longitude não foram fornecidas.";
    }
} else {
    echo "Usuário não autenticado.";

}

?>
