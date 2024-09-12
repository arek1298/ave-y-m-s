<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "aveymas";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskDescription = $_POST['taskDescription'];
    $persona = $_persona['persona'];
    $dueDate = $_POST['dueDate'];
    $additionalNotes = $_POST['additionalNotes'];


    $sql = "INSERT INTO tareas (description, persona, due_date, additional_notes) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssss", $taskDescription, $persona, $dueDate, $additionalNotes);

    // Ejecutar la consulta
    if ($stmt->execute()) { 
        header("Location: view_tasks.php"); 
        exit();
    } else {
        echo "Error al guardar la tarea: " . $stmt->error;

    $stmt->close();
}
}

$conn->close();
?>
