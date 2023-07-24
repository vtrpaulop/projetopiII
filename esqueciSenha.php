<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use League\OAuth2\Client\Provider\Google;


require_once 'autentica.php';

// Inclua a biblioteca PHPMailer
require 'PHPMailer\src\Exception.php';
require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\SMTP.php';

// Função para gerar uma senha aleatória
function gerarSenhaAleatoria($tamanho = 8) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $senha = '';
    for ($i = 0; $i < $tamanho; $i++) {
        $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $senha;
}



// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura o email do usuário do formulário
    $email = $_POST["email"];


    // Verifique se o email existe no banco de dados
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email encontrado no banco de dados
        // Gere uma nova senha temporária
        $novaSenha = gerarSenhaAleatoria();

        // Atualize a senha no banco de dados (lembre-se de criptografar a senha antes de armazená-la)
       
       // $sqlUpdate = "UPDATE users SET password = '$senhaCriptografada' WHERE email = '$email'";
        $sqlUpdate = "UPDATE users SET password = '$novaSenha' WHERE email = '$email'";
        if ($conn->query($sqlUpdate) === TRUE) {
            // Envie a nova senha por email usando o PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail = new PHPMailer;
                //Enable SMTP debugging
                // 0 = off (for production use)
                // 1 = client messages
                // 2 = client and server messages
                $mail->SMTPDebug = 2;
                // Configurações do Gmail para envio de email
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = "projetopiunivesp2023@gmail.com"; // Seu email do Gmail
                $mail->Password = "projetopi"; // Sua senha do Gmail
                $mail->SMTPSecure = 'tls';               
                $mail->Port = 465;
                $mail->CharSet = 'utf-8';
                $mail->Mailer = "smtp"; 
                
              //  Porta Gmail SMTP (SSL): 465

                // Configurações do email
                $mail->setFrom("projetopiunivesp2023@gmail.com", 'noreply');
                $mail->addAddress($email);
                $mail->Subject = 'Sua nova senha temporária';
                $mail->Body = "Sua nova senha temporária é: $novaSenha";

                // Envie o email
                $mail->send();

                echo "Uma nova senha temporária foi enviada para o seu email. Por favor, verifique sua caixa de entrada.";
            } catch (Exception $e) {
                echo "Erro ao enviar o email: {$mail->ErrorInfo}";
            }
        } else {
            echo "Erro ao atualizar a senha: " . $conn->error;
        }
    } else {
        // Email não encontrado no banco de dados
        echo "O email fornecido não está registrado.";
    }

    $conn->close();
}
?>