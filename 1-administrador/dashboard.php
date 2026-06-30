<?php
require_once("../config/verificar_sesion.php");
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
    <?php include("../includes/header.php"); ?>
    <div class="ruta">
        <b>Inicio</b>
    </div>

    <main>
        <a href="admin_notices.php" class="card" title="click para ingresar">
            <h4>Comunicados y Noticias</h4>
            <i class="bi bi-megaphone"></i>
            <h5>Crear, editar y administrar avisos para residentes.</h5>
            <i class="bi bi-box-arrow-in-right"></i>
        </a>

        <a href="admin_users.php" class="card" title="click para ingresar">
            <h4>Usuarios</h4>
            <i class="bi bi-people"></i>
            <h5>Crear, editar y administrar usuarios.</h5>
            <i class="bi bi-box-arrow-in-right"></i>
        </a>

        <a href="admin_units.php" class="card" title="click para ingresar">
            <h4>Residencias</h4>
            <i class="bi bi-houses"></i>
            <h5>Crear, editar y administrar residencias.</h5>
            <i class="bi bi-box-arrow-in-right"></i>
        </a>
    </main>

    <?php include("../includes/footer.php"); ?>

</body>

</html>