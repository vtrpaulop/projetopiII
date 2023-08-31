<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';
// Verificar o login do usuário
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Utilize declarações preparadas para proteger contra injeção SQL
$stmt = $conn->prepare("SELECT id, username FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $stmt->close();
    $conn->close();
    header("Location: painelUser.php");
    exit();
} else {
    $stmt->close();
    $conn->close();
    $_SESSION['login_error'] = "Usuário ou senha inválidos.";
    header("Location: loginU.php");
    exit();
}
?>
