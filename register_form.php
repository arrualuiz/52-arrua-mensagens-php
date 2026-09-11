<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: mensagens/list.php");
    exit;
}

$title = "Registrar Conta";
require_once "header.php";
?>
 
<div class="card shadow p-4" style="max-width: 450px; margin: auto;">

    <h2 class="mb-3 text-center">Criar Conta</h2>

    <!-- erro -->
    <?php if (isset($_SESSION["error"])): ?>
        <div class="alert alert-danger text-center">
            <?= $_SESSION["error"]; ?>
        </div>
    <?php unset($_SESSION["error"]); endif; ?>

    <!-- sucesso -->
    <?php if (isset($_SESSION["success"])): ?>
        <div class="alert alert-success text-center">
            <?= $_SESSION["success"]; ?>
        </div>

        <script>
            setTimeout(() => {
                window.location.href = "login_form.php";
            }, 2000);
        </script>

    <?php unset($_SESSION["success"]); endif; ?>

    <!-- formulario -->
    <form action="auth/register.php" method="POST">

        <label class="form-label">Usuário</label>
        <input class="form-control mb-3" type="text" name="username" required>

        <label class="form-label">Email</label>
        <input class="form-control mb-3" type="email" name="email" required>

        <label class="form-label">Senha</label>
        <input class="form-control mb-3" type="password" name="password" required>

        <button class="btn btn-success w-100">Criar Conta</button>

        <p class="mt-3 text-center">
            Já possui conta?
            <a href="login_form.php">Entrar</a>
        </p>

    </form>
</div>

<?php require_once "footer.php"; ?>
