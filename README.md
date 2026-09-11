# Arrua Mensagens

Projeto acadêmico desenvolvido para a disciplina de Tecnologias para Desenvolvimento Web (11100010566_20261_21) na PUC-PR.

Este sistema foi criado como parte do contexto das atividades somativas da disciplina e consiste em uma aplicação web de gestão de mensagens com cadastro de usuários, autenticação e CRUD, desenvolvida em PHP com MySQL e Bootstrap.

## Visão geral

Este projeto foi criado como uma aplicação full-stack simples para demonstrar:

- autenticação de usuários;
- cadastro e login;
- criação, leitura, edição e exclusão de mensagens;
- uso de banco de dados relacional;
- front-end com HTML, CSS, JavaScript e Bootstrap;
- separação entre páginas públicas e páginas protegidas.

O projeto foi pensado como uma aplicação acadêmica e também funciona como base para um MVP de sistema de mensagens.

Este repositório representa a entrega de uma atividade de desenvolvimento web aplicada, seguindo o contexto de aprendizagem da disciplina de Tecnologias para Desenvolvimento Web, incluindo a criação de sistemas com interface, regras de negócio, autenticação e persistência em banco de dados.

## Tecnologias utilizadas

- PHP 8+
- MySQL / MariaDB
- HTML5
- CSS3
- JavaScript
- Bootstrap 5
- PDO para conexão com banco

## Estrutura do projeto

```text
MeuSite/
├─ about.php
├─ header.php
├─ footer.php
├─ index.php
├─ login_form.php
├─ register_form.php
├─ auth/
│  ├─ db.php
│  ├─ login.php
│  ├─ logout.php
│  └─ register.php
├─ css/
│  └─ style.css
├─ js/
│  └─ form.js
├─ mensagens/
│  ├─ create.php
│  ├─ delete.php
│  ├─ edit.php
│  └─ list.php
├─ sql/
│  └─ schema.sql
├─ README.md
└─ .gitignore
```

## Funções do sistema

### 1. Página inicial
A página principal, em [index.php](index.php), funciona como landing page do sistema e apresenta a proposta do projeto.

### 2. Cadastro de usuários
O cadastro é realizado em [register_form.php](register_form.php) e processado em [auth/register.php](auth/register.php).

Funções:

- valida se os campos foram preenchidos;
- valida tamanho mínimo da senha;
- verifica se usuário ou email já existem;
- cria o hash da senha com `password_hash()`;
- salva o usuário no banco.

### 3. Login de usuários
O login é executado em [login_form.php](login_form.php) e tratado em [auth/login.php](auth/login.php).

Funções:

- busca usuário por username ou e-mail;
- compara a senha digitada com o hash salvo no banco usando `password_verify()`;
- cria sessão com `$_SESSION["user_id"]`, `$_SESSION["username"]` e `$_SESSION["is_admin"]`;
- redireciona para a área de mensagens.

### 4. Logout
O logout é feito em [auth/logout.php](auth/logout.php).

Funções:

- destrói a sessão atual;
- redireciona para a tela de login.

### 5. CRUD de mensagens
As operações de mensagens ficam na pasta [mensagens/](mensagens/):

- [mensagens/create.php](mensagens/create.php): cria nova mensagem;
- [mensagens/list.php](mensagens/list.php): lista mensagens;
- [mensagens/edit.php](mensagens/edit.php): edita mensagem existente;
- [mensagens/delete.php](mensagens/delete.php): exclui mensagem.

Regras importantes:

- usuários comuns só acessam suas próprias mensagens;
- administradores podem visualizar todas as mensagens;
- ações são controladas por sessão e por verificação de `user_id`.

### 6. Autorização por perfil
A navegação e permissões são controladas em [header.php](header.php):

- usuários não autenticados só veem login e cadastro;
- usuários autenticados veem o menu de mensagens e logout;
- administradores têm acesso extra ao histórico completo.

## Banco de dados

A estrutura do banco está em [sql/schema.sql](sql/schema.sql).

As tabelas principais são:

- `users`
  - id
  - username
  - email
  - password_hash
  - created_at

- `mensagens`
  - id
  - user_id
  - nome
  - email
  - telefone
  - mensagem
  - created_at

A relação entre as tabelas é 1:N, onde cada usuário pode ter várias mensagens.

## Como executar o projeto

### Opção 1: XAMPP / WAMP

1. Instale o XAMPP ou WAMP.
2. Coloque a pasta do projeto dentro da pasta `htdocs` do XAMPP.
3. Inicie o Apache e o MySQL.
4. Crie o banco conforme o arquivo [sql/schema.sql](sql/schema.sql).
5. Acesse no navegador:

```text
http://localhost/MeuSite
```

### Opção 2: PHP embutido

No terminal, execute:

```bash
cd "c:\Users\arruadev\OneDrive\03-PUCPR\MeuSite"
php -S localhost:8000
```

Depois acesse:

```text
http://localhost:8000
```

## Segurança e revisão de credenciais

### Revisão do repositório
Foi verificado que o projeto não possui chaves de API, tokens JWT, chaves de acesso externas ou segredos de autenticação de terceiros.

No entanto, o arquivo [auth/db.php](auth/db.php) contém configurações locais do banco de dados em texto puro:

```php
$host = "127.0.0.1";
$db   = "app_contatos";
$user = "root";
$pass = "";
```

Isso não é uma "chave secreta" no sentido de API, mas é um dado sensível de infraestrutura e deve ser tratado com cuidado.

### Recomendação importante para Git
Antes de subir para um repositório público:

- não commitar credenciais reais do banco;
- mover as configurações para variáveis de ambiente ou arquivo `.env` fora do controle de versão;
- garantir que `.env`, `.env.*` e arquivos locais de configuração sejam ignorados pelo Git.

## Observações de segurança do código

O sistema já usa algumas boas práticas, como:

- `password_hash()` para salvar senhas;
- `password_verify()` para validar;
- controle de acesso por sessão;
- validação de entradas principais.

Mas ainda há melhorias recomendadas para produção:

- usar arquivo `.env` para dados de banco;
- validar e sanitizar entradas com maior rigor;
- evitar expor mensagens de erro internas em produção;
- usar HTTPS em ambiente real;
- bloquear acesso direto a arquivos sensíveis;
- revisar permissões de usuários e regras de admin.

## Contexto acadêmico

Este projeto foi desenvolvido no âmbito da disciplina:

- Tecnologias Para Desenvolvimento Web (11100010566_20261_21)

O material acadêmico da disciplina envolveu fundamentos de desenvolvimento web, lógica de aplicação, interface, autenticação, banco de dados e entrega de atividade prática. A aplicação aqui apresentada corresponde a um exercício de implementação web com foco em desenvolvimento full-stack básico.

## Conclusão

Este projeto funciona como um sistema simples de mensagens com autenticação e CRUD, com lógica de backend em PHP e dados em MySQL. Ele atende bem ao objetivo de demonstrar aplicação web completa com front-end e back-end integrados.

Para subir em GitHub de forma segura, a principal atenção deve ser a remoção de configurações locais do banco e o uso de variáveis de ambiente em vez de valores fixos no código.
