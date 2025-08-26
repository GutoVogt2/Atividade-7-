<?php
// Dados de conexão com o banco de dados
$host = 'localhost'; // ou o IP do servidor
$dbname = 'nome_do_banco_de_dados'; // Substitua com o nome do seu banco de dados
$user = 'root'; // Usuário do banco de dados
$pass = ''; // Senha do banco de dados

// Configurações de conexão com o banco de dados
try {
    // Estabelecendo a conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    
    // Configura o modo de erro do PDO para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Caso a conexão seja bem-sucedida
    // echo "Conexão com o banco de dados estabelecida com sucesso!";
    
} catch (PDOException $e) {
    // Caso ocorra algum erro na conexão, ele é capturado aqui
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    die(); // Finaliza a execução do script em caso de erro
}
?>
