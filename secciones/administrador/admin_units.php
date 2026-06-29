<?php
require_once("../../config/verificar_sesion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Inicio</title>
</head>

<body>
    <header>
        <div class="logoNombre">
            <img src="../../img/logo.png" alt="">
            <h3>Rivera del Oeste - Se Conecta</h3>
        </div>
        <div class="acciones">
            <div class="alert">
                <i class="bi bi-bell"></i>
                <h6>0</h6>
            </div>
            <div class="foto">
                <i class="bi bi-person-circle"></i>
            </div>
            <div class="nombre">
                <h4>Bienvenido: <?php echo $_SESSION['user_user']; ?></h4>
            </div>
            <a href="../../config/logout.php" class="sesion">
                <i class="bi bi-power"></i>
                <h6>Cerrar Sesión</h6>
            </a>
        </div>
    </header>
    <div class="ruta">
        <a href="dashboard.php">Inicio</a>
        <p>/</p>
        <b>Gestión de Residencias</b>
    </div>
    <main></main>

    <footer>
        <span>
            <i class="bi bi-shield-check"></i>
            <h5>Por su seguridad, cierre sesión al finalizar y no comparta sus credenciales.</h5>
        </span>
        <h6>&copy; 2026 William Abrego en cooperación con la administración de Rivera del Oeste -
            <p>Se Connecta</p>
        </h6>
    </footer>

</body>

</html>