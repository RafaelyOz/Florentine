<?php
session_start(); // Inicia a sessão
require_once 'conexao.php'; // Inclui o arquivo de conexão ao banco de dados

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Obtém o nome de usuário do formulário
    $password = $_POST['password']; // Obtém a senha do formulário

    // Verifica se os campos de usuário e senha estão preenchidos
    if (empty($username) || empty($password)) {
        $error = "Todos os campos são obrigatórios.";
    } else {
        try {
            // Prepara a consulta SQL para buscar o atendente no banco de dados
            $stmt = $pdo->prepare("SELECT * FROM atendentes WHERE username = :username AND password = :password");
            $stmt->bindParam(':username', $username); // Vincula o parâmetro :username à variável $username
            $stmt->bindParam(':password', $password); // Vincula o parâmetro :password à variável $password
            $stmt->execute(); // Executa a consulta
            $atendente = $stmt->fetch(PDO::FETCH_ASSOC); // Busca o atendente

            // Verifica se o atendente existe e se as credenciais estão corretas
            if ($atendente) {
                $_SESSION['username'] = $username; // Armazena o nome de usuário na sessão

                // Redireciona após o login para a tela de administração
                header("Location: admin.php");
                exit;
            } else {
                $error = "Usuário ou senha incorretos."; // Mensagem de erro para usuário ou senha incorretos
            }
        } catch (PDOException $e) {
            echo 'Erro ao realizar login: ' . $e->getMessage(); // Mensagem de erro em caso de exceção
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <header>
        <div>
            <a href="contato.html">Contatos</a>
            <a href="#">Produtos</a>
        </div>
        <div>
            <a href="index.html">
                <h2>Florentine</h2>
            </a>
        </div>
        <div>
            <img src="img/coracao.png" alt="Notificações">
            <img src="img/sacola.png" alt="Sacola">
            <a class="profile-link" href="login.php">
                <img src="img/pessoa.png" alt="Perfil">
            </a>
        </div>
    </header>
    <div class="login-container">
        <div id="formAtendente">
            <h2>Login Funcionário</h2>
            <?php if (isset($error)) { ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php } ?>
            <form action="" method="post">
                <input type="text" name="username" placeholder="Nome do usuário">
                <input type="password" name="password" placeholder="Senha">
                <button type="submit">Acesso admin</button>
            </form>
        </div>
    </div>
    <div><a class="next-button" href="login.php"> página login</a>
        <a href="pginicial.html" class="next-button"> página inicial</a>
    </div>

</body>

</html>