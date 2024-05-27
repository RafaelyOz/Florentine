<?php 
session_start();
include 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM atendentes WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['atendente_id'] = $user['id'];
        header("Location: admin.php");
        exit();
    }else{
        header("Location: admin.php");
        exit();
    }
}

?>