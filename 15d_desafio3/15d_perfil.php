<?php
session_start();

// Verificação de segurança: se não houver usuário logado na sessão, vai para o login
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: 15d_login.php");
    exit;
}

$usuario   = $_SESSION['usuario_logado'];
$cor_fundo = $_SESSION['cor_fundo'] ?? '#ffffff';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= htmlspecialchars($usuario) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: <?= htmlspecialchars($cor_fundo) ?>;
            margin: 0;
            padding: 40px;
            transition: background-color 0.3s ease;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .btn-sair {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-sair:hover {
            background-color: #bd2130;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Bem-vindo, <?= htmlspecialchars($usuario) ?>! 👋</h1>
    <p>Esta é a sua página de perfil personalizada com a cor que escolheu no login.</p>
    
    <a href="15d_logout.php" class="btn-sair">Sair do Sistema</a>
</div>

</body>
</html>