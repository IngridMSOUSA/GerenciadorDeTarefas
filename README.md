Gerenciador de Tarefas
Este é um sistema básico de gerenciamento de tarefas, desenvolvido com PHP, MySQL e front-end em HTML/CSS/Bootstrap. Ele permite que os usuários se cadastrem, façam login e gerenciem suas tarefas (CRUD de tarefas).

Funcionalidades

Cadastro de Usuário : Os usuários podem criar uma conta com um nome de usuário, senha e email.
Login e Logout : O sistema autentica os usuários e permite logout seguro.
CRUD de Tarefas : Cada usuário pode criar, visualizar, editar e excluir tarefas. Cada tarefa inclui título, descrição, prioridade e status.
Interface Responsiva : Desenvolvido com Bootstrap para facilitar o uso em dispositivos móveis.
Estrutura do Projeto
Diretórios e Arquivos Principais
db.php: Arquivo para conexão com o banco de dados MySQL.
login.php: Página de login que autentica os usuários.
register.php: Página de cadastro para novos usuários.
tasks.php: Página principal de tarefas, onde o usuário pode gerenciar suas tarefas.
logout.php: Página que encerra a sessão do usuário.
edit_task.phpe delete_task.php: Páginas para editar e excluir tarefas.

Banco de Dados
O sistema utiliza um banco de dados MySQL com duas tabelas:

usuários : Armazena informações de login dos usuários.

SQL->

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
);
tarefas : Armazena as tarefas dos usuários.

SQL->

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(100),
    description TEXT,
    status ENUM('pendente', 'concluída') DEFAULT 'pendente',
    priority ENUM('baixa', 'média', 'alta') DEFAULT 'média',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
Pré-requisitos
Servidor Web : PHP instalado (como Apache com suporte a PHP).
Banco de Dados : MySQL ou MariaDB.

Editor de Texto : Recomenda-se o uso do Visual Studio Code para facilitar a edição e organização dos arquivos.

Instalação

Clone o repositório ou faça o download dos arquivos.

bater

git clone https://github.com/seu-usuario/task-manager.git
Importe o banco de dados:

No MySQL, crie o banco de dados e tabelas executando o SQL a seguir:
SQL->

CREATE DATABASE task_manager;
USE task_manager;

-- Tabela de usuários
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- Tabela de tarefas
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(100),
    description TEXT,
    status ENUM('pendente', 'concluída') DEFAULT 'pendente',
    priority ENUM('baixa', 'média', 'alta') DEFAULT 'média',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
Configure uma conexão com o banco de dados:

No arquivo db.php, ajuste as credenciais de conexão para que correspondam ao seu ambiente:

php

<?php
$host = "localhost";
$user = "seu_usuario";
$password = "sua_senha";
$dbname = "task_manager";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>

Inicie o servidor e acesse o sistema:

Coloque os arquivos no diretório do seu servidor web e acesse o aplicativo através do navegador (exemplo: http://localhost/task-manager/).

Funcionamento:

Conecte-se:
Os usuários autenticam-se com username e password.
As senhas são protegidas com hashing (usando password_hashe password_verifysem PHP).

CRUD de Tarefas:

1.Criar : Adicione uma nova tarefa com título, descrição e prioridade.
2.Ler : As tarefas são dedicadas em uma tabela.
3.Atualizar : Editar tarefas existentes.
4.Excluir : Remover tarefas indesejadas.

Sair:
O sistema encerra a sessão do usuário ao clicar em "Logout", redirecionando-o para a página de login.

Segurança:

Hash de senhas : As senhas são armazenadas de forma segura no banco de dados usando password_hash.
Validação de Sessão : As páginas protegidas verificam se o usuário está logado, impedindo acessos não autorizados.
Instruções preparadas : É abafado usar prepared statementspara evitar injeção de SQL.

Implantar:
Para colocar a aplicação online:

Front-End : Serviços como Netlify podem hospedar o front-end (HTML e Bootstrap).
Back-End : Hospede o PHP e o banco de dados em um serviço como o Heroku ou DigitalOcean para funcionalidades completas.

Autor
Desenvolvido por Ingrid Moreira .

Licença
Este projeto é licenciado sob a Licença MIT.
