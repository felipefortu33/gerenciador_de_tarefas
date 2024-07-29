<?php

global $conn;
include 'db_connection.php';

$title = $_POST['title'];
$description = $_POST['description'];
$deadline = $_POST['deadline'];
$priority = $_POST['priority'];
$completed = isset($POST['completed']) ? 1 : 0;
$email_reminder = isset($POST['email_reminder']) ? 1 : 0;

$sql = "INSERT INTO tasks (title, description, deadline, priority, completed, email_reminder)
VALUES ('$title', '$description', '$deadline', '$priority', '$completed', '$email_reminder')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: index.php');