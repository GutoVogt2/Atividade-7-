<?php
require '../conexao.php';

$sql = "SELECT * FROM Leitores";
$stmt = $pdo->query($sql);
$leitores = $stmt->fetchAll();
?>

<h2>Lista de Leitores</h2>
<a href="criar.php">Novo Leitor</a><br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Nome</th><th>Email</th><th>Ações</th>
    </tr>
    <?php foreach ($leitores as $leitor): ?>
    <tr>
        <td><?= $leitor['id_leitor'] ?></td>
        <td><?= htmlspecialchars($leitor['nome']) ?></td>
        <td><?= htmlspecialchars($leitor['email']) ?></td>
        <td>
            <a href="editar.php?id=<?= $leitor['id_leitor'] ?>">Editar</a> |
            <a href="excluir.php?id=<?= $leitor['id_leitor'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
