<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Início - App Mensagens</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="la.png">
</head>

<body>
  <nav class="menu">
    <ul>
        <li><a href="index.php">Página Inicial</a></li>
        <li><a href="about.php">Sobre</a></li>
        <?php if (!isset($_SESSION["user_id"])): ?>
            <li><a href="login_form.php">Login</a></li>
            <li><a href="register_form.php">Registrar</a></li>
        <?php else: ?>
            <li><a href="mensagens/list.php">Mensagens</a></li>
            <li><a href="auth/logout.php">Sair</a></li>
        <?php endif; ?>
    </ul>
  </nav>

  <main>
    <h1>Bem-vindo ao Sistema de Mensagens</h1>
    <h2>Este sistema foi desenvolvido para demonstrar uma aplicação Full-Stack com Login e CRUD.</h2>
    <br>
    <br>
    <h3>Acesse o <a href="mensagens.php">Sistema de Mensagens</a> para visualizar e gerenciar os registros.</h3>
  </main>

  <footer>
      <p class="assinatura">Desenvolvido por <span class="nome-assinatura">Arrua</span> 🚀</p>
  </footer>

</body>
</html>