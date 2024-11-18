<?php
include 'db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO tasks (titulo, descricao, user_id) VALUES (:titulo, :descricao, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['titulo' => $titulo, 'descricao' => $descricao, 'user_id' => $user_id]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Tarefa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Adicionar Nova Tarefa</h2>
    <form action="" method="POST">
        <input type="text" name="titulo" class="form-control" placeholder="Título" required>
        <textarea name="descricao" class="form-control" placeholder="Descrição" required></textarea>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
</body>
</html>
