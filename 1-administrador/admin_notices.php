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
        <a href="dashboard.php">Inicio</a>
        <p>/</p>
        <b>Gestión de Comunicados y Noticias</b>
    </div>
    <main></main>

    <?php include("../includes/footer.php"); ?>
</body>

</html>