<?php
// Verificar se o atendente não está logado
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login_atendente.php");
    exit;
}

// Incluir arquivo de conexão
include_once "conexao.php";

// Verificar se o ID do produto foi enviado pela URL
if (!isset($_GET['id'])) {
    header("Location: admin.php"); // Redirecionar de volta para a página de administração se o ID não estiver definido
    exit;
}

// Obter o ID do produto da URL
$id = $_GET['id'];

// Consultar o banco de dados para obter os detalhes do produto com o ID fornecido
$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar se o produto foi encontrado no banco de dados
if (!$produto) {
    $_SESSION['error_message'] = "Produto não encontrado.";
    header("Location: admin.php"); // Redirecionar de volta para a página de administração se o produto não for encontrado
    exit;
}

// Processar o formulário de edição do produto se o formulário for enviado
if (isset($_POST['edit_produto'])) {
    // Verificar se todos os campos necessários estão preenchidos
    if (!empty($_POST['nome']) && !empty($_POST['descricao']) && !empty($_POST['preco']) && !empty($_POST['estoque'])) {
        // Obter os dados do formulário
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $estoque = $_POST['estoque'];
        // Atualizar os detalhes do produto no banco de dados
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, estoque = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $descricao, $preco, $estoque, $id])) {
            $_SESSION['success_message'] = "Produto atualizado com sucesso!";
            header("Location: admin.php"); // Redirecionar de volta para a página de administração após a edição
            exit;
        } else {
            $_SESSION['error_message'] = "Erro ao atualizar produto.";
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
    <title>Editar Produto</title>
</head>
<body>
    <h2>Editar Produto</h2>
    <form method="post">
        <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" placeholder="Nome">
        <input type="text" name="descricao" value="<?= htmlspecialchars($produto['descricao']) ?>" placeholder="Descrição">
        <input type="text" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" placeholder="Preço">
        <input type="text" name="estoque" value="<?= htmlspecialchars($produto['estoque']) ?>" placeholder="Estoque">
        <button type="submit" name="edit_produto">Atualizar</button>
    </form>
    <a href="admin.php">Cancelar</a>
</body>
</html>
