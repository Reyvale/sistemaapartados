<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; // Si tiene contraseña, cámbiela aquí
$base_datos = "sistema_prestamos";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
    