<!DOCTYPE html>
<html>
<head>
    <title>Arquivo access.log</title>
</head>
<body>
    <h1>Conteúdo do Arquivo access.log</h1>
    <a href="painel.html"><button>Voltar</button></a>
    <pre>
        <?php
        $logFile = 'C:\xampp\apache\logs\access.log';

        if (file_exists($logFile)) {
            $content = file_get_contents($logFile);
            echo htmlspecialchars($content);
        } else {
            echo "O arquivo access.log não foi encontrado.";
        }
        ?>
    </pre>
</body>
</html>
