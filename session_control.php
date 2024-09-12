<?php
session_start();

//TIEMPO DE INACTIVIDAD
$tiempo_inactivo = 60; //segundos

//validar si existe sessión activa
if (isset($_SESSION['loggedin'])) {
    //ULTIMO ACCESO REGISTRADO VALIDAR
    if(isset($_SESSION['ultimo_acceso'])){

        //CALCULO DE TIEMPO INACTIVO
        $inactividad = time() - $_SESSION['ultimo_acceso'];

        //SI LA INACTIVIDAD SUPERA LO ESTABLECIDO
        if($inactividad >$tiempo_inactivo) {
            //DESTRUYE SU SESIÓN Y REDIRIGE A INDEX
            session_unset();
            session_destroy();
            header('Location: index.php?mensaje=sesion_caducada');
            exit();
        }
    }
}
?>