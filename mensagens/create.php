<?php
session_start();
if (!isset($_SESSION["user_id"])) { header("Location: ../login_form.php"); exit; }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Nova Mensagem</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<nav class="menu">
  <ul>
    <li><a href="list.php">Voltar</a></li>
  </ul>
</nav>

<main>
<form action="create.php" method="POST">
    <h2>Criar Mensagem</h2>

    <label>Nome</label>
    <input type="text" name="nome" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Telefone</label>
    <input type="text" name="telefone">

    <label>Mensagem</label>
    <textarea name="mensagem" required></textarea>

    <button type="submit">Salvar</button>
</form>
</main>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once "../auth/db.php";

    $stmt = $pdo->prepare(
        "INSERT INTO mensagens (user_id, nome, email, telefone, mensagem)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->execute([
        $_SESSION["user_id"],
        $_POST["nome"],
        $_POST["email"],
        $_POST["telefone"],
        $_POST["mensagem"]
    ]);

    header("Location: list.php");
    exit;
}
?>
