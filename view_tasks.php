<?php
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

// Obtener las tareas
$sql = "SELECT id, description, due_date, additional_notes, created_at FROM tareas ORDER BY due_date ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas Pendientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card-body {
            min-height: 150px; /* Ajusta la altura mínima de las tarjetas según tus necesidades */
        }
        .card-title {
            font-size: 1.25rem;
        }
        .card-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <?php include 'nav.php';?>
    <div class="container mt-5">
        <h2>Lista de Tareas Pendientes</h2>
        
        <!-- Botón para generar PDF -->
        <div class="mb-4">
            <a href="generate_pdf.php" class="btn btn-primary">Generar PDF</a>
            <a href="welcome.php" class="btn btn-danger">Volver atrás</a>
        </div>
        
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card shadow-sm">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">Tarea #' . $row["id"] . '</h5>';
                    echo '<p><strong>Descripción:</strong> ' . htmlspecialchars($row["description"]) . '</p>';
                    echo '<p><strong>Fecha Límite:</strong> ' . htmlspecialchars($row["due_date"]) . '</p>';
                    echo '<p class="card-text"><strong>Notas Adicionales:</strong> ' . htmlspecialchars($row["additional_notes"]) . '</p>';
                    echo '<p><small><strong>Fecha de Creación:</strong> ' . htmlspecialchars($row["created_at"]) . '</small></p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12"><div class="alert alert-info">No hay tareas disponibles.</div></div>';
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
