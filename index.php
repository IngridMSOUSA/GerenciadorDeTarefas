<?php
include 'db_config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tasks WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$tarefas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Suas Tarefas</h2>
    <a href="add_task.php" class="btn btn-primary">Nova Tarefa</a>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?= htmlspecialchars($tarefa['titulo']) ?></td>
                    <td><?= htmlspecialchars($tarefa['descricao']) ?></td>
                    <td><?= htmlspecialchars($tarefa['status']) ?></td>
                    <td>
                        <a href="edit_task.php?id=<?= $tarefa['task_id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="delete_task.php?id=<?= $tarefa['task_id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
