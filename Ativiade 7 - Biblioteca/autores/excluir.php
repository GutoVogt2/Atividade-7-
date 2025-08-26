<?php
require '../conexao.php';

if (isset($_GET['id'])) {
    $id_autor = $_GET['id'];

    // Verifique se o autor possui livros associados
    $sqlLivros = "SELECT * FROM Livros WHERE id_autor = ?";
    $stmtLivros = $pdo->prepare($sqlLivros);
    $stmtLivros->execute([$id_autor]);

    if ($stmtLivros->rowCount() > 0) {
        echo "Não é possível excluir este autor porque ele tem livros associados.";
    } else {
        // Excluindo autor
        $sql = "DELETE FROM Autores WHERE id_autor = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_autor]);

        echo "Autor excluído com sucesso! <a href='listar.php'>Voltar</a>";
    }
} else {
    echo "Autor não encontrado.";
}
?>
