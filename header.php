<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "App Mensagens" ?></title>

    <!-- bootstrap -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- tema do site -->
    <link rel="stylesheet" href="/MeuSite/css/style.css">
    <link rel="icon" type="image/png" href="/MeuSite/la.png">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark" 
     style="background: rgba(11,23,36,0.8); backdrop-filter: blur(6px);">
  <div class="container">

    <a class="navbar-brand fw-bold" href="/MeuSite/index.php">Arrua Mensagens</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav ms-auto">

        <li class="nav-item"><a class="nav-link" href="/MeuSite/index.php">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="/MeuSite/about.php">Sobre</a></li>

        <?php if (!isset($_SESSION["user_id"])): ?>

            <li class="nav-item"><a class="nav-link" href="/MeuSite/login_form.php">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="/MeuSite/register_form.php">Registrar</a></li>

        <?php else: ?>

            <li class="nav-item"><a class="nav-link" href="/MeuSite/mensagens/list.php">Mensagens</a></li>

            <?php if (!empty($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/MeuSite/mensagens/list.php?all=1">Histórico Completo</a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link text-danger" href="/MeuSite/auth/logout.php">Sair</a>
            </li>

        <?php endif; ?>

      </ul>

    </div>
  </div>
</nav>

<main class="container py-4">
