<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!$username || !$email || strlen($password) < 3) {
        $_SESSION["error"] = "Preencha tudo. Senha deve ter no mínimo 3 caracteres.";
        header("Location: ../register_form.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);

    if ($stmt->fetch()) {
        $_SESSION["error"] = "Usuário ou email já existe.";
        header("Location: ../register_form.php");
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?,?,?)");
    $stmt->execute([$username, $email, $hash]);

    $_SESSION["success"] = "Cadastro realizado com sucesso.";
    header("Location: ../login_form.php");
    exit;
}
