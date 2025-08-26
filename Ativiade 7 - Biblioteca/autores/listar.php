<?php
require '../conexao.php';

$sql = "SELECT * FROM Autores";
$stmt = $pdo->query($sql);
$autores = $stmt->fetchAll();
?>

<h2>Lista de Autores</h2>
<a href="criar.php">Novo Autor</a><br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Nome</th><th>Ações</th>
    </tr>
    <?php foreach ($autores as $autor): ?>
    <tr>
        <td><?= $autor['id_autor'] ?></td>
        <td><?= htmlspecialchars($autor['nome']) ?></td>
        <td>
            <a href="editar.php?id=<?= $autor['id_autor'] ?>">Editar</a> |
            <a href="excluir.php?id=<?= $autor['id_autor'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
