<?php
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];
    $data_nascimento = $_POST['data_nascimento'];

    $sql = "INSERT INTO Autores (nome, nacionalidade, data_nascimento) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $nacionalidade, $data_nascimento]);

    echo "Autor criado com sucesso! <a href='listar.php'>Voltar</a>";
}
?>

<form action="criar.php" method="post">
    Nome: <input type="text" name="nome" required><br>
    Nacionalidade: <input type="text" name="nacionalidade" required><br>
    Data de Nascimento: <input type="date" name="data_nascimento" required><br>
    <button type="submit">Criar Autor</button>
</form>

