<?php
session_start();
if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo_usuario'])) {
   header("Location: index.php");
    exit();
}
$usuario = $_SESSION['usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="menu-container">
        <h2>Bienvenido al Sistema de Préstamo</h2>
        <p><strong>Usuario:</strong> <?php echo htmlspecialchars($usuario); ?></p>
        <p><strong>Rol:</strong> <?php echo htmlspecialchars($tipo_usuario); ?></p>

        <div class="card-container">
            <a href="registro_reportes.php" class="card">
    <i class="fas fa-chart-bar"></i>
    <span>Ver Reportes</span>
    </a>
    <a href="registro_prestamo.php" class="card">
    <i class="fas fa-plus-circle"></i>
    <span>Registrar Préstamo</span>
    </a>

     <?php if ($tipo_usuario === 'Administrador'): ?>
     <a href="devolver_equipo.php" class="card">
        <i class="fas fa-undo"></i>
        <span>Devolver Equipo</span>
     </a>
     <a href="registro_usuario.php" class="card">
        <i class="fas fa-users-cog"></i>
        <span>Administrar Usuarios</span>
     </a>
     <?php endif; ?>


            <a href="cerrar_sesion.php" class="card salir">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar Sesión</span>
            </a>
        </div>
    </div>
</body>
</html>
