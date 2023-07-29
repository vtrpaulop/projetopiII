<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">

 <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="..\css\reset.css">
    <link rel="stylesheet" href="..\css\listagem.css">
    <link rel="stylesheet" href="..\css\index.css">
    <link rel="stylesheet" href="..\css\novidades.css">
    <link rel="stylesheet" href="..\css\responsiva.css">
    <title>Publicações e Interações</title>
</head>
<body>

    <div id="header">
    <img id="logo" src="..\img\bee.png">
    <p class="titletop"> ESTE É O CABEÇALHO </p>
  <div class="menu">
    <button class="button"><a href="loginI.php" class="button">Entrar</a></button>
     <button class="button"><a href="contato.html" class="button">Contato</a></button>
     <button class="button"><a href="post\novidades.php" class="button">Novidades</a></button>
     <button class="button"><a href="cadastroUserHome.php" class="button">Cadastrar</a></button>
     <button class="button"><a href="" class="button">Sobre</a></button>
  </div>


    <h1>Publicações e Interações</h1>

    <?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';
    // Verifica se o usuário está logado
    session_start();
    if (isset($_SESSION['username'])) {
        echo '<p>Bem-vindo, ' . $_SESSION['username'] . '! <a href="logout.php">Sair</a></p>';
        echo '<h2>Nova Publicação</h2>';
        echo '<form action="criarPost.php" method="post">';
        echo '<textarea name="content" rows="4" cols="50" required></textarea><br>';
        echo '<input type="submit" value="Publicar">';
        echo '</form>';
    } else {
        echo '<p><a href="login2.php">Faça login</a> para criar publicações e interagir.</p>';
    }

    echo '<h2>Publicações</h2>';


    $sql = "SELECT posts.id, posts.content, users.username, posts.created_at
            FROM posts 
            INNER JOIN users ON posts.user_id = users.id 
            ORDER BY posts.created_at DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   

    while ($row = $result->fetch_assoc()) {
        
    echo '<div class="post">';
    echo '<p><strong>Usuário:</strong> ' . $row['username'] . '</p>';
    echo '<p><strong>Comentário:</strong> ' . $row['content'] . '</p>';
    echo '<p><strong>Criado em:</strong> ' . $row['created_at'] . '</p>';
    // Botão Excluir
    // echo '<a href="delete_post.php?id=' . $row['id'] . '">Excluir</a>';
    echo '</div>';
       
    }

    
    } else {
        echo '<p>Nenhuma publicação encontrada.</p>';
    }

    $conn->close();

    ?>

<button><a href="../index.html">Voltar</a></button>


<div id="footer"><p id="copy">&copy; Projeto PI II </p></div>
</div>


</body>
</html>