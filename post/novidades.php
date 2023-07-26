<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
 <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="\css\reset.css">
    <link rel="stylesheet" href="\css\listagem.css">
    <title>Publicações e Interações</title>
</head>
<body>
    <h1>Publicações e Interações</h1>

    <?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';
    // Verifica se o usuário está logado
    session_start();
    if (isset($_SESSION['username'])) {
        echo '<p>Bem-vindo, ' . $_SESSION['username'] . '! <a href="logout.php">Sair</a></p>';
        echo '<h2>Nova Publicação</h2>';
        echo '<form action="criarPost.php" method="post">';
        echo '    <textarea name="content" rows="4" cols="50" required></textarea><br>';
        echo '    <input type="submit" value="Publicar">';
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
    echo '<table>';
    echo '<tr><th>Por</th><th>Conteúdo</th><th>Data de Criação</th></tr>';

    while ($row = $result->fetch_assoc()) {
        
        echo '<tr>';
        echo '<td>' . 'Por: ' . $row['username'] . '</td>';
        echo '<td>' . 'Conteúdo: ' . $row['content'] . '</td>';
        echo '<td>' . 'Data de Criação: ' . $row['created_at'] . '</td>';
        //botao excluir baixo
        //echo '<td><a href="delete_post.php?id=' . $row['id'] . '">Excluir</a></td>';
        echo '</tr>';
       
    }

    echo '</table>';
    } else {
        echo '<p>Nenhuma publicação encontrada.</p>';
    }

    $conn->close();
    ?>
</body>
</html>