<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Consulta SQL para verificar se o e-mail existe
    $consulta = $conexao->prepare("SELECT COUNT(*) as total FROM users WHERE email = :email");
    $consulta->bindParam(":email", $email);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] > 0) {
        // O e-mail é válido, pois foi encontrado na tabela "users"
        
        // Gere uma nova senha aleatória
        $novaSenha = gerarNovaSenha();

        // Crie um hash seguro da nova senha
        $hashSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

        // Atualize a senha no banco de dados
        $atualizarSenha = $conexao->prepare("UPDATE users SET password = :senha WHERE email = :email");
        $atualizarSenha->bindParam(":senha", $hashSenha);
        $atualizarSenha->bindParam(":email", $email);
        $atualizarSenha->execute();

        // Envie a nova senha por e-mail usando PHPMailer
        enviarEmail($email, $novaSenha);

        // Exiba uma mensagem de sucesso para o usuário
        echo "Uma nova senha foi enviada para o seu e-mail. Verifique sua caixa de entrada.";
    } else {
        // Se o e-mail não existe na tabela de usuários, exiba uma mensagem de erro
        echo "E-mail não encontrado. Verifique o e-mail inserido.";
    }
}

function gerarNovaSenha() {
    $caracteresPermitidos = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $novaSenha = '';
    $tamanhoSenha = 10; // Escolha o tamanho desejado para a senha

    for ($i = 0; $i < $tamanhoSenha; $i++) {
        $posicao = rand(0, strlen($caracteresPermitidos) - 1);
        $novaSenha .= $caracteresPermitidos[$posicao];
    }

    return $novaSenha;
}

function enviarEmail($email, $novaSenha) {
    require 'caminho/para/PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Altere para o seu servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'seu_email@gmail.com'; // Seu email
    $mail->Password = 'sua_senha'; // Sua senha
    $mail->SMTPSecure = 'tls'; // TLS ou SSL
    $mail->Port = 587; // Porta SMTP

    $mail->setFrom('seu_email@gmail.com', 'Seu Nome');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Nova Senha';
    $mail->Body = 'Sua nova senha é: ' . $novaSenha;

    if (!$mail->send()) {
        echo 'Erro ao enviar email: ' . $mail->ErrorInfo;
    } else {
        echo 'Email enviado com sucesso!';
    }
}
?>
