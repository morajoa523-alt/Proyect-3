<?php
$idProducto       = $_GET['idProducto'] ?? '';
$idTipoImpresion  = $_GET['idTipoImpresion'] ?? '';
$idCantidadPiezas = $_GET['idCantidadPiezas'] ?? '';
$cantidad         = $_GET['cantidad'] ?? 1;
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Mi Carrito</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= URL . '/css/cssComer/interCarrito.css' ?>">
</head>

<body>

<header class="topbar">
  <nav class="menu">
    <div class="logo">MiTienda</div>
    <ul class="menu-items">
      <li><a href="#">Inicio</a></li>
      <li><a href="#">Productos</a></li>
    </ul>
    <div class="menu-actions">
      <span class="menu-btn">🛒</span>
    </div>
  </nav>
</header>

<main class="carrito-container">

  <h1>Carrito de compras</h1>

  <div class="carrito-item">
    <div class="item-info">
      <p><strong>ID Producto:</strong> <?= htmlspecialchars($idProducto) ?></p>
      <p><strong>Tipo impresión:</strong> <?= htmlspecialchars($idTipoImpresion) ?></p>
      <p><strong>Piezas:</strong> <?= htmlspecialchars($idCantidadPiezas) ?></p>
      <p><strong>Cantidad:</strong> <?= htmlspecialchars($cantidad) ?></p>
    </div>
  </div>

  <div class="carrito-resumen">
    <p>Total estimado: <strong>$0.00</strong></p>
  </div>

  <div class="carrito-acciones">
    <a href="productos.php" class="btn-secundario">Seguir comprando</a>
    <a href="confirmarPedido.php?<?= http_build_query($_GET) ?>"
       class="btn-principal">
       Confirmar pedido
    </a>
  </div>

</main>

</body>
</html>
