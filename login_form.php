<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<nav class="menu">
  <ul>
    <li><a href="index.php">Página Inicial</a></li>
    <li><a href="register_form.php">Registrar</a></li>
  </ul>
</nav>

<main>
<form action="auth/login.php" method="POST">
    <h2>Login</h2>

    <?php if (isset($_SESSION["error"])): ?>
        <p class="erro"><?= $_SESSION["error"]; unset($_SESSION["error"]); ?></p>
    <?php endif; ?>

    <label>Usuário ou Email</label>
    <input type="text" name="username" required>

    <label>Senha</label>
    <input type="password" name="password" required>

    <button type="submit">Entrar</button>
</form>
</main>

</body>
</html>
