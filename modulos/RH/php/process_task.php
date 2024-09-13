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
    $area_id = $_POST['area_id']; 
    $persona_id = $_POST['persona_id']; 
    $dueDate = $_POST['dueDate'];
    $additionalNotes = $_POST['additionalNotes'];

    
    $archivo = $_FILES['archivo'];
    $archivo_nombre = $archivo['name'];
    $archivo_tmp = $archivo['tmp_name'];
    $archivo_error = $archivo['error'];

    
    if ($archivo_error === 0) {
        $archivo_destino = 'files/' . $archivo_nombre; 
        move_uploaded_file($archivo_tmp, $archivo_destino); 
    } else {
        $archivo_destino = null; 
    }

    
    $sql = "INSERT INTO tareas (description, area_id, persona_id, archivo, due_date, additional_notes) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("siisss", $taskDescription, $area_id, $persona_id, $archivo_destino, $dueDate, $additionalNotes);


    if ($stmt->execute()) { 
        header("Location: ../view_tasks.php"); 
        exit();
    } else {
        echo "Error al guardar la tarea: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
