<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_task'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        
        $sql = "INSERT INTO tasks (user_id, title, description, priority) VALUES ('$user_id', '$title', '$description', '$priority')";
        $conn->query($sql);
    }
}

$sql = "SELECT * FROM tasks WHERE user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Minhas Tarefas</h2>
        <a href="logout.php" class="btn btn-danger">Sair</a>
        
        <h3 class="mt-4">Adicionar Nova Tarefa</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Prioridade</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="baixa">Baixa</option>
                    <option value="média">Média</option>
                    <option value="alta">Alta</option>
                </select>
            </div>
            <button type="submit" name="add_task" class="btn btn-primary">Adicionar Tarefa</button>
        </form>

        <h3 class="mt-5">Tarefas Pendentes</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Prioridade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo ucfirst($row['priority']); ?></td>
                    <td>
                        <!-- Botões de editar e excluir -->
                        <a href="edit_task.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
