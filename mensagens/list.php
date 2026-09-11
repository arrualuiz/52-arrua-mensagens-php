<?php
session_start();
if (!isset($_SESSION["user_id"])) { header("Location: ../login_form.php"); exit; }

require_once "../auth/db.php";

// admin vê todas as mensagens
$mostrar_tudo = isset($_GET["all"]) && ($_SESSION["is_admin"] == 1);

if ($mostrar_tudo) {

    // admin
    $stmt = $pdo->query("SELECT mensagens.*, users.username 
                         FROM mensagens 
                         JOIN users ON mensagens.user_id = users.id
                         ORDER BY created_at DESC");

} else {

    // usuário comum
    $stmt = $pdo->prepare("SELECT mensagens.*, users.username 
                           FROM mensagens 
                           JOIN users ON mensagens.user_id = users.id
                           WHERE mensagens.user_id = ?
                           ORDER BY created_at DESC");
    $stmt->execute([$_SESSION["user_id"]]);
}

$lista = $stmt->fetchAll();

$title = "Minhas Mensagens";
require_once "../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $mostrar_tudo ? "Todas as Mensagens" : "Minhas Mensagens" ?></h2>

    <div>
        <a href="create.php" class="btn btn-success me-2">Nova Mensagem</a>

        <?php if ($_SESSION["is_admin"] == 1): ?>
            <a href="list.php?all=1" class="btn btn-primary">Ver Tudo</a>
        <?php endif; ?>
    </div>
</div>

<div class="table-responsive">
<table class="table table-dark table-striped table-bordered align-middle">
    <thead class="table-primary text-dark">
        <tr>
            <?php if ($mostrar_tudo): ?>
            <th>Usuário</th>
            <?php endif; ?>

            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Mensagem</th>
            <th width="160">Ações</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($lista as $m): ?>
        <tr>
            <?php if ($mostrar_tudo): ?>
            <td><?= htmlspecialchars($m["username"]) ?></td>
            <?php endif; ?>

            <td><?= htmlspecialchars($m["nome"]) ?></td>
            <td><?= htmlspecialchars($m["email"]) ?></td>
            <td><?= htmlspecialchars($m["telefone"]) ?></td>
            <td><?= nl2br(htmlspecialchars($m["mensagem"])) ?></td>

            <td>
                <a class="btn btn-warning btn-sm w-100 mb-1"
                   href="edit.php?id=<?= $m["id"] ?>">
                   Editar
                </a>

                <a class="btn btn-danger btn-sm w-100"
                   href="delete.php?id=<?= $m["id"] ?>"
                   onclick="return confirm('Tem certeza que deseja excluir?')">
                   Excluir
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php require_once "../footer.php"; ?>
