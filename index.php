<?php 
session_start(); 
$title = "Início - App Mensagens";
require_once "header.php";
?>

<div class="text-center">

    <h1 class="mb-4">Bem-vindo ao Sistema de Mensagens</h1>

    <p class="lead">
        Este sistema foi desenvolvido para demonstrar uma aplicação Full-Stack com Login e CRUD.
    </p>

    <div class="mt-5">
        <a href="/MeuSite/mensagens/list.php" class="btn btn-primary btn-lg">
            Acessar Sistema de Mensagens
        </a>
    </div>

</div>

<?php require_once "footer.php"; ?>
