<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>

    <div class="logoNombre">
        <img src="../assets/img/logo.png" alt="Logo">
        <h3>Rivera del Oeste - Se Conecta</h3>
    </div>

    <div class="acciones">

        <!-- Notificaciones -->
        <div class="alert">
            <i class="fi fi-rr-bell"></i>
            <h6>0</h6>
        </div>

        <!-- Foto de perfil -->
        <form id="formFoto"
            action="../config/photo_profile.php"
            method="POST"
            enctype="multipart/form-data">

            <label for="foto" style="cursor:pointer;">

                <?php if (empty($_SESSION["user_photo"])) { ?>

                    <img src="../perfiles/perfil.png"
                        alt="Foto de perfil"
                        class="fotoPerfil">

                <?php } else { ?>

                    <img src="../perfiles/<?php echo htmlspecialchars($_SESSION["user_photo"]); ?>"
                        alt="Foto de perfil"
                        class="fotoPerfil"
                        onerror="this.src='../perfiles/perfil.png'">

                <?php } ?>

            </label>

            <input
                type="file"
                id="foto"
                name="foto"
                accept=".jpg,.jpeg,.png,.webp"
                hidden
                onchange="document.getElementById('formFoto').submit();">

        </form>

        <!-- Nombre del usuario -->
        <div class="nombre">
            <h4>Bienvenido: <?php echo $_SESSION["user_user"]; ?></h4>
        </div>

        <!-- Cerrar sesión -->
        <a href="../config/logout.php" class="sesion">
            <i class="fi fi-rr-power"></i>
            <h6>Cerrar Sesión</h6>
        </a>

    </div>

</header>