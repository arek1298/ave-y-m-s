
<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true  || $_SESSION['area'] !== 'RH') {
    header('Location: login.php'); 
    exit;
}

$username= $_SESSION['username'];
#$nombre = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard de Recursos Humanos</title>
</head>
<body>
    <?php include '../nav.php'; ?>
    <div class="container mt-5">
        <h1>Bienvenido, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Área: Recursos Humanos</p>
        <div class="container mt-5">
        <h2>Asignar Plan </h2>
        <form action="php/process_task.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="taskDescription" class="form-label">Descripción de la Tarea</label>
                <textarea class="form-control" id="taskDescription" name="taskDescription" rows="3" required></textarea>
            </div>

<?php $host = 'localhost';
$db = 'aveymas';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}


#$query = "SELECT id, area FROM area";
$query ="SELECT DISTINCT area FROM users";

$result = $mysqli->query($query);
?>




<!-- COMBO PARA PERSONAS -->
<label for="area-select">Seleccionar Área:</label>
<select id="area-select" name="area_id" onchange="cargarPersonasPorArea(this.value)" class="form-control">
    <option value="">Seleccionar Área</option>
    <?php 
    if ($result->num_rows > 0) {
        // Utilizamos un while para recorrer cada fila del resultado
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['area'] . '">' . $row['area'] . '</option>';
        }
    } else {
        echo '<option value="">No hay áreas disponibles</option>';
    }
    ?>
</select><br>
        <?php
// Cerrar la conexión
$mysqli->close();
?>

        <!-- Combo de personas -->
<label for="personaId">Asignar a:</label>
<select id="personaId" name="persona_id" class="form-control">
    <option value="">Seleccionar Persona</option>
</select><br>
<br>
<div class="mb-3">
  <label for="formFile" class="form-label">Subir archivo *pdf,word,excel,imágen</label>
  <input class="form-control" type="file" id="archivo" name="archivo" enctype="multipart/form-data">
</div>
            <div class="mb-3">
                <label for="dueDate" class="form-label">Fecha límite</label>
                <input type="date" class="form-control" id="dueDate" name="dueDate" required>
            </div>
            <div class="mb-3">
                <label for="additionalNotes" class="form-label">Notas Adicionales</label>
                <textarea class="form-control" id="additionalNotes" name="additionalNotes" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Tarea</button>
            <a href="view_tasks.php" class="btn btn-success">Ver regístros</a>
            <a href="../../destruir.php" class="btn btn-danger">Cerrar Sesión</a>
  
</div>
</div>

    </div>

    <!-- Bootstrap JS, Popper.js, y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script>
       
function cargarPersonasPorArea(areaId) {
    if (areaId !== "") {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "php/personas.php?area_id=" + encodeURIComponent(areaId), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("personaId").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    } else {
        document.getElementById("personaId").innerHTML = '<option value="">Seleccionar Persona</option>';
    }
}
</script>
   
</body>
</html>
