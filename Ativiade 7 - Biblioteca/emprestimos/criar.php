<?php
$sqlEmprestimos = "CREATE TABLE IF NOT EXISTS Emprestimos (
    id_emprestimo INT AUTO_INCREMENT PRIMARY KEY,
    id_livro INT NOT NULL,
    data_emprestimo DATE NOT NULL,
    data_devolucao DATE,
    FOREIGN KEY (id_livro) REFERENCES Livros(id_livro)
)";

$pdo->exec($sqlEmprestimos);
?>

</form>

<?php
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_livro = $_POST['id_livro'];
    $data_emprestimo = $_POST['data_emprestimo'];
    $data_devolucao = $_POST['data_devolucao'];

    // Verifica se o livro tem ano de publicação válido
    $anoAtual = date('Y');
    $stmt = $pdo->prepare("SELECT ano_publicacao FROM Livros WHERE id_livro = ?");
    $stmt->execute([$id_livro]);
    $livro = $stmt->fetch();

    if (!$livro) {
        die("Livro não encontrado.");
    }

    if ($livro['ano_publicacao'] <= 1500 || $livro['ano_publicacao'] > $anoAtual) {
        die("O livro tem um ano de publicação inválido.");
    }

    // Verifica se já existe um empréstimo ativo (sem data de devolução)
    $stmt = $pdo->prepare("SELECT * FROM Emprestimos WHERE id_livro = ? AND data_devolucao IS NULL");
    $stmt->execute([$id_livro]);

    if ($stmt->rowCount() > 0) {
        die("Este livro já está emprestado.");
    }

    // Verifica se data de devolução não é anterior à de empréstimo
    if (!empty($data_devolucao) && $data_devolucao < $data_emprestimo) {
        die("A data de devolução não pode ser anterior à data de empréstimo.");
    }

    // Insere o empréstimo
    $stmt = $pdo->prepare("INSERT INTO Emprestimos (id_livro, data_emprestimo, data_devolucao) VALUES (?, ?, ?)");
    $stmt->execute([$id_livro, $data_emprestimo, $data_devolucao ?: null]);

    echo "Empréstimo registrado com sucesso! <a href='listar.php'>Voltar</a>";
    exit;
}

// Carrega livros disponíveis
$livros = $pdo->query("SELECT * FROM Livros")->fetchAll();
?>

<h2>Criar Empréstimo</h2>
<form method="post">
    Livro:
    <select name="id_livro" required>
        <?php foreach ($livros as $livro): ?>
            <option value="<?= $livro['id_livro'] ?>">
                <?= htmlspecialchars($livro['titulo']) ?> (<?= $livro['ano_publicacao'] ?>)
            </option>
        <?php endforeach; ?>
    </select><br><br>

    Data de Empréstimo: <input type="date" name="data_emprestimo" required><br><br>
    Data de Devolução (opcional): <input type="date" name="data_devolucao"><br><br>

    <button type="submit">Registrar Empréstimo</button>
</form>
s

