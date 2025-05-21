<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_completo = $_POST['nombre_completo'];
    $carrera = $_POST['carrera'];
    $semestre = $_POST['semestre'];
    $grupo = $_POST['grupo'];
    $hora_prestamo = $_POST['hora_prestamo'];
    $hora_entrega = $_POST['hora_entrega'];

    $sql = "INSERT INTO prestamos (nombre_completo, carrera, semestre, grupo, hora_prestamo, hora_entrega, estado) 
            VALUES ('$nombre_completo', '$carrera', '$semestre', '$grupo','$hora_prestamo', '$hora_entrega', 'pendiente')";

    if ($conexion->query($sql) === TRUE) {
        echo "Préstamo registrado exitosamente.";
        echo "<br><a href='panel_prestamos.php'>Volver al Panel</a>";
    } else {
        echo "Error al registrar el préstamo: " . $conexion->error;
    }
}
?>
