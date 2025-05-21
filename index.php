<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "sistema_prestamos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener todos los nombres de usuario
$sql = "SELECT usuario FROM usuarios";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilo_ini.css">
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <form action="validar_login.php" method="POST">
            <label for="usuario">Usuario:</label>
            <select name="usuario" required>
                <option value="" disabled selected>Seleccione un usuario</option>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['usuario']) . "'>" . htmlspecialchars($row['usuario']) . "</option>";
                    }
                } else {
                    echo "<option disabled>No hay usuarios</option>";
                }
                ?>
            </select>

            <label for="contrasena">Contraseña:</label>
            <div class="password-container">
            <input type="password" name="contrasena" id="contrasena" required>
            <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>


            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("contrasena");
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>

<?php
$conexion->close();
?>
