<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';

// Verifica se o formulário de registro de ponto foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrarPonto'])) {
  // Obter o ID do usuário da sessão
  if (isset($_SESSION['user_id'])) {
    $user_Id = $_SESSION['user_id'];

    // Inserir o registro de ponto no banco de dados
    $query = "INSERT INTO pontos (user_id, timestamp) VALUES ('$user_Id', NOW())";
    if ($conn->query($query) === TRUE) {
      echo "<p>Ponto registrado com sucesso.</p>";
    } else {
      echo "<p class='error'>Erro ao registrar ponto: " . $conn->error . "</p>";
    }
  } else {
    echo "<p class='error'>Usuário não identificado.</p>";
  }
}

