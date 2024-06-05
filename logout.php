<?php
session_start(); // Inicia a sessão. Necessário para acessar as variáveis de sessão.

session_unset(); // Remove todas as variáveis de sessão. Limpa os dados armazenados na sessão.

session_destroy(); // Destroi a sessão. O usuário é deslogado.

setcookie('remember_token', '', time() - 3600, '/'); // Exclui o cookie de "lembrar-me" ao definir seu tempo de vida para uma hora no passado.

header("Location: login_cliente.php"); // Redireciona o usuário para a página de login do cliente após o logout.
exit; // Garante que o script pare de ser executado após o redirecionamento.
?>
