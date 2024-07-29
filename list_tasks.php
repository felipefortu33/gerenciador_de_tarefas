<?php
include 'db_connect.php';

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["deadline"] . "</td>";
        echo "<td>" . $row["priority"] . "</td>";
        echo "<td>" . $row["completed"] . "</td>";
        echo "<td class='options'>";
        echo "<a href='edit_task.php?id=" . $row["id"] . "'>Editar</a>";
        echo "<a href='delete_task.php?id=" . $row["id"] . "'>Excluir</a>";
        echo "</td>";
        echo "</tr>";
    }
}else {
    echo "<tr><td colspan='6'>Nenhum registro encontrado</td></tr>";

}
$conn->close();