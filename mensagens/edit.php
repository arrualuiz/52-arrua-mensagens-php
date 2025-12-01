<?php
session_start();
if (!isset($_SESSION["user_id"])) { header("Location: ../login_form.php"); exit; }

require_once "../auth/db.php";

$id = $_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM mensagens WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION["user_id"]]);
$m = $stmt->fetch();

if (!$m) { die("Mensagem não encontrada."); }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Mensagem</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<nav class="menu">
  <ul>
    <li><a href="list.php">Voltar</a></li>
  </ul>
</nav>

<main>

<form action="edit.php?id=<?= $id ?>" method="POST">
    <h2>Editar Mensagem</h2>

    <label>Nome</label>
    <input type="text" name="nome" value="<?= $m['nome'] ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= $m['email'] ?>" required>

    <label>Telefone</label>
    <input type="text" name="telefone" value="<?= $m['telefone'] ?>">

    <label>Mensagem</label>
    <textarea name="mensagem" required><?= $m['mensagem'] ?></textarea>

    <button type="submit">Salvar Alterações</button>
</form>

</main>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("
        UPDATE mensagens SET nome=?, email=?, telefone=?, mensagem=?
        WHERE id=? AND user_id=?
    ");

    $stmt->execute([
        $_POST["nome"],
        $_POST["email"],
        $_POST["telefone"],
        $_POST["mensagem"],
        $id,
        $_SESSION["user_id"]
    ]);

    header("Location: list.php");
    exit;
}
?>
