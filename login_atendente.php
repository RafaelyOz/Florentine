<?php
session_start();
require_once 'conexao.php'; // Certifique-se de incluir o arquivo de conexão ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Todos os campos são obrigatórios.";
    }else{
    try {
        $stmt = $pdo->prepare("SELECT * FROM atendentes WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $atendente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($atendente) {
            $_SESSION['username'] = $username;

            // Redireciona após o login para a tela de administração
            header("Location: admin.php");
            exit;
        } else {
            $error = "Usuário ou senha incorretos.";
        }
    } catch (PDOException $e) {
        echo 'Erro ao realizar login: ' . $e->getMessage();
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
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header>
        <div>
            <a href="contato.html">Contatos</a>
            <a href="#">Produtos</a>
        </div>
        <div>
            <a href="pginicial.html">
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
