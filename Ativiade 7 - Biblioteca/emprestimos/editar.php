<?php
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_emprestimo'];
    $data_emprestimo = $_POST['data_emprestimo'];
    $data_devolucao = $_POST['data_devolucao'];

    if (!empty($data_devolucao) && $data_devolucao < $data_emprestimo) {
        die("A data de devolução não pode ser anterior à de empréstimo.");
    }

    $stmt = $pdo->prepare("UPDATE Emprestimos SET data_emprestimo = ?, data_devolucao = ? WHERE id_emprestimo = ?");
    $stmt->execute([$data_emprestimo, $data_devolucao ?: null, $id]);

    echo "Empréstimo atualizado. <a href='listar.php'>Voltar</a>";
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM Emprestimos WHERE id_emprestimo = ?");
$stmt->execute([$id]);
$emprestimo = $stmt->fetch();

if (!$emprestimo) {
    die("Empréstimo não encontrado.");
}
?>

<h2>Editar Empréstimo</h2>
<form method="post">
    <input type="hidden" name="id_emprestimo" value="<?= $emprestimo['id_emprestimo'] ?>">
    Data de Empréstimo: <input type="date" name="data_emprestimo" value="<?= $emprestimo['data_emprestimo'] ?>" required><br><br>
    Data de Devolução: <input type="date" name="data_devolucao" value="<?= $emprestimo['data_devolucao'] ?>"><br><br>
    <button type="submit">Salvar Alterações</button>
</form>

<?php
require '../conexao.php';

$id_leitor = $_GET['id_leitor'] ?? null;

if (!$id_leitor) {
    die("Leitor não especificado.");
}

$sql = "SELECT l.titulo, e.data_emprestimo, e.data_devolucao
        FROM Emprestimos e
        JOIN Livros l ON e.id_livro = l.id_livro
        WHERE e.id_leitor = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id_leitor]);
$livros = $stmt->fetchAll();
?>

<h2>Livros emprestados ao leitor #<?= $id_leitor ?></h2>
<table border="1">
    <tr>
        <th>Título</th><th>Data Empréstimo</th><th>Data Devolução</th>
    </tr>
    <?php foreach ($livros as $livro): ?>
    <tr>
        <td><?= $livro['titulo'] ?></td>
        <td><?= $livro['data_emprestimo'] ?></td>
        <td><?= $livro['data_devolucao'] ?: 'Em aberto' ?></td>
    </tr>
    <?php endforeach; ?>
</table>

