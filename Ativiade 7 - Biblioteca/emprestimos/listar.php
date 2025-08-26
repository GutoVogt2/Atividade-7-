<?php
require '../conexao.php';

$status = $_GET['status'] ?? 'ativos';

if ($status === 'concluidos') {
    $sql = "SELECT e.*, l.titulo, le.nome as leitor FROM Emprestimos e
            JOIN Livros l ON e.id_livro = l.id_livro
            JOIN Leitores le ON e.id_leitor = le.id_leitor
            WHERE e.data_devolucao IS NOT NULL";
} else {
    $sql = "SELECT e.*, l.titulo, le.nome as leitor FROM Emprestimos e
            JOIN Livros l ON e.id_livro = l.id_livro
            JOIN Leitores le ON e.id_leitor = le.id_leitor
            WHERE e.data_devolucao IS NULL";
}

$stmt = $pdo->query($sql);
$emprestimos = $stmt->fetchAll();
?>

<a href="?status=ativos">Ativos</a> | <a href="?status=concluidos">Concluídos</a>
<table border="1">
    <tr>
        <th>Livro</th><th>Leitor</th><th>Data Empréstimo</th><th>Data Devolução</th>
    </tr>
    <?php foreach ($emprestimos as $e): ?>
    <tr>
        <td><?= $e['titulo'] ?></td>
        <td><?= $e['leitor'] ?></td>
        <td><?= $e['data_emprestimo'] ?></td>
        <td><?= $e['data_devolucao'] ?: 'Em aberto' ?></td>
    </tr>
    <?php endforeach; ?>
</table>
