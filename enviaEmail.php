<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'caminho_para_phpmailer/src/Exception.php';
require 'caminho_para_phpmailer/src/PHPMailer.php';
require 'caminho_para_phpmailer/src/SMTP.php';

// Inicializa o PHPMailer
$mail = new PHPMailer(true);

try {
    // Configurações do PHPMailer
    $mail->isSMTP();
    $mail->Host = 'smtp.seudominio.com.br'; // Altere para o servidor SMTP da Locaweb
    $mail->SMTPAuth = true;
    $mail->Username = 'seuemail@seudominio.com.br'; // Seu e-mail da Locaweb
    $mail->Password = 'suasenha'; // Sua senha de e-mail
    $mail->SMTPSecure = 'tls'; // Use 'tls' ou 'ssl' dependendo das configurações da Locaweb
    $mail->Port = 587; // Porta para TLS (ou 465 para SSL)

    // Configurações do e-mail
    $mail->setFrom('seuemail@seudominio.com.br', 'Seu Nome');
    $mail->addAddress('destinatario@dominio.com', 'Nome do Destinatário');
    $mail->isHTML(true);
    $mail->Subject = 'Assunto do E-mail';
    $mail->Body = 'Corpo do E-mail em HTML ou texto simples';

    // Envia o e-mail
    $mail->send();
    echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {
    echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
}
?>
