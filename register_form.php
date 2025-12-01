<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="la.png">
</head>

<nav class="menu">
    <ul>
        <li><a href="/site/index.php">Página Inicial</a></li>

        <?php if (!isset($_SESSION["user_id"])): ?>
            <li><a href="/site/login_form.php">Login</a></li>
            <li><a href="/site/register_form.php">Registrar</a></li>
        <?php else: ?>
            <li><a href="/site/mensagens/list.php">Mensagens</a></li>
            <li><a href="/site/auth/logout.php">Sair</a></li>
        <?php endif; ?>
    </ul>
</nav>

<main>
<form action="auth/register.php" method="POST">
    <h2>Registrar</h2>

    <?php if (isset($_SESSION["error"])): ?>
        <p class="erro"><?= $_SESSION["error"]; unset($_SESSION["error"]); ?></p>
    <?php endif; ?>

    <label>Usuário</label>
    <input type="text" name="username" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Senha</label>
    <input type="password" name="password" required>

    <button type="submit">Criar Conta</button>
</form>
</main>

</body>
</html>
