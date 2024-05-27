<?php 
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO clientes (nome, email, username, password) VALUES (?, ?, ?,?)");
    $stmt->execute([$nome, $email, $username, $password]);

    header("Location: login.html");
    exit();
}
?>
