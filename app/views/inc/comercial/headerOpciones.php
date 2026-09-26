<?php 
if(session_status() == PHP_SESSION_NONE){
session_start();
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Opciones del pedido</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?= URL . '/css/cssComer/opciones.css' ?>" >

</head>

<body>

<header class="topbar">
  <nav class="menu">
    <div class="logo">MiTienda</div>
  </nav>
</header>