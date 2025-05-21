<?php
session_start();

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "sistema_prestamos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$usuario = trim($_POST['usuario']);
$contrasena = trim($_POST['contrasena']);

// Consulta preparada para evitar inyecciones 
$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();

    // Verificar contraseña cifrada
    if (password_verify($contrasena, $fila['contrasena'])) {
    $_SESSION['usuario'] = $fila['usuario'];
    $_SESSION['tipo_usuario'] = $fila['tipo_usuario'];
    header("Location: menu.php");
    exit();
} else {
    echo "<script>alert('Contraseña incorrecta'); window.location='index.php';</script>";
}

} else {
    echo "<script>alert('Usuario no encontrado'); window.location='index.php';</script>";
}

$stmt->close();
$conexion->close();
?>
