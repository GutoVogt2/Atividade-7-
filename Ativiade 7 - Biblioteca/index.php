<?php
// Inclui a conexão com o banco de dados
require 'conexao/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Estilos CSS -->
</head>
<body>

    <!-- Cabeçalho -->
    <header>
        <h1 style="text-align: center; color: #333; padding: 20px 0;">Sistema de Gestão de Biblioteca</h1>
    </header>

    <!-- Menu Principal -->
    <nav>
        <ul style="list-style: none; text-align: center; padding: 20px 0;">
            <li><a href="autores/listar.php" class="link">Autores</a></li>
            <li><a href="livros/listar.php" class="link">Livros</a></li>
            <li><a href="leitores/listar.php" class="link">Leitores</a></li>
            <li><a href="emprestimos/listar.php" class="link">Empréstimos</a></li>
        </ul>
    </nav>

    <!-- Mensagem de Boas-vindas -->
    <section style="text-align: center; padding: 40px 0;">
        <p>Bem-vindo ao Sistema de Gestão de Biblioteca!</p>
        <p>Escolha uma das opções acima para começar a gerenciar autores, livros, leitores ou empréstimos.</p>
    </section>

    <!-- Rodapé -->
    <footer style="text-align: center; padding: 20px 0; background-color: #f4f4f4;">
        <p>&copy; 2025 Sistema de Gestão de Biblioteca</p>
    </footer>

</body>
</html>
