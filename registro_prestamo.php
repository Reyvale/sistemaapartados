<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo_usuario'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Préstamo</title>
    <link rel="stylesheet" href="registro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
    <div class="registro-container">
        <h2><i class="fas fa-laptop"></i> Registro de Préstamo de Equipo</h2>

        <form action="procesar_prestamo.php" method="POST" class="formulario">
            <label for="nombre_completo">Nombre completo:</label>
            <input type="text" id="nombre_completo" name="nombre_completo" required>

            <label for="carrera">Carrera:</label>
            <input type="text" id="carrera" name="carrera" required>

            <label for="semestre">Semestre:</label>
            <input type="text" id="semestre" name="semestre" required>

            <label for="grupo">Grupo:</label>
            <input type="text" id="grupo" name="grupo" required>

            <label for="hora_prestamo">Hora de préstamo:</label>
            <input type="time" id="hora_prestamo" name="hora_prestamo" required>

            <label for="hora_entrega">Hora de entrega:</label>
            <input type="time" id="hora_entrega" name="hora_entrega" required>

            <input type="submit" value="Guardar Préstamo">
        </form>
    </div>
</body>
</html>
