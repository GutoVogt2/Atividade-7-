<?php
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $genero = $_POST['genero'];
    $id_autor = $_POST['id_autor'];

    $sql = "INSERT INTO Livros (titulo, ano_publicacao, genero, id_autor) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$titulo, $ano_publicacao, $genero, $id_autor]);
        echo "Livro cadastrado com sucesso! <a href='listar.php'>Voltar</a>";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

    exit;
}

// Carregar todos os autores para seleção no formulário
$autores = $pdo->query("SELECT * FROM Autores")->fetchAll();
?>

<h2>Cadastrar Livro</h2>
<form method="post">
    Título: <input type="text" name="titulo" required><br><br>
    Ano de Publicação: <input type="number" name="ano_publicacao" min="1500" max="<?= date('Y') ?>" required><br><br>
    Gênero: <input type="text" name="genero" required><br><br>
    Autor:
    <select name="id_autor" required>
        <?php foreach ($autores as $autor): ?>
            <option value="<?= $autor['id_autor'] ?>"><?= htmlspecialchars($autor['nome']) ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <button type="submit">Cadastrar</button>
</form>
