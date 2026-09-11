<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: mensagens/list.php");
    exit;
}

$title = "Login";
require_once "header.php";
?>

<div class="card shadow p-4" style="max-width: 450px; margin: auto;">

    <h2 class="mb-3 text-center">Login</h2>

    <?php if (isset($_SESSION["error"])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION["error"]; ?>
        </div>
    <?php unset($_SESSION["error"]); endif; ?>

    <form action="auth/login.php" method="POST">

        <label class="form-label">Usuário ou Email</label>
        <input class="form-control mb-3" type="text" name="username" required>

        <label class="form-label">Senha</label>
        <input class="form-control mb-3" type="password" name="password" required>

        <button class="btn btn-primary w-100">Entrar</button>

        <p class="mt-3 text-center">
            Não tem conta?
            <a href="register_form.php">Registrar</a>
        </p>
    </form>

</div>

<?php require_once "footer.php"; ?>
