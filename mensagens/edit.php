<?php
session_start();
if (!isset($_SESSION["user_id"])) { 
    header("Location: ../login_form.php"); 
    exit; 
}

require_once "../auth/db.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID inválido.");
}

// admin pode editar tudo
if (!empty($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1) {
    $stmt = $pdo->prepare("SELECT * FROM mensagens WHERE id = ?");
    $stmt->execute([$id]);
} else {
    // usuário comum só edita o que é dele
    $stmt = $pdo->prepare("SELECT * FROM mensagens WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $_SESSION["user_id"]]);
}

$m = $stmt->fetch();

if (!$m) {
    die("Mensagem não encontrada.");
}

$title = "Editar Mensagem";
require_once "../header.php";
?>

<div class="container mt-4">
    <h2>Editar Mensagem</h2>

    <?php if (isset($_SESSION["error"])): ?>
        <div class="alert alert-danger"><?= $_SESSION["error"]; unset($_SESSION["error"]); ?></div>
    <?php endif; ?>

    <form action="" method="POST">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input class="form-control" type="text" name="nome"
                   maxlength="50"
                   value="<?= htmlspecialchars($m['nome']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email"
                   maxlength="80"
                   value="<?= htmlspecialchars($m['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input class="form-control" type="text" name="telefone"
                   maxlength="11"
                   value="<?= htmlspecialchars($m['telefone']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mensagem</label>
            <textarea class="form-control" name="mensagem"
                      maxlength="500"
                      required><?= htmlspecialchars($m['mensagem']) ?></textarea>
        </div>

        <button class="btn btn-primary" type="submit">Salvar Alterações</button>
        <a href="list.php" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

<?php require_once "../footer.php"; ?>

<?php
// processar post
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $mensagem = trim($_POST["mensagem"]);
    $telefone = preg_replace('/\D/', '', $_POST["telefone"]);

    // limites
    if (strlen($nome) > 50) {
        $_SESSION["error"] = "O nome deve ter no máximo 50 caracteres.";
        header("Location: edit.php?id=".$id);
        exit;
    }

    if (strlen($email) > 80) {
        $_SESSION["error"] = "O email deve ter no máximo 80 caracteres.";
        header("Location: edit.php?id=".$id);
        exit;
    }

    if (strlen($mensagem) > 500) {
        $_SESSION["error"] = "A mensagem deve ter no máximo 500 caracteres.";
        header("Location: edit.php?id=".$id);
        exit;
    }

    if (strlen($telefone) !== 11) {
        $_SESSION["error"] = "Telefone inválido. Use exatamente 11 números.";
        header("Location: edit.php?id=".$id);
        exit;
    }

    // update
    if (!empty($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1) {

        $stmt = $pdo->prepare("
            UPDATE mensagens 
            SET nome=?, email=?, telefone=?, mensagem=?
            WHERE id=?
        ");
        $stmt->execute([$nome, $email, $telefone, $mensagem, $id]);

    } else {

        $stmt = $pdo->prepare("
            UPDATE mensagens 
            SET nome=?, email=?, telefone=?, mensagem=?
            WHERE id=? AND user_id=?
        ");
        $stmt->execute([$nome, $email, $telefone, $mensagem, $id, $_SESSION["user_id"]]);
    }

    header("Location: list.php");
    exit;
}
?>
