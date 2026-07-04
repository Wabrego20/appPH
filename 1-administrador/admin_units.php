<?php
require_once("../config/auth.php");
require_once("../config/conexion.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. EDITAR (ANTES DEL HTML)
$editData = null;
if (isset($_GET['editar'])) {

    $id = $_GET['editar'];

    $sql = "SELECT * FROM units WHERE unit_id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
}

// INSERTAR
if (isset($_POST['guardar'])) {

    $unit_code = $_POST['unit_code'];
    $unit_name = $_POST['unit_name'];
    $unit_phone = $_POST['unit_phone'];
    $unit_email = $_POST['unit_email'];

    $sql = "INSERT INTO units (unit_code, unit_name, unit_phone, unit_email)
            VALUES (:unit_code, :unit_name, :unit_phone, :unit_email)";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':unit_code', $unit_code);
    $stmt->bindParam(':unit_name', $unit_name);
    $stmt->bindParam(':unit_phone', $unit_phone);
    $stmt->bindParam(':unit_email', $unit_email);
    $stmt->execute();

    header("Location: admin_units.php");
    exit();
}
if (isset($_POST['actualizar'])) {

    $sql = "UPDATE units 
            SET unit_code = :unit_code,
                unit_name = :unit_name,
                unit_phone = :unit_phone,
                unit_email = :unit_email
            WHERE unit_id = :id";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ':unit_code' => $_POST['unit_code'],
        ':unit_name' => $_POST['unit_name'],
        ':unit_phone' => $_POST['unit_phone'],
        ':unit_email' => $_POST['unit_email'],
        ':id' => $_POST['unit_id']
    ]);

    header("Location: admin_units.php");
    exit();
}

// ELIMINAR
if (isset($_GET['eliminar'])) {

    $id = $_GET['eliminar'];

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
    <link rel="stylesheet" href="../assets/css/config.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">
    <title>Inicio</title>
</head>

<body>
    <?php include("../includes/header.php"); ?>
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

                <input type="text" name="unit_name"
                    placeholder="Nombre"
                    value="<?= $editData['unit_name'] ?? '' ?>" required>

                <input type="text" name="unit_phone"
                    placeholder="Teléfono"
                    title="Formato válido: 809-1234 o 1234-5678"
                    maxlength="9"
                    pattern="^\d{3,4}-\d{4}$"
                    value="<?= $editData['unit_phone'] ?? '' ?>" required>

                <input type="text" name="unit_email"
                    placeholder="Correo"
                    pattern="^[^@]+@.{3,}\.com$"
                    title="Ingrese un correo válido (ej: usuario@dominio.com)"
                    value="<?= $editData['unit_email'] ?? '' ?>" required>

                <?php if ($editData): ?>
                    <button type="submit" name="actualizar"><i class="fi fi-rr-floppy-disk-circle-arrow-right"></i><h5>Actualizar</h5></button>
                <?php else: ?>
                    <button type="submit" name="guardar"><i class="fi fi-rr-disk"></i><h5>Guardar</h5></button>
                <?php endif; ?>
            </div>
        </form>

        <hr>

        <!-- TABLA -->
        <div class="table-container">
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th class="sortable">Unidad <span>↕</span></th>
                            <th class="sortable">Propietario <span>↕</span></th>
                            <th class="sortable">Teléfono <span>↕</span></th>
                            <th class="sortable">Email <span>↕</span></th>
                            <th class="sortable">Estado <span>↕</span></th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($units as $u): ?>
                            <tr>
                                <td><?= $u['unit_id'] ?></td>
                                <td><?= $u['unit_code'] ?></td>
                                <td><?= $u['unit_name'] ?></td>
                                <td><?= $u['unit_phone'] ?></td>
                                <td><?= $u['unit_email'] ?></td>

                                <td>
                                    <span class="badge <?= $u['unit_status'] == 'Activo' ? 'badge-activo' : 'badge-inactivo' ?>">
                                        <?= $u['unit_status'] ?>
                                    </span>
                                </td>

                                <td>
                                    <a href="?editar=<?= $u['unit_id'] ?>" class="btn-icon btn-edit">
                                        <i class="fi fi-rr-pencil"></i>
                                    </a>

                                    <a href="?eliminar=<?= $u['unit_id'] ?>" class="btn-icon btn-delete"
                                        onclick="return confirm('¿Eliminar?')">
                                        <i class="fi fi-rr-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
            <div class="table-controls">
                <input type="text" id="searchInput" placeholder="Buscar unidad o propietario..." class="search-box">
                <div id="pagination" class="pagination"></div>
                <div class="rows-control">
                    Mostrar
                    <select id="rowsPerPage">
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                    registros
                </div>

            </div>
        </div>
    </main>

    <?php include("../includes/footer.php"); ?>
    <script src="../assets/js/admin.js"></script>
</body>

</html>