<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$usuarioLogueado = isset($_SESSION['usuario']);
$nombreUsuario   = $usuarioLogueado ? $_SESSION['usuario']['nombre'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= URL . '/css/cssComer/interPrincipal.css' ?>">
  <title>MiTienda</title>
</head>

<body>

<header class="topbar">
<nav class="menu">

  <div class="logo">MiTienda</div>

  <ul class="menu-items">
    <li><a href="<?= URL ?>/">Inicio</a></li>
    <li><a href="#">Categorías</a></li>
    <li><a href="#">Ofertas</a></li>
  </ul>

  <div class="menu-actions">

    <!-- Buscar -->
    <button class="menu-btn" aria-label="Buscar">🔍</button>

    <!-- Carrito -->
    <button class="menu-btn" id="openCart" aria-label="Carrito">
      🛒 <span id="cartCount" class="cart-count">0</span>
    </button>

    <!-- Usuario -->
    <?php if ($usuarioLogueado): ?>

      <div class="user-menu">
        <span class="user-name">👤 <?= htmlspecialchars($nombreUsuario) ?></span>

        <a href="/ventaPedido/user/cerrarSesion" class="menu-btn logout-btn">
          Cerrar sesión
        </a>
      </div>

    <?php else: ?>

      <a href="/ventaPedido/inicio/inicioSesionCliente" class="menu-btn login-btn">
        Iniciar sesión
      </a>

    <?php endif; ?>

  </div>

</nav>
</header>
