<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';
// Criar nova publicação
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['content'])) {
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];


    $sql = "INSERT INTO posts (user_id, content, created_at) VALUES ('$user_id', '$content', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Publicação criada com sucesso!";
    } else {
        echo "Erro ao criar publicação: " . $conn->error;
    }

    $conn->close();
}

header("Location: novidades.php");
?>