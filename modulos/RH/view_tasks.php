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
$sql = "SELECT id, description, area_id, persona_id, archivo, due_date, additional_notes, created_at FROM tareas ORDER BY due_date ASC";
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
    <?php include '../nav.php'; ?>
    <div class="container mt-5">
        <h2>Lista de Tareas Pendientes</h2>
        
        <!-- Botón para generar PDF -->
        <div class="mb-4">
            <a href="generate_pdf.php" class="btn btn-primary">Generar PDF</a>
            <a href="rh_dashboard.php" class="btn btn-danger">Volver atrás</a>
        </div>
        
        <div class="container mt-5">
            <h2>Lista de Tareas</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Área</th>
                        <th>Persona</th>
                        <th>Archivo</th>
                        <th>Fecha Límite</th>
                        <th>Notas Adicionales</th>
                        <th>Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $archivoUrl = 'files/' . htmlspecialchars($row["archivo"]); // Ajusta la ruta según tu estructura de archivos
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row["id"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["description"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["area_id"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["persona_id"]) . '</td>';
                            echo '<td><a href="#" data-bs-toggle="modal" data-bs-target="#fileModal" data-file="' . $archivoUrl . '">Ver Archivo</a></td>';
                            echo '<td>' . htmlspecialchars($row["due_date"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["additional_notes"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["created_at"]) . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="8" class="text-center">No hay tareas disponibles.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para visualizar el archivo -->
        <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fileModalLabel">Visualizar Archivo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id="fileFrame" src="" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS, Popper.js, y jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

        <script>
            // Script para actualizar el src del iframe en el modal
            var fileModal = document.getElementById('fileModal');
            fileModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var fileUrl = button.getAttribute('data-file');
                var fileFrame = document.getElementById('fileFrame');
                fileFrame.src = fileUrl;
            });
        </script>
    </div>
</body>
</html>

<?php
$conn->close();
?>
