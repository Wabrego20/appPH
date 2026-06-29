<?php
session_start();

// Verificar que exista una sesión iniciada
if (!isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
    exit();
}