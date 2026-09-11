<?php
session_start();
$title = "Sobre o Projeto";
require_once "header.php";
?>

<div class="card card-about shadow p-4">

<h1 class="mb-4 text-center">Sobre o Projeto</h1>

<p><strong>Disciplina:</strong> Fundamentos de Programação Web (11100010553_20252_02)</p>
<p><strong>Atividade Somativa 2</strong></p>

<p>
Esta aplicação foi desenvolvida como parte da Avaliação Somativa 2,
com o objetivo de demonstrar a construção de uma aplicação web completa 
<strong>Full-Stack</strong>, utilizando:
</p>

<ul>
    <li>HTML5</li>
    <li>CSS3</li>
    <li>JavaScript</li>
    <li>PHP</li>
    <li>MySQL</li>
    <li>Bootstrap</li>
</ul>

<hr>

<h3 class="mt-4">Orientação da Atividade Somativa</h3>

<p>Vamos verificar como está a sua capacidade para criar uma aplicação web com integração entre front-end e back-end.</p>

<p><strong>Você deve realizar:</strong></p>

<ol>
    <li>
        <strong>Definição da área de negócio:</strong>
        um domínio de aplicação que determine os dados que devem ser armazenados no banco.
    </li>

    <li>
        <strong>Banco de dados MySQL:</strong>
        criar pelo menos duas tabelas com relacionamento 1×N.
    </li>

    <li>
        <strong>Tabela de usuários:</strong>
        armazenar login e senha criptografada.
    </li>

    <li>
        <strong>Login e autenticação:</strong>
        permitir acesso apenas a usuários cadastrados.
    </li>

    <li>
        <strong>Interface (Front-end):</strong>
        HTML + CSS + JS + (opcional) Bootstrap.
    </li>

    <li>
        <strong>CRUD completo (Back-end):</strong>
        Insert, Select, Update e Delete — acessíveis apenas para usuários autenticados.
    </li>

    <li>
        <strong>Vídeo de defesa:</strong>
        até 10 minutos seguindo o roteiro oficial.
    </li>
</ol>

<hr>

<h3 class="mt-4">Roteiro do Vídeo</h3>

<ul>
    <li>Abrir o <strong>index.php</strong> pelo servidor local.</li>
    <li>Explicar o domínio da aplicação.</li>
    <li>Mostrar a estrutura do banco e tabelas no phpMyAdmin.</li>
    <li>Mostrar como a senha é armazenada criptografada.</li>
    <li>Demonstração do login, logout e cadastro de usuários.</li>
    <li>Apresentar o front-end padronizado (menu, rodapé, cores, CSS, Bootstrap).</li>
    <li>Demonstração do CRUD funcionando no navegador.</li>
</ul>

<p class="mt-4">
Este site segue todas as orientações da atividade e demonstra domínio das tecnologias web estudadas.
</p>

</div>

<?php require_once "footer.php"; ?>
