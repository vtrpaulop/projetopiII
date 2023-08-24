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
               <img class="logo" src="img\logo3.png">
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


        <h2>Bem-vindo!</h2><br>
        <p>Esta é uma página protegida.</p>
        </div>
       
                    <script>
                     function ponto() {
                     alert('Ponto registrado com sucesso!');
                     return false;
                      }
                     </script>
        <button id="registerButton" onclick="ponto()">Registrar Ponto</button>
    
    <script>
        document.getElementById("registerButton").addEventListener("click", function() {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                
                // Enviar os dados de localização para o servidor usando AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "/managerUser.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.responseText);
                    }
                };
                var data = "latitude=" + latitude + "&longitude=" + longitude;
                xhr.send(data);
            });
        });
    </script>
        
    

          <div id="footer"><p id="copy">&copy; vtR Project's </p></div>

    </body>

    </html>

    
