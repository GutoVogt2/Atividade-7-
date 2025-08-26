<?php
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "INSERT INTO Leitores (nome, email) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$nome, $email]);
        echo "Leitor cadastrado com sucesso! <a href='listar.php'>Voltar</a>";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

    exit;
}
?>

<h2>Cadastrar Leitor</h2>
<form method="post">
    Nome: <input type="text" name="nome" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    <button type="submit">Cadastrar</button>
</form>
