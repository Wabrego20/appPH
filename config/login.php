<?php
session_start();
require_once("conexion.php");

// Verificar que llegaron los datos por POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Acceso no permitido.");
}

$user = trim($_POST["user_user"]);
$password = $_POST["user_password"];

// Validación de formato de usuario
if (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $user)) {
    exit("Usuario inválido. Solo letras, números y _ (4 a 20 caracteres).");
}

// VALIDACIÓN DE LONGITUD
if (strlen($password) < 8) {
    exit("La contraseña debe tener al menos 8 caracteres");
}

try {

    $sql = "SELECT * FROM users WHERE user_user = :user LIMIT 1";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":user", $user, PDO::PARAM_STR);
    $stmt->execute();

    $datos = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si existe el usuario
    if ($datos) {

        // Verificar si el usuario está activo
        if ($datos["user_state"] != "Activo") {
            exit("El usuario está inactivo.");
        }

        // Verificar la contraseña
        if (password_verify($password, $datos["user_password"])) {

            // Guardar datos de la sesión
            $_SESSION["user_id"] = $datos["user_id"];
            $_SESSION["user_name"] = $datos["user_name"];
            $_SESSION["user_user"] = $datos["user_user"];
            $_SESSION["role_id"] = $datos["role_id"];

            // Actualizar último acceso
            $sqlUpdate = "UPDATE users
                          SET user_last_access = NOW()
                          WHERE user_id = :id";

            $stmtUpdate = $conexion->prepare($sqlUpdate);
            $stmtUpdate->bindParam(":id", $datos["user_id"], PDO::PARAM_INT);
            $stmtUpdate->execute();

            // Redireccionar según el rol
            switch ($datos["role_id"]) {

                case 1:
                    header("Location: ../1-administrador/dashboard.php");
                    exit();

                case 2:
                    header("Location: ../2-residente/dashboard.php");
                    exit();

                case 3:
                    header("Location: ../3-guardia/dashboard.php");
                    exit();

                default:
                    session_destroy();
                    exit("El rol asignado no es válido.");
            }
        } else {
            header("Location: ../index.php?error=password");
            exit();
        }
    } else {
        header("Location: ../index.php?error=user");
            exit();
    }
} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();
}
?>