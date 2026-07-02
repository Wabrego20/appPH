<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/config.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <title>Inicio de Sesión</title>
</head>

<body>
    <main>
        <div class="portada">
            <span>
                <h2>¡Bienvenido a:</h2>
                <h1>Rivera del Oeste!</h1>
                <h4>Un PH conectado, seguro y en comunidad</h4>
            </span>
            <img src="assets/img/logo.png" alt="logo">
            <div class="noticias">
                <h5><i class="fi fi-rr-megaphone-sound-waves"></i>Comunicados y Noticias</h5>
                <h6>Ver todas</h6>
            </div>

        </div>
        
        <form action="config/login.php" method="post" class="login">
            <div class="login--header">
                <i class="fi fi-rr-house-key"></i>
                <h1>Iniciar Sesión</h1>
            </div>
            <h3>Ingresa tus credenciales para acceder al sistema</h3>

            <div class="login--caja">
                <label for="user_user">Usuario</label>
                <div class="datos">
                    <i class="fi fi-rr-user-pen"></i>
                    <input type="text" placeholder="Ingresa tu usuario" name="user_user" id="user_user" autofocus required>
                </div>
            </div>

            <div class="login--caja">
                <label for="user_password">Contraseña</label>
                <div class="datos">
                    <i class="fi fi-rr-user-key"></i>
                    <input type="password" autocomplete="current-password" placeholder="Ingresa tu contraseña" name="user_password" id="user_password" minlength="8" pattern=".{8,}" title="Mínimo 8 caracteres" required>
                    <i class="fi fi-rr-eye" id="togglePassword"></i>
                </div>
            </div>

            <div class="login--action">
                <div class="action--check">
                    <div class="action">
                        <input type="checkbox" name="" id="recordar">
                        <label for="recordar">Recordarme</label>
                    </div>
                    <a href="http://">Recuperar Contraseña</a>
                </div>
                <button>
                    <i class="fi fi-rr-sign-in-alt"></i>
                    <h6>Iniciar Sesión</h6>
                </button>
                <?php
                if (isset($_GET['error'])) {

                    if ($_GET['error'] == 'user') {
                        echo '<p class="error-msg"><i class="fi fi-rr-triangle-warning"></i> Usuario incorrecto</p>';
                    }

                    if ($_GET['error'] == 'password') {
                        echo '<p class="error-msg"><i class="fi fi-rr-triangle-warning"></i> Contraseña incorrecta</p>';
                    }
                }
                ?>
            </div>
            <?php include("includes/footer.php"); ?>
        </form>
    </main>

    <script src="assets/js/index.js"></script>
</body>

</html>