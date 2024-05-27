<?php 
$host = 'localhost';
$dbname = 'flori';
$username = 'root';
$password = 'positivorafa';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Erro ao se conectar no banco de dados: " . $e->getMessage());
}



?>