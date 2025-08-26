<?php
require '../conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se o leitor tem empréstimos antes de excluir
    $verifica = $pdo->prepare("SELECT COUNT(*) FROM Emprestimos WHERE id_leitor = ?");
    $verifica->execute([$id]);
    $temEmprestimos = $verifica->fetchColumn();

    if ($temEmprestimos > 0) {
        die("Este leitor possui empréstimos associados. Não pode ser excluído.");
    }

    $sql = "DELETE FROM Leitores WHERE id_leitor = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    echo "Leitor excluído. <a href='listar.php'>Voltar</a>";
} else {
    echo "ID não fornecido.";
}
