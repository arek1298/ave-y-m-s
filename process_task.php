<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root"; // Cambia esto según tu configuración
$password = ""; // Cambia esto según tu configuración
$dbname = "aveymas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskDescription = $_POST['taskDescription'];
    $dueDate = $_POST['dueDate'];
    $additionalNotes = $_POST['additionalNotes'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO tareas (description, due_date, additional_notes) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Enlazar parámetros
    $stmt->bind_param("sss", $taskDescription, $dueDate, $additionalNotes);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: view_tasks.php"); // Redirigir a la página que muestra las tareas
        exit();
    } else {
        echo "Error al guardar la tarea: " . $stmt->error;
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
}

$conn->close();
?>
