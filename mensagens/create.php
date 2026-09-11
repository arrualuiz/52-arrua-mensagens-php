<?php
session_start();
if (!isset($_SESSION["user_id"])) { 
    header("Location: ../login_form.php"); 
    exit; 
}

$title = "Nova Mensagem";
require_once "../header.php";
?>

<div class="container mt-4">
    <h2>Criar Mensagem</h2>

    <?php if (isset($_SESSION["error"])): ?>
        <div class="alert alert-danger"><?= $_SESSION["error"]; unset($_SESSION["error"]); ?></div>
    <?php endif; ?>

    <form action="" method="POST">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input class="form-control" type="text" name="nome" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input class="form-control" type="text" name="telefone" maxlength="11" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mensagem</label>
            <textarea class="form-control" name="mensagem" maxlength="500" required></textarea>
        </div>

        <button class="btn btn-success" type="submit">Salvar</button>
        <a class="btn btn-secondary" href="list.php">Voltar</a>
    </form>
</div>

<?php require_once "../footer.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once "../auth/db.php";

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $mensagem = trim($_POST["mensagem"]);

    // validações
    if (strlen($nome) > 50) {
        $_SESSION["error"] = "O nome deve ter no máximo 50 caracteres.";
        header("Location: create.php");
        exit;
    }

    if (strlen($email) > 80) {
        $_SESSION["error"] = "O email deve ter no máximo 80 caracteres.";
        header("Location: create.php");
        exit;
    }

    if (strlen($mensagem) > 500) {
        $_SESSION["error"] = "A mensagem deve ter no máximo 500 caracteres.";
        header("Location: create.php");
        exit;
    }

    // telefone
    $telefone = preg_replace('/\D/', '', $_POST["telefone"]);

    if (strlen($telefone) !== 11) {
        $_SESSION["error"] = "Telefone inválido. Use exatamente 11 números.";
        header("Location: create.php");
        exit;
    }

    // salvar no bd
    $stmt = $pdo->prepare("
        INSERT INTO mensagens (user_id, nome, email, telefone, mensagem)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $_SESSION["user_id"],
        $nome,
        $email,
        $telefone,
        $mensagem
    ]);

    header("Location: list.php");
    exit;
}
?>
