<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="logoNombre">
            <img src="../img/logo.png" alt="">
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
            <a href="../config/logout.php" class="sesion">
                <i class="bi bi-power"></i>
                <h6>Cerrar Sesión</h6>
            </a>
        </div>
    </header>
</body>

</html>