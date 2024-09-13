<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aveymas";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el área seleccionada
$area_id = isset($_GET['area_id']) ? $conn->real_escape_string($_GET['area_id']) : '';

if (!empty($area_id)) {
    // Consulta para obtener las personas del área seleccionada
    $sql = "SELECT id, nombre FROM users WHERE area = '$area_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generar opciones para el combo de personas
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
        }
    } else {
        echo '<option value="">No hay personas disponibles</option>';
    }
} else {
    echo '<option value="">Seleccionar Persona</option>';
}

$conn->close();
?>
