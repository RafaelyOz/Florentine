<?php
session_start();
require_once 'conexao.php';

// Verificar se o usuário está logado
if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? $_POST['remember'] : false;


    if (empty($username) || empty($password)) {
        $error = "Todos os campos são obrigatórios.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM clientes WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;

                // Se a opção de lembrar senha estiver marcada, define um cookie
                if ($remember) {
                    $token = bin2hex(random_bytes(16)); // Gera um token seguro
                    setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/');
                    // Salva o token no banco de dados para futura verificação, se necessário
                    $stmt = $pdo->prepare("UPDATE clientes SET remember_token = :token WHERE username = :username");
                    $stmt->bindParam(':token', $token);
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();
                }

                // Redireciona após o login para a página inicial do usuário
                header("Location: welcome.php");
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
    <title>Login</title>
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
        <div id="formLogin">
            <h2>Login de Cliente</h2>
            <?php if (isset($error)) { ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php } ?>
            <form action="" method="post">
                <input type="text" name="username" placeholder="Nome de usuário">
                <input type="password" name="password" placeholder="Senha">
                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Lembrar senha</label>
                </div>
                <button type="submit">Entrar</button>
                <a href="cadastro.php">Cadastre-se</a>
            </form>
        </div>
    </div>
    <div><a class="next-button" href="login.php"> página login</a>
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