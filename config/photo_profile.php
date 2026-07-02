<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION["user_id"])) {
    die("Acceso denegado.");
}

if (!isset($_FILES["foto"])) {
    die("No se recibió ninguna imagen.");
}

$id = $_SESSION["user_id"];

$archivo = $_FILES["foto"];

if ($archivo["error"] != 0) {
    die("Error al subir la imagen.");
}

// Extensiones permitidas
$permitidas = ["jpg", "jpeg", "png", "webp"];

$extension = strtolower(pathinfo($archivo["name"], PATHINFO_EXTENSION));

if (!in_array($extension, $permitidas)) {
    die("Formato no permitido.");
}

// Nombre único
$nombreFoto = "usuario_" . $id . "_" . time() . "." . $extension;

// Ruta física
$destino = "../perfiles/" . $nombreFoto;

if (move_uploaded_file($archivo["tmp_name"], $destino)) {

    // Actualizar la base de datos
    $sql = "UPDATE users
            SET user_photo = :foto
            WHERE user_id = :id";

    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(":foto", $nombreFoto);
    $stmt->bindParam(":id", $id);

    $stmt->execute();

    // Actualizar la sesión
    $_SESSION["user_photo"] = $nombreFoto;

}

// Regresar a la página anterior
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit;