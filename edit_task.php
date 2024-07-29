<?php
global $conn;
include 'db_connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de tarefa não fornecido.";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM tasks WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $task = $result->fetch_assoc();
} else {
    echo "Tarefa não encontrada";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];
    $completed = isset($_POST['completed']) ? 1 : 0;
    $email_reminder = isset($_POST['email_reminder']) ? 1 : 0;

    $sql = "UPDATE tasks SET title='$title', description='$description', deadline='$deadline', priority='$priority', completed=$completed, email_reminder=$email_reminder WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro ao atualizar a tarefa: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
</head>
<body>
<div class="container">
    <h1>Editar Tarefa</h1>
    <form action="edit_task.php?id=<?php echo $task['id']; ?>" method="POST">
        <label for="title">Tarefa:</label>
        <input type="text" id="title" name="title" value="<?php echo $task['title']; ?>" required>

        <label for="description">Descrição (Opcional):</label>
        <textarea id="description" name="description"><?php echo $task['description']; ?></textarea>

        <label for="deadline">Prazo (Opcional):</label>
        <input type="date" id="deadline" name="deadline" value="<?php echo $task['deadline']; ?>">

        <label>Prioridade:</label>
        <div class="priority">
            <input type="radio" id="low" name="priority" value="Baixa" <?php if ($task['priority'] == 'Baixa') echo 'checked'; ?>>
            <label for="low">Baixa</label>
            <input type="radio" id="medium" name="priority" value="Média" <?php if ($task['priority'] == 'Média') echo 'checked'; ?>>
            <label for="medium">Média</label>
            <input type="radio" id="high" name="priority" value="Alta" <?php if ($task['priority'] == 'Alta') echo 'checked'; ?>>
            <label for="high">Alta</label>
        </div>

        <div class="checkbox">
            <input type="checkbox" id="completed" name="completed" <?php if ($task['completed']) echo 'checked'; ?>>
            <label for="completed">Tarefa concluída</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="email_reminder" name="email_reminder" <?php if ($task['email_reminder']) echo 'checked'; ?>>
            <label for="email_reminder">Lembrete por e-mail</label>
        </div>

        <button type="submit">Salvar</button>
    </form>
</div>
</body>
</html>




