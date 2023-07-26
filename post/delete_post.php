<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/autentica.php';;
// delete_post.php

// Verifica se o ID da publicação foi fornecido na URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];



    $sql = "DELETE FROM posts WHERE id = '$post_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Publicação excluída com sucesso!";
    } else {
        echo "Erro ao excluir publicação: " . $conn->error;
    }

    $conn->close();

    // Redireciona de volta para a página index.php após a exclusão
    header("Location: novidades.php");
    exit;
} else {
    // Redireciona de volta para a página index.php se o ID não foi fornecido
    header("Location: novidades.php");
    exit;
}
?>