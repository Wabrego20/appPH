<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <div class="logoNombre">
            <img src="../assets/img/logo.png" alt="">
            <h3>Rivera del Oeste - Se Conecta</h3>
        </div>
        <div class="acciones">
            <div class="alert">
                <i class="fi fi-rr-bell"></i>
                <h6>0</h6>
            </div>
            <div class="foto">
                <i class="fi fi-rr-mode-portrait"></i>
            </div>
            <div class="nombre">
                <h4>Bienvenido: <?php echo $_SESSION['user_user']; ?></h4>
            </div>
            <a href="../config/logout.php" class="sesion">
                <i class="fi fi-rr-sign-out-alt"></i>
                <h6>Cerrar Sesión</h6>
            </a>
        </div>
    </header>
</body>

</html>