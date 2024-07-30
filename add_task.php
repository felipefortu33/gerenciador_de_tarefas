<?php
global $conn;
include 'db_connect.php';
include 'send_email.php';

$title = $_POST['title'];
$description = $_POST['description'];
$deadline = !empty($_POST['deadline']) ? $_POST['deadline'] : NULL;
$priority = $_POST['priority'];
$completed = isset($_POST['completed']) ? 1 : 0;
$emailReminder = isset($_POST['email_reminder']) ? 1 : 0;

// Preparar a consulta com parâmetros
$query = "INSERT INTO tasks (title, description, deadline, priority, completed, email_reminder) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssii", $title, $description, $deadline, $priority, $completed, $emailReminder);

if ($stmt->execute()) {
    if ($emailReminder) {
        $to = 'felipefortu33@outlook.com'; // Substitua pelo e-mail do destinatário
        $subject = 'Lembrete de Tarefa: ' . $title;
        $body = 'Você tem uma nova tarefa: ' . $title . '<br>' .
            'Descrição: ' . $description . '<br>' .
            'Prazo: ' . $deadline . '<br>' .
            'Prioridade: ' . $priority;

        sendReminderEmail($to, $subject, $body);
    }

    header("Location: index.php");
} else {
    echo "Erro ao inserir tarefa: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
