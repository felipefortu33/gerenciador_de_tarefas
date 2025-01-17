<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Gerenciador de Tarefas</h1>
    <form id="taskForm" action="add_task.php"method="POST">
        <label for="title">Tarefa:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Descrição (Opcional):</label>
        <textarea id="description" name="description"></textarea>

        <label for="deadline">Prazo (Opcional):</label>
        <input type="date" id="deadline" name="deadline">

        <label>Prioridade:</label>
        <div class="priority">
            <input type="radio" id="low" name="priority" value="Baixa" checked>
            <label for="low">Baixa</label>
            <input type="radio" id="medium" name="priority" value="Média">
            <label for="medium">Média</label>
            <input type="radio" id="high" name="priority" value="Alta">
            <label for="high">Alta</label>
        </div>

        <div class="checkbox">
            <input type="checkbox" id="completed" name="completed">
            <label for="completed">Tarefa concluída</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="email_reminder" name="email_reminder">
            <label for="email_reminder"> Lembrete por e-mail</label>
        </div>

        <button type="submit">Cadastrar</button>
    </form>
    <table>
        <thead>
        <tr>
            <th>Tarefa</th>
            <th>Descrição</th>
            <th>Prazo</th>
            <th>Prioridade</th>
            <th>Concluída</th>
            <th>Opções</th>
        </tr>
        </thead>
        <tbody id="taskList">
        <?php include 'list_tasks.php'; ?>
        </tbody>
    </table>
</div>
</body>
</html>