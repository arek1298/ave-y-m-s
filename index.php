<?php
session_start(); 
#include 'session_control.php';

$mysqli = new mysqli('localhost', 'root', '', 'aveymas');

if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

$error = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = $_POST['password'];

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

          
            if ($password === $storedPassword) {
               
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                #$_SESSION['nombre'] = $nombre
                $_SESSION['area'] = $area; 

                
                if ($area === 'RH') {
                    header('Location: modulos/RH/rh_dashboard.php');
                } elseif ($area === 'Calidad') {
                    header('Location: modulos/CALIDAD/calidad_dashboard.php');
                } elseif ($area === 'produccion') {
                    header('Location: modulos/produccion/produccion_dashboard.php');
                } else {
                    header('Location: vistas/inicio.php');
                }
                exit; 

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio de sesión</title>
    <style>
        body{
            background-color: #1b7da1
        }
        .login-card {
            max-width: 400px;
            margin: auto;
            width: 100%;
        }
        .login-card img {
            max-width: 150%;
            height: auto;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="p-3 m-0">
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card login-card">
            <div class="card-body">
                <h5 class="card-title text-center">Inicio de sesión</h5>
               <center> <img src="images/logo.png" alt="Logo" class="img-fluid"></center>
                <form method="post" action="">
                    <div class="mb-3">
                        <center><label for="user" class="form-label">Usuario</label></center>
                        <input type="text" class="form-control" id="usuername" name="username" placeholder="Introduzca su usuario">
                    </div>
                    <div class="mb-3">
                        <center><label for="pass" class="form-label">Contraseña</label></center>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Introduzca su contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary w-100" id="validarFormulario">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded" , function(){
    document.getElementById("formulario").addEventListener('submit', validarFormulario);
});

function validarFormulario(evento){
    evento.preventDefault();
    var username = document.getElementById('username').value;
    if(usuario.lenght ==0){
        alert('Favor de escribir su usuario');
        retunrn;
    }
    var password = document.getElementById('password').value;
    if (password.lenght < 4) {
        alert('la clave es inválida');
        return;
    }
    this.submit();
}
</script>

    <!-- Mostrar alertas en caso de error -->
    <?php if (!empty($error)): ?>
        <script>
            alert('<?php echo $error; ?>');
        </script>
    <?php endif; ?>

</body>
</html>