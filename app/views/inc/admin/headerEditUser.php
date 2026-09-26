<?php
if (session_status() === PHP_SESSION_NONE) {
session_start();
}
if (
    !isset($_SESSION['usuario']) ||
    $_SESSION['usuario']['rol'] != 1
) {
    header('Location: /ventaPedido/inicio/inicioSesionAdmin');
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="<?= URL . "/css/cssAdmin/edicionDatosUser.css" ?>">
  
  <title>Admin</title>
  
</head>