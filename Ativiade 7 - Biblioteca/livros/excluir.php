<?php
require '../conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM Livros WHERE id_livro = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    echo "Livro excluído. <a href='listar.php'>Voltar</a>";
} else {
    echo "ID não fornecido.";
}
