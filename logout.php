<?php
session_start();
session_unset();
session_destroy();
setcookie('remember_token', '', time() - 3600, '/'); // Exclui o cookie
header("Location: login_cliente.php");
exit;
?>
