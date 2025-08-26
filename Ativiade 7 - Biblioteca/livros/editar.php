<?php
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_livro'];
    $titulo = $_POST['titulo'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $genero = $_POST['genero'];
    $id_autor = $_POST['id_autor'];

    $sql = "UPDATE Livros SET titulo = ?, ano_publicacao = ?, genero = ?, id_autor = ? WHERE id_livro = ?";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$titulo, $ano_publicacao, $genero, $id_autor, $id]);
        echo "Livro atualizado com sucesso! <a href='listar.php'>Voltar</a>";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

    exit;
}

// GET
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM Livros WHERE id_livro = ?");
$stmt->execute([$id]);
$livro = $stmt->fetch();

if (!$livro) {
    die("Livro não encontrado.");
}

// Carregar todos os autores para seleção no formulário
$autores = $pdo->query("SELECT * FROM Autores")->fetchAll();
?>

<h2>Editar Livro</h2>
<form method="post">
    <input type="hidden" name="id_livro" value="<?= $livro['id_livro'] ?>">
    Título: <input type="text" name="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>" required><br><br>
    Ano de Publicação: <input type="number" name="ano_publicacao" value="<?= $livro['ano_publicacao'] ?>" min="1500" max="<?= date('Y') ?>" required><br><br>
    Gênero: <input type="text" name="genero" value="<?= htmlspecialchars($livro['genero']) ?>" required><br><br>
    Autor:
    <select name="id_autor" required>
        <?php foreach ($autores as $autor): ?>
            <option value="<?= $autor['id_autor'] ?>" <?= $livro['id_autor'] == $autor['id_autor'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($autor['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
    <button type="submit">Atualizar</button>
</form>
