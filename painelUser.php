<?php

session_start();

   // Obter o ID do usuário da sessão
   if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}


?>

<!DOCTYPE html>
        
        
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css\reset.css">
        <link rel="stylesheet" href="css\painel.css">
        <title>Página Protegida</title>
    </head>
    <body>
            <div id="header">
               <img class="logo" src="img\logo.png">
                <div class="botao-log">
                    <form action="logout.php" method="post">
                     <input type="submit" value="Logout" onclick="mostrarMensagem()">

                     <script>
                     function mostrarMensagem() {
                     alert('Logout realizado com sucesso!');
                     return false;
                      }
                     </script>
                    </form>
                </div>
            </div>

            
        <div class="body">

        <h2>Bem-vindo!</h2><br>
        <p>Esta é uma página protegida.</p>
        </div>
        <a href="managerUser.php"><button type="submit">Registrar ponto</button></a>
        
    

          <div id="footer"><p id="copy">&copy; vtR Project's </p></div>

    </body>

    </html>

    
