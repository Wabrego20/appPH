<?php
require_once("../../config/verificar_sesion.php");
require_once("../../config/conexion.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. EDITAR (ANTES DEL HTML)
$editData = null;
if (isset($_GET['edit'])) {

    $id = $_GET['edit'];

    $sql = "SELECT * FROM units WHERE unit_id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
}

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
if (isset($_POST['actualizar'])) {

    $sql = "UPDATE units 
            SET unit_code = :unit_code,
                owner_name = :owner_name,
                owner_phone = :owner_phone,
                owner_email = :owner_email
            WHERE unit_id = :id";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ':unit_code' => $_POST['unit_code'],
        ':owner_name' => $_POST['owner_name'],
        ':owner_phone' => $_POST['owner_phone'],
        ':owner_email' => $_POST['owner_email'],
        ':id' => $_POST['unit_id']
    ]);

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
            <h3>Registrar o Editar dueño de la residencia</h3>
            <div class="entradas">
                <input type="hidden" name="unit_id" value="<?= $editData['unit_id'] ?? '' ?>">

                <input type="text" name="unit_code"
                    placeholder="Código"
                    value="<?= $editData['unit_code'] ?? '' ?>" required>

                <input type="text" name="owner_name"
                    placeholder="Nombre"
                    value="<?= $editData['owner_name'] ?? '' ?>" required>

                <input type="text" name="owner_phone"
                    placeholder="Teléfono"
                    value="<?= $editData['owner_phone'] ?? '' ?>">

                <input type="email" name="owner_email"
                    placeholder="Correo"
                    value="<?= $editData['owner_email'] ?? '' ?>">

                <?php if ($editData): ?>
                    <button type="submit" name="actualizar"><i class="bi bi-floppy-fill"></i>Actualizar</button>
                <?php else: ?>
                    <button type="submit" name="guardar"><i class="bi bi-floppy"></i>Guardar</button>
                <?php endif; ?>
            </div>
        </form>

        <hr>

        <!-- TABLA -->
        <div class="table-container">
            <input type="text" id="searchInput" placeholder="Buscar unidad o propietario..." class="search-box">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Unidad</th>
                        <th>Propietario</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($units as $u): ?>
                        <tr>
                            <td><?= $u['unit_id'] ?></td>
                            <td><?= $u['unit_code'] ?></td>
                            <td><?= $u['owner_name'] ?></td>
                            <td><?= $u['owner_phone'] ?></td>
                            <td><?= $u['owner_email'] ?></td>

                            <td>
                                <span class="badge <?= $u['status'] == 'Activo' ? 'badge-activo' : 'badge-inactivo' ?>">
                                    <?= $u['status'] ?>
                                </span>
                            </td>

                            <td>
                                <a href="?edit=<?= $u['unit_id'] ?>" class="btn-icon btn-edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a href="?delete=<?= $u['unit_id'] ?>" class="btn-icon btn-delete"
                                    onclick="return confirm('¿Eliminar?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
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
    <script src="../../config/script.js"></script>
</body>

</html>