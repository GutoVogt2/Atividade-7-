<?php
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_leitor'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE Leitores SET nome = ?, email = ? WHERE id_leitor = ?";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$nome, $email, $id]);
        echo "Leitor atualizado com sucesso! <a href='listar.php'>Voltar</a>";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

    exit;
}

// GET
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM Leitores WHERE id_leitor = ?");
$stmt->execute([$id]);
$leitor = $stmt->fetch();

if (!$leitor) {
    die("Leitor não encontrado.");
}
?>

<h2>Editar Leitor</h2>
<form method="post">
    <input type="hidden" name="id_leitor" value="<?= $leitor['id_leitor'] ?>">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($leitor['nome']) ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($leitor['email']) ?>" required><br><br>
    <button type="submit">Atualizar</button>
</form>
