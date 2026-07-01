<?php
require_once("../config/auth.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/config.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <title>Inicio</title>
</head>

<body>
    <?php include("../includes/header.php"); ?>
    <div class="ruta">
        <b>Inicio</b>
    </div>

    <main>
        <a href="admin_notices.php" class="card" title="click para ingresar">
            <h4>Comunicados y Noticias</h4>
            <i class="fi fi-rr-megaphone-sound-waves"></i>
            <h5>Gestionar noticias y avisos diarios para los residentes.</h5>
        </a>

        <a href="admin_users.php" class="card" title="click para ingresar">
            <h4>Usuarios</h4>
            <i class="fi fi-rr-users-alt"></i>
            <h5>Crear, editar y verificar estados de los usuarios</h5>
        </a>

        <a href="admin_units.php" class="card" title="click para ingresar">
            <h4>Residencias</h4>
            <i class="fi fi-rr-person-shelter"></i>
            <h5>Crear, editar y administrar residencias.</h5>
        </a>

        <a href="admin_notices.php" class="card" title="click para ingresar">
            <h4>Vistas</h4>
            <i class="fi fi-rr-family"></i>
            <h5>Gestionar y visualizar visitas diarias.</h5>
        </a>
        <a href="admin_notices.php" class="card" title="click para ingresar">
            <h4>Personal de Seguridad</h4>
            <i class="fi fi-rr-user-police"></i>
            <h5>Crear, editar y administrar personal de seguridad.</h5>
        </a>
        <a href="admin_notices.php" class="card" title="click para ingresar">
            <h4>Control Vehicular</h4>
            <i class="fi fi-rr-car-side"></i>
            <h5>Visualizar todo vehículo que entre y salga.</h5>
        </a>
        <a href="admin_notices.php" class="card" title="click para ingresar">
            <h4>Auditoria del Sistema</h4>
            <i class="fi fi-rr-audit"></i>
            <h5>Visualizar logs de acciones realizadas por los usuarios.</h5>
        </a>
        <a href="admin_notices.php" class="card" title="click para ingresar">
            <h4>Reportes</h4>
            <i class="fi fi-rr-stats"></i>
            <h5>Visualizar todos los reportes posibles.</h5>
        </a>
        <a href="admin_notices.php" class="card" title="click para ingresar">
            <h4>Configuración</h4>
            <i class="fi fi-rr-customize"></i>
            <h5>Crear, editar y administrar perfil del sistema.</h5>
        </a>
    </main>

    <?php include("../includes/footer.php"); ?>

</body>

</html>