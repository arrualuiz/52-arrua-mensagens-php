<?php
session_start();
if (!isset($_SESSION["user_id"])) { header("Location: ../login_form.php"); exit; }

require_once "../auth/db.php";

$id = $_GET["id"];

$stmt = $pdo->prepare("DELETE FROM mensagens WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION["user_id"]]);

header("Location: list.php");
exit;
