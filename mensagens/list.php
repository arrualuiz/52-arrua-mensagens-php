<?php
session_start();
if (!isset($_SESSION["user_id"])) { header("Location: ../login_form.php"); exit; }

require_once "../auth/db.php";

$stmt = $pdo->prepare("SELECT * FROM mensagens WHERE user_id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$lista = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Mensagens</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<nav class="menu">
    <ul>
        <li><a href="../index.php">Página Inicial</a></li>
        <li><a href="create.php">Nova Mensagem</a></li>
        <li><a href="../auth/logout.php">Sair</a></li>
    </ul>
</nav>

<main>
<h1>Mensagens:</h1>

<table border="1" width="100%">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Mensagem</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($lista as $m): ?>
    <tr>
        <td><?= htmlspecialchars($m["nome"]) ?></td>
        <td><?= $m["email"] ?></td>
        <td><?= $m["telefone"] ?></td>
        <td><?= $m["mensagem"] ?></td>
        <td>
            <a href="edit.php?id=<?= $m["id"] ?>">Editar</a>
            |
            <a href="delete.php?id=<?= $m["id"] ?>" onclick="return confirm('Excluir?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</main>

</body>
</html>
