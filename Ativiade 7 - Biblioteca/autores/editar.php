<?php
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_autor = $_POST['id_autor'];
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];
    $data_nascimento = $_POST['data_nascimento'];

    $sql = "UPDATE Autores SET nome = ?, nacionalidade = ?, data_nascimento = ? WHERE id_autor = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $nacionalidade, $data_nascimento, $id_autor]);

    echo "Autor atualizado com sucesso! <a href='listar.php'>Voltar</a>";
} else {
    $id_autor = $_GET['id'];
    $sql = "SELECT * FROM Autores WHERE id_autor = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_autor]);
    $autor = $stmt->fetch();
}
?>

<form action="editar.php" method="post">
    <input type="hidden" name="id_autor" value="<?= $autor['id_autor'] ?>">
    Nome: <input type="text" name="nome" value="<?= $autor['nome'] ?>" required><br>
    Nacionalidade: <input type="text" name="nacionalidade" value="<?= $autor['nacionalidade'] ?>" required><br>
    Data de Nascimento: <input type="date" name="data_nascimento" value="<?= $autor['data_nascimento'] ?>" required><br>
    <button type="submit">Editar Autor</button>
</form>
