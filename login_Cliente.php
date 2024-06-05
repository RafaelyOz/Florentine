<?php
session_start(); // Inicia a sessão
require_once 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Verifica se o usuário já está logado
if (isset($_SESSION['username'])) {
    header("Location: welcome.php"); // Redireciona para a página de boas-vindas se já estiver logado
    exit;
}

// Processa o formulário de login quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Obtém o nome de usuário do formulário
    $password = $_POST['password']; // Obtém a senha do formulário
    $remember = isset($_POST['remember']) ? $_POST['remember'] : false; // Verifica se a opção de "lembrar senha" foi marcada

    // Verifica se os campos de usuário e senha estão preenchidos
    if (empty($username) || empty($password)) {
        $error = "Todos os campos são obrigatórios.";
    } else {
        try {
            // Prepara a consulta SQL para buscar o usuário no banco de dados
            $stmt = $pdo->prepare("SELECT * FROM clientes WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Busca o usuário

            // Verifica se o usuário existe e se a senha está correta
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username; // Armazena o nome de usuário na sessão

                // Se a opção de "lembrar senha" estiver marcada, define um cookie
                if ($remember) {
                    $token = bin2hex(random_bytes(16)); // Gera um token seguro
                    setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/'); // Define o cookie
                    // Salva o token no banco de dados para futura verificação
                    $stmt = $pdo->prepare("UPDATE clientes SET remember_token = :token
                     WHERE username = :username");
                    $stmt->bindParam(':token', $token);
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();
                }

                // Redireciona após o login para a página inicial do usuário
                header("Location: welcome.php");
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
    <title>Login</title>
    <link rel="stylesheet" href="./index.css"> <!-- Link para o arquivo de estilos CSS -->
</head>

<body>
    <!-- Cabeçalho do site -->
    <header>
        <div> <!-- Links para contato e produtos -->
            <a href="contato.html">Contatos</a>
            <a href="#">Produtos</a>
        </div>
        <div> <!-- Link para a página inicial com o nome da loja -->
            <a href="index.html">
                <h2>Florentine</h2>
            </a>
        </div>
        <div> <!-- Ícones de notificações, sacola e perfil -->
            <img src="img/coracao.png" alt="Notificações">
            <img src="img/sacola.png" alt="Sacola">
            <a class="profile-link" href="login.php">
                <img src="img/pessoa.png" alt="Perfil">
            </a>
        </div>
    </header>

    <!-- Container de login -->
    <div class="login-container">
        <div id="formLogin">
            <h2>Login de Cliente</h2>
            <!-- Exibe mensagem de erro se houver -->
            <?php if (isset($error)) { ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php } ?>
            <form action="" method="post"> <!-- Formulário de login -->
                <input type="text" name="username" placeholder="Nome de usuário"> <!-- Campo para nome de usuário -->
                <input type="password" name="password" placeholder="Senha"> <!-- Campo para senha -->
                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Lembrar senha</label>
                </div>
                <button type="submit">Entrar</button> <!-- Botão de enviar -->
                <a href="cadastro.php">Cadastre-se</a> <!-- Link para página de cadastro -->
            </form>
        </div>
    </div>
    
    <div>
        <a class="next-button" href="login.php">Página login</a>
        <a href="pginicial.html" class="next-button">Página inicial</a>
    </div>

    <!-- Rodapé do site -->
    <footer>
        <div>
            <span>.</span>
            <div>
                <h2>Florentine</h2>
            </div>
        </div>
        <div class="content-footer"> <!-- Links de navegação no rodapé -->
            <div>
                <a href="contato.php">Contato</a>
                <a href="">Localização</a>
            </div>
            <div>
                <h4>Produtos</h4>
                <a href="">Arranjos florais</a>
                <a href="">Plantas e suculentas</a>
                <a href="">Presentes e acessórios</a>
                <a href="">Decoração para eventos</a>
            </div>
            <div id="sociais"> <!-- Links para redes sociais -->
                <img src="img/telegram_footer.png" alt="Telegram">
                <img src="img/wpp_footer.png" alt="WhatsApp">
                <img src="img/instagran_footer.png" alt="Instagram">
            </div>
        </div>
    </footer>
</body>
</html>
