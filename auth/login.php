<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $login = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$login, $login]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password_hash"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["is_admin"] = $user["is_admin"];
        $_SESSION["username"] = $user["username"];
        header("Location: ../mensagens/list.php");
        exit;
    }

    $_SESSION["error"] = "Usuário ou senha incorretos.";
    header("Location: ../login_form.php");
    exit;
}
