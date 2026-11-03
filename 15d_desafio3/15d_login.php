<?php
session_start();

$erro = "";

// Se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_input = trim($_POST['usuario'] ?? '');
    $senha_input   = trim($_POST['senha'] ?? '');
    $cor_fundo     = $_POST['cor_fundo'] ?? '#ffffff';

    if (empty($usuario_input) || empty($senha_input)) {
        $erro = "Por favor, preencha o usuário e a senha.";
    } else {
        // Conexão com o banco de dados 'exercicio'
        $host    = 'localhost';
        $db      = 'exercicio';
        $user    = 'root';
        $pass    = ''; // Altere a senha de acordo com seu ambiente
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);

            // Consulta o usuário no banco de dados
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
            $stmt->execute(['usuario' => $usuario_input]);
            $usuario_db = $stmt->fetch();

            // Verifica se o usuário foi encontrado
            if ($usuario_db) {
                // Suporta tanto senhas criptografadas (password_hash) quanto em texto simples
                $senha_valida = false;
                if (password_verify($senha_input, $usuario_db['senha'])) {
                    $senha_valida = true;
                } elseif ($senha_input === $usuario_db['senha']) {
                    $senha_valida = true;
                }

                if ($senha_valida) {
                    // Login com sucesso: guarda dados na sessão
                    $_SESSION['usuario_logado'] = $usuario_db['usuario'];
                    $_SESSION['cor_fundo']      = $cor_fundo;

                    // Redireciona para o perfil
                    header("Location: 15d_perfil.php");
                    exit;
                } else {
                    $erro = "Usuário ou senha incorretos!";
                }
            } else {
                $erro = "Usuário ou senha incorretos!";
            }

        } catch (PDOException $e) {
            $erro = "Erro de conexão com o banco de dados: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Desafio 3</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .form-container { max-width: 350px; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .campo { margin-bottom: 15px; }
        .campo label { display: block; margin-bottom: 5px; font-weight: bold; }
        .campo input[type="text"], .campo input[type="password"] { width: 100%; padding: 8px; box-sizing: border-box; }
        .erro { color: red; margin-bottom: 15px; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Login</h2>

    <?php if (!empty($erro)): ?>
        <div class="erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" action="15d_login.php">
        <div class="campo">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>
        </div>

        <div class="campo">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>

        <div class="campo">
            <label for="cor_fundo">Cor de Fundo do Perfil:</label>
            <input type="color" id="cor_fundo" name="cor_fundo" value="#e6f2ff">
        </div>

        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>