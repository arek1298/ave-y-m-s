
<?php
session_start();

// Verificar si el usuario está logueado y tiene el área correcta
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true  || $_SESSION['area'] !== 'RH') {
    header('Location: login.php'); // Redirigir al login si no está logueado o no tiene el área correcta
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

        <a href="../../destruir.php" class="btn btn-danger">Cerrar Sesión</a>
        <!-- Contenido específico para el área de Recursos Humanos -->
    </div>

    <!-- Bootstrap JS, Popper.js, y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
