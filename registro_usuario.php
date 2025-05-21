<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"]);
    $contrasena = password_hash(trim($_POST["contrasena"]), PASSWORD_DEFAULT);
    $tipo_usuario = $_POST["tipo_usuario"];

    $conexion = new mysqli("localhost", "root", "", "sistema_prestamos");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, contrasena, tipo_usuario) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $contrasena, $tipo_usuario);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Usuario registrado correctamente'); window.location='registro_usuario.php';</script>";
    } else {
        echo "<script>alert('❌ Error al registrar: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conexion->close();
}

// Eliminar registro
if (isset($_GET['eliminar_id'])) {
    $id_eliminar = $_GET['eliminar_id'];
    $conexion = new mysqli("localhost", "root", "", "sistema_prestamos");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id_eliminar);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Usuario eliminado correctamente'); window.location='registro_usuario.php';</script>";
    } else {
        echo "<script>alert('❌ Error al eliminar: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f3;
            padding: 40px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            max-width: 350px;
            margin: 0 auto 20px auto;
        }

        h2 {    
            text-align: center;
            margin-bottom: 10px;
        }

        input, select, button {
            display: block;
            width: 90%;
            margin-bottom: 10px;
            padding: 10px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color:rgb(9, 93, 172);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color:rgb(7, 91, 194);
        }

        button {
            background-color: #f57c00;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e65100;
        }

        table {
            width: 60%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color:rgb(7, 89, 165);
            color: white;
        }

        .eliminar {
            color: red;
            cursor: pointer;
        }

        .eliminar:hover {
            color: #c00;
        }
    </style>
</head>
<body>
    <form action="registro_usuario.php" method="POST">
        <h2>Registrar Nuevo Usuario</h2>
        <input type="text" name="usuario" placeholder="Nombre de usuario" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <select name="tipo_usuario" required>
            <option value="" disabled selected>Seleccione tipo de usuario</option>
            <option value="Administrador">Administrador</option>
            <option value="Auxiliar">Auxiliar</option>
        </select>
        <input type="submit" value="✅ Registrar Usuario">
        <button type="button" onclick="window.location.href='menu.php'">🔙 Regresar al Menú Principal</button>
    </form>

    <?php
    // Mostrar usuarios registrados
    $conexion = new mysqli("localhost", "root", "", "sistema_prestamos");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $resultado = $conexion->query("SELECT id, usuario, tipo_usuario FROM usuarios");

    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Usuario</th><th>Tipo de Usuario</th><th>Eliminar</th></tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id"] . "</td>";
            echo "<td>" . $fila["usuario"] . "</td>";
            echo "<td>" . $fila["tipo_usuario"] . "</td>";
            echo "<td><a href='registro_usuario.php?eliminar_id=" . $fila["id"] . "' class='eliminar'>🗑️</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No hay usuarios registrados.</p>";
    }

    $conexion->close();
    ?>
</body>
</html>
