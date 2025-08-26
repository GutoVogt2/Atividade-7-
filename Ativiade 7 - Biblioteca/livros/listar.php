<?php
require '../conexao.php';

$filtro_genero = $_GET['genero'] ?? '';
$filtro_autor = $_GET['autor'] ?? '';
$filtro_ano = $_GET['ano'] ?? '';

$pagina = $_GET['pagina'] ?? 1;
$por_pagina = 10;
$offset = ($pagina - 1) * $por_pagina;

$where = [];
$params = [];

if ($filtro_genero) {
    $where[] = "genero = ?";
    $params[] = $filtro_genero;
}
if ($filtro_autor) {
    $where[] = "id_autor = ?";
    $params[] = $filtro_autor;
}
if ($filtro_ano) {
    $where[] = "ano_publicacao = ?";
    $params[] = $filtro_ano;
}

$sql = "SELECT * FROM Livros";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " LIMIT $por_pagina OFFSET $offset";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$livros = $stmt->fetchAll();
?>

<form method="get">
    Gênero: <input type="text" name="genero" value="<?= $filtro_genero ?>">
    Autor ID: <input type="text" name="autor" value="<?= $filtro_autor ?>">
    Ano: <input type="text" name="ano" value="<?= $filtro_ano ?>">
    <button type="submit">Filtrar</button>
</form>

<table border="1">
    <tr>
        <th>Título</th><th>Ano</th><th>Gênero</th><th>Ações</th>
    </tr>
    <?php foreach ($livros as $livro): ?>
    <tr>
        <td><?= htmlspecialchars($livro['titulo']) ?></td>
        <td><?= $livro['ano_publicacao'] ?></td>
        <td><?= $livro['genero'] ?></td>
        <td>
            <a href="editar.php?id=<?= $livro['id_livro'] ?>">Editar</a> |
            <a href="excluir.php?id=<?= $livro['id_livro'] ?>">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- Paginação -->
<a href="?pagina=<?= $pagina - 1 ?>">Anterior</a> | <a href="?pagina=<?= $pagina + 1 ?>">Próxima</a>
