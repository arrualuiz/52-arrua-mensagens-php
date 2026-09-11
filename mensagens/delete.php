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

// admin pode apagar tudo
if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1) {

    $stmt = $pdo->prepare("DELETE FROM mensagens WHERE id = ?");
    $stmt->execute([$id]);

} else {

    // usuário normal só apaga o que é dele
    $stmt = $pdo->prepare("DELETE FROM mensagens WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $_SESSION["user_id"]]);

}

header("Location: list.php");
exit;
