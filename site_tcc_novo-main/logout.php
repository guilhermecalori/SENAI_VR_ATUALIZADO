<?php
session_start();

// Destrói todas as variáveis de sessão
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Se a requisição for feita via AJAX/Fetch, retorna instrução de redirecionamento em JS
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    echo "<script>window.top.location.href = 'login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Saindo...</title>
    <script>
        // Força o navegador principal a ir para a tela de login zerada (fora do layout)
        window.top.location.href = 'login.php';
    </script>
</head>
<body>
    <script>
        window.top.location.href = 'login.php';
    </script>
</body>
</html>