<?php
session_start();
require_once 'autentica.php';

// Inclua a classe PHPMailer
require 'phpmailer/PHPMailerAutoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    // Configuração do PHPMailer
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Servidor SMTP (exemplo: smtp.gmail.com para o Gmail)
    $mail->Port = 587; // Porta SMTP (587 para TLS, 465 para SSL)
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls'; // 'tls' ou 'ssl', dependendo da porta
    $mail->Username = 'seuemail@gmail.com'; // Seu e-mail
    $mail->Password = 'sua_senha'; // Sua senha do e-mail
    $mail->setFrom('seuemail@gmail.com', 'Seu Nome'); // Seu e-mail e nome
    $mail->addAddress('destino@gmail.com'); // E-mail de destino

    // Conteúdo do e-mail
    $mail->Subject = 'Contato pelo site';
    $mail->Body = "Nome: $nome\nE-mail: $email\nMensagem: $mensagem";

    if ($mail->send()) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Ocorreu um erro ao enviar a mensagem: " . $mail->ErrorInfo;
    }
}
?>
