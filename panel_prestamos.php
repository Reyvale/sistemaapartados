<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: menu.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Préstamos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?></h2>
    <a href="registro_prestamo.php">Registrar Nuevo Préstamo</a><br><br>

    <h3>Listado de Préstamos</h3>

    <?php
    include('conexion.php');

    $sql = "SELECT * FROM prestamos";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Semestre</th>
                    <th>Grupo</th>
                    <th>Hora Préstamo</th>
                    <th>Hora Entrega</th>
                    <th>Estado</th>
                </tr>";
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['nombre_completo']}</td>
                    <td>{$row['carrera']}</td>
                    <td>{$row['semestre']}</td>
                    <td>{$row['grupo']}</td>
                    <td>{$row['hora_prestamo']}</td>
                    <td>{$row['hora_entrega']}</td>
                    <td>{$row['estado']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No hay préstamos registrados.";
    }
    ?>
</body>
</html>
