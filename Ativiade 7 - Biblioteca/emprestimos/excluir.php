<?php
require '../conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM Emprestimos WHERE id_emprestimo = ?");
    $stmt->execute([$id]);

    echo "Empréstimo excluído. <a href='listar.php'>Voltar</a>";
} else {
    echo "ID do empréstimo não fornecido.";
}
?>