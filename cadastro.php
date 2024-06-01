<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se todos os campos estão preenchidos
    if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Por favor, preencha todos os campos.";
    } else {
        // Se todos os campos estiverem preenchidos, prossegue com o cadastro
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $remember = isset($_POST['remember']) ? $_POST['remember'] : false;

        try {
            $stmt = $pdo->prepare("INSERT INTO clientes (nome, email, username, password) VALUES (:nome, :email, :username, :password)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            
            // Se a opção de lembrar senha estiver marcada, define um cookie
            if ($remember) {
                $token = uniqid();
                setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/');
                // Salva o token no banco de dados para futura verificação, se necessário
                // Lembre-se de criar uma coluna na tabela clientes para armazenar o token
                $stmt = $pdo->prepare("UPDATE clientes SET remember_token = :token WHERE username = :username");
                $stmt->bindParam(':token', $token);
                $stmt->bindParam(':username', $username);
                $stmt->execute();
            }
            
            // Redireciona após o cadastro
            header("Location: login_cliente.php");
            exit;
        } catch (PDOException $e) {
            echo 'Erro ao cadastrar: ' . $e->getMessage();
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
        <div id="formCadastro">
            <h2>Cadastro de Cliente</h2>
            <?php if (isset($error)) { ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php } ?>
            <form action="cadastro.php" method="post">
                <input type="text" name="nome" placeholder="Nome completo">
                <input type="email" name="email" placeholder="E-mail">
                <input type="text" name="username" placeholder="Nome de usuário">
                <input type="password" name="password" placeholder="Senha">
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
    <div><a class="next-button" href="login.php">página login</a>
    <a href="pginicial.html" class="next-button"> página inicial</a>
</div>
    <footer>
        <div>
            <span>.</span>
            <div>
                <h2>Florentine</h2>
            </div>
        </div>
        <div class="content-footer">
            <div>
                <a href="contato.php">Contato</a>
                <a href="">Localização</a>
            </div>
            <div>
                <h4>Produtos</h4>
                <a href="">Arranjos florais</a>
                <a href="">Plantas e suculentas</a>
                <a href="">Presentes e acessorios</a>
                <a href="">Decoração para eventos</a>
            </div>
            <div id="sociais">
                <img src="img/telegram_footer.png" alt="Telegram">
                <img src="img/wpp_footer.png" alt="WhatsApp">
                <img src="img/instagran_footer.png" alt="Instagram">
            </div>
        </div>
    </footer>
</body>

</html>
