<?php
// Verificar se o atendente não está logado
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login_atendente.php");
    exit;
}

// Incluir arquivo de conexão
include_once "conexao.php";

// Verificar se o ID do cliente foi enviado pela URL
if (!isset($_GET['id'])) {
    header("Location: admin.php"); // Redirecionar de volta para a página de administração se o ID não estiver definido
    exit;
}

// Obter o ID do cliente da URL
$id = $_GET['id'];

// Consultar o banco de dados para obter os detalhes do cliente com o ID fornecido
$sql = "SELECT * FROM clienteCrud WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar se o cliente foi encontrado no banco de dados
if (!$cliente) {
    $_SESSION['error_message'] = "Cliente não encontrado.";
    header("Location: admin.php"); // Redirecionar de volta para a página de administração se o cliente não for encontrado
    exit;
}

// Processar o formulário de edição do cliente se o formulário for enviado
if (isset($_POST['edit_cliente'])) {
    // Verificar se todos os campos necessários estão preenchidos
    if (!empty($_POST['nome']) && !empty($_POST['endereco']) && !empty($_POST['telefone']) && !empty($_POST['email'])) {
        // Obter os dados do formulário
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        // Atualizar os detalhes do cliente no banco de dados
        $sql = "UPDATE clienteCrud SET nome = ?, endereco = ?, telefone = ?, email = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $endereco, $telefone, $email, $id])) {
            $_SESSION['success_message'] = "Cliente atualizado com sucesso!";
            header("Location: admin.php"); // Redirecionar de volta para a página de administração após a edição
            exit;
        } else {
            $_SESSION['error_message'] = "Erro ao atualizar cliente.";
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
    <title>Editar Cliente</title>
</head>
<body>
    <h2>Editar Cliente</h2>
    <form method="post">
        <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" placeholder="Nome">
        <input type="text" name="endereco" value="<?= htmlspecialchars($cliente['endereco']) ?>" placeholder="Endereço">
        <input type="text" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" placeholder="Telefone">
        <input type="text" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" placeholder="Email">
        <button type="submit" name="edit_cliente">Atualizar</button>
    </form>
    <a href="admin.php">Cancelar</a>
</body>
</html>
