<?php
session_start();

// Verificar se o atendente não está logado
if (!isset($_SESSION['username'])) {
    header("Location: login_atendente.php");
    exit;
}

// Lógica específica de administração aqui
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <!-- Inclua seus estilos CSS aqui -->
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Aqui está o seu painel de administração.</p>
    <!-- Adicione mais conteúdo específico de administração conforme necessário -->
    <a href="pginicial.html">Sair</a>
</body>
</html>
