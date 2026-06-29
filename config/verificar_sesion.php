<?php
session_start();

// Evitar que el navegador guarde páginas protegidas
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Verificar que exista una sesión iniciada
if (!isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
    exit();
}
