<?php
session_start(); // Iniciar la sesión

// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'aveymas');

if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

$error = ''; // Inicializar la variable de error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = $_POST['password'];

        // Consultar el usuario
        $sql = "SELECT id, password, area FROM users WHERE username = ?";
        $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $mysqli->error);
        }

        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $storedPassword, $area);
            $stmt->fetch();

            // Verificar la contraseña
            if ($password === $storedPassword) {
                // Contraseña correcta, iniciar sesión
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['area'] = $area; // Guardar el área en la sesión

                // Redirigir a la página según el área
                if ($area === 'RH') {
                    header('Location: modulos/RH/rh_dashboard.php');
                } elseif ($area === 'Ventas') {
                    header('Location: ventas_dashboard.php');
                } elseif ($area === 'it') {
                    header('Location: it_dashboard.php');
                } else {
                    header('Location: default_dashboard.php');
                }
                exit; // Asegúrate de que el script se detenga después de redirigir
            } else {
                $error = 'Nombre de usuario o contraseña incorrectos.';
            }
        } else {
            $error = 'Nombre de usuario o contraseña incorrectos.';
        }

        $stmt->close();
    } else {
        $error = 'Por favor, complete todos los campos.';
    }
}

$mysqli->close();
?>