<?php
session_start();
require_once("conexion.php"); // Ajusta la ruta si es necesario

$user = $_POST["user_user"];
$password = $_POST["user_password"];

$sql = "SELECT * FROM users WHERE user_user = :user";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(":user", $user);
$stmt->execute();

$datos = $stmt->fetch(PDO::FETCH_ASSOC);

if ($datos) {

    if (password_verify($password, $datos["user_password"])) {

        $_SESSION["user_user"] = $datos["user_user"];

        header("Location: ../secciones/administrador/dashboard.php");
        exit();

    } else {

        echo "Contraseña incorrecta";

    }

} else {

    echo "Usuario no existe";

}
?>