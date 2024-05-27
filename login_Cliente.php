<?php 
session_start();
include 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['cliente_id'] = $user['id'];
        header("Location: index.php");
        exit();
    }else{
        header("Location: login.html");
        exit();
    }
}

?>