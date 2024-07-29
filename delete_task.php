<?php
include('db_connect.php');

$id = $_GET['id'];
$sql = "DELETE FROM tasks WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location:index.php');
}else{
    echo "Error ao remover a tarefa: " . $conn->error;
}

$conn->close();
