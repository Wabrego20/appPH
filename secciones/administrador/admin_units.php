<?php
require_once("../../config/verificar_sesion.php");
require_once("../../config/conexion.php");

// INSERTAR
if (isset($_POST['guardar'])) {

    $unit_code = $_POST['unit_code'];
    $owner_name = $_POST['owner_name'];
    $owner_phone = $_POST['owner_phone'];
    $owner_email = $_POST['owner_email'];

    $sql = "INSERT INTO units (unit_code, owner_name, owner_phone, owner_email)
            VALUES (:unit_code, :owner_name, :owner_phone, :owner_email)";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':unit_code', $unit_code);
    $stmt->bindParam(':owner_name', $owner_name);
    $stmt->bindParam(':owner_phone', $owner_phone);
    $stmt->bindParam(':owner_email', $owner_email);
    $stmt->execute();

    header("Location: admin_units.php");
    exit();
}

// ELIMINAR
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $sql = "DELETE FROM units WHERE unit_id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: admin_units.php");
    exit();
}

// LISTAR
$sql = "SELECT * FROM units ORDER BY unit_id DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$units = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <main>
        <!-- FORMULARIO -->
        <form method="POST" class="unidad">
            <h3>Registrar dueño de la residencia</h3>
            <div class="entradas">
                <input type="text" name="unit_code" placeholder="Código (Ej: A-101)" autofocus required>
                <input type="text" name="owner_name" placeholder="Nombre del propietario" required>
                <input type="text" name="owner_phone" placeholder="Teléfono">
                <input type="email" name="owner_email" placeholder="Correo">
            </div>
            <button type="submit" name="guardar"><i class="bi bi-floppy"></i>Guardar</button>
        </form>

        <hr>

        <!-- TABLA -->
        <table border="1" cellpadding="10">

            <tr>
                <th>ID</th>
                <th>Unidad</th>
                <th>Propietario</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($units as $u): ?>
                <tr>
                    <td><?= $u['unit_id'] ?></td>
                    <td><?= $u['unit_code'] ?></td>
                    <td><?= $u['owner_name'] ?></td>
                    <td><?= $u['owner_phone'] ?></td>
                    <td><?= $u['owner_email'] ?></td>
                    <td><?= $u['status'] ?></td>
                    <td>
                        <a href="?delete=<?= $u['unit_id'] ?>" onclick="return confirm('¿Eliminar?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </main>

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