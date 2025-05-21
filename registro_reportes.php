<?php
$conexion = new mysqli("localhost", "root", "", "sistema_prestamos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre = isset($_GET['nombre_completo']) ? $_GET['nombre_completo'] : '';
$semestre = isset($_GET['semestre']) ? $_GET['semestre'] : '';

$sql = "SELECT * FROM prestamos WHERE 1";
if ($nombre !== '') {
    $sql .= " AND nombre_completo LIKE '%" . $conexion->real_escape_string($nombre) . "%'";
}
if ($semestre !== '') {
    $sql .= " AND semestre LIKE '%" . $conexion->real_escape_string($semestre) . "%'";
}

$resultado = $conexion->query($sql);

if ($resultado === false) {
    die("Error en la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Reportes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            padding: 40px;
        }
        h2 {
            text-align: center;
        }
        form {
            background: white;
            padding: 20px;
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        input {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
        }
        input[type="submit"] {
            background: #0a74da;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #084c9e;
        }
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #0a74da;
            color: white;
        }
    </style>
</head>
<body>

<h2>Ver Reportes de Préstamos</h2>

<form method="GET">
    <label for="nombre_completo">Nombre del usuario:</label>
    <input type="text" name="nombre_completo" id="nombre_completo" value="<?php echo htmlspecialchars($nombre); ?>">

    <label for="semestre">Semestre:</label>
    <input type="text" name="semestre" id="semestre" value="<?php echo htmlspecialchars($semestre); ?>">

    <input type="submit" value="Filtrar Reportes">
</form>

<?php if ($resultado->num_rows > 0): ?>
    <table>
        <tr>
            <th>Nombre Completo</th>
            <th>Carrera</th>
            <th>Semestre</th>
            <th>Grupo</th>
            <th>Equipo</th>
            <th>Hora de Préstamo</th>
            <th>Hora de Entrega</th>
            <th>Estado</th>
        </tr>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($fila['nombre_completo']); ?></td>
                <td><?php echo htmlspecialchars($fila['carrera']); ?></td>
                <td><?php echo htmlspecialchars($fila['semestre']); ?></td>
                <td><?php echo htmlspecialchars($fila['grupo']); ?></td>
                <td><?php echo htmlspecialchars($fila['equipo']); ?></td>
                <td><?php echo htmlspecialchars($fila['hora_prestamo']); ?></td>
                <td><?php echo htmlspecialchars($fila['hora_entrega']); ?></td>
                <td><?php echo htmlspecialchars($fila['estado']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p style="text-align:center;">No se encontraron reportes con los filtros aplicados.</p>
<?php endif; ?>

<?php $conexion->close(); ?>

</body>
</html>
