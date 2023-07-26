<?php
require 'vendor/autoload.php'; // Inclua o autoloader do Mailgun
require_once 'autentica.php';
use Mailgun\Mailgun;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    # Substitua pelas suas chaves da API e pelo domínio do Mailgun
    $mg = Mailgun::create('SUA_CHAVE_API');
    $domain = 'seu_dominio_mailgun';

    $params = [
        'from'    => 'seuemail@gmail.com', // Substitua pelo seu e-mail
        'to'      => 'destino@gmail.com', // Substitua pelo e-mail que receberá as mensagens
        'subject' => 'Contato pelo site',
        'text'    => "Nome: $nome\nE-mail: $email\nMensagem: $mensagem",
    ];

    try {
        $mg->messages()->send($domain, $params);
        echo "Mensagem enviada com sucesso!";
    } catch (Exception $e) {
        echo "Ocorreu um erro ao enviar a mensagem: {$e->getMessage()}";
    }
}
?>
