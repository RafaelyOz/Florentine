<?php
// Verificar se o atendente não está logado
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login_atendente.php");
    exit;
}

// Incluir arquivo de conexão
include_once "conexao.php";

// Verificar se o ID do pedido foi enviado pela URL
if (!isset($_GET['id'])) {
    header("Location: admin.php"); // Redirecionar de volta para a página de administração se o ID não estiver definido
    exit;
}

// Obter o ID do pedido da URL
$id = $_GET['id'];

// Consultar o banco de dados para obter os detalhes do pedido com o ID fornecido
$sql = "SELECT * FROM pedidos WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar se o pedido foi encontrado no banco de dados
if (!$pedido) {
    $_SESSION['error_message'] = "Pedido não encontrado.";
    header("Location: admin.php"); // Redirecionar de volta para a página de administração se o pedido não for encontrado
    exit;
}

// Processar o formulário de edição do pedido se o formulário for enviado
if (isset($_POST['edit_pedido'])) {
    // Verificar se todos os campos necessários estão preenchidos
    if (!empty($_POST['cliente_id']) && !empty($_POST['data_pedido']) && !empty($_POST['status'])) {
        // Obter os dados do formulário
        $cliente_id = $_POST['cliente_id'];
        $data_pedido = $_POST['data_pedido'];
        $status = $_POST['status'];
        // Atualizar os detalhes do pedido no banco de dados
        $sql = "UPDATE pedidos SET cliente_id = ?, data_pedido = ?, status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$cliente_id, $data_pedido, $status, $id])) {
            $_SESSION['success_message'] = "Pedido atualizado com sucesso!";
            header("Location: admin.php"); // Redirecionar de volta para a página de administração após a edição
            exit;
        } else {
            $_SESSION['error_message'] = "Erro ao atualizar pedido.";
        }
    } else {
        $_SESSION['error_message'] = "Por favor, preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Editar Pedido</title>
</head>
<body>
    <h2>Editar Pedido</h2>
    <form method="post">
        <input type="text" name="cliente_id" value="<?= htmlspecialchars($pedido['cliente_id']) ?>" placeholder="ID do Cliente">
        <input type="date" name="data_pedido" value="<?= htmlspecialchars($pedido['data_pedido']) ?>" placeholder="Data do Pedido">
        <input type="text" name="status" value="<?= htmlspecialchars($pedido['status']) ?>" placeholder="Status">
        <button type="submit" name="edit_pedido">Atualizar</button>
    </form>
    <a href="admin.php">Cancelar</a
