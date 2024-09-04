<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está logueado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php'); // Redirigir al login si no está logueado
    exit;
}

// Obtener el nombre del usuario de la sesión
$username = $_SESSION['username'];
$area = $_SESSION['area'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .navbar-custom {
            background-color: #000; /* Negro puro */
        }
    </style>
</head>
<body>
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <img src="images/logo.png" style="width: 15%;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container mt-5">
        <h2>Agenda de Tareas Pendientes</h2>
        <form action="process_task.php" method="post">
            <div class="mb-3">
                <label for="taskDescription" class="form-label">Descripción de la Tarea</label>
                <textarea class="form-control" id="taskDescription" name="taskDescription" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="dueDate" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="dueDate" name="dueDate" required>
            </div>
            <div class="mb-3">
                <label for="additionalNotes" class="form-label">Notas Adicionales</label>
                <textarea class="form-control" id="additionalNotes" name="additionalNotes" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Tarea</button>
            <a href="view_tasks.php" class="btn btn-success">Ver regístros</a>
            <a href="destruir.php" class="btn btn-danger">Cerrar Sesión</a>
            <?php $username = $_SESSION['username'];
?>
        
        </form>
    </div>
</div>

    <!-- Bootstrap JS, Popper.js, y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>