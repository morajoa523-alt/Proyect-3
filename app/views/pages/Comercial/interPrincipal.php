
<?php require_once APP . "/views/inc/comercial/headerInterPrincipal.php"; ?>
<?php $usuarioLogueado = isset($_SESSION['usuario2']); ?>

  <div class="page">
  <h1>Tienda — Colecciones</h1>

  <?php foreach ($tematicas as $tematica): ?>
<section class="theme-row" aria-labelledby="t-<?= $tematica['idTematica'] ?>">

  <!-- HEADER DE LA TEMÁTICA -->
  <div class="theme-header">
    <div>
      <div id="t-<?= $tematica['idTematica'] ?>" class="theme-title">
        <?= htmlspecialchars($tematica['descripcion']) ?>
      </div>
      <div class="theme-sub">
        Juegos relacionados con <?= htmlspecialchars($tematica['descripcion']) ?>
      </div>
    </div>

    <div class="scroll-controls" aria-hidden="true">
      <button class="btn"
              data-scroll-target="tema-<?= $tematica['idTematica'] ?>"
              data-dir="-1">◀</button>
      <button class="btn"
              data-scroll-target="tema-<?= $tematica['idTematica'] ?>"
              data-dir="1">▶</button>
    </div>
  </div>

  <!-- PRODUCTOS POR TEMÁTICA -->
  <div id="tema-<?= $tematica['idTematica'] ?>" class="products" role="list">

    <?php foreach ($productosXtematicas as $producto): ?>

      <?php if ($producto['idTematica'] == $tematica['idTematica']): ?>
       
      <article class="product"
         role="listitem"
         data-producto='<?= htmlspecialchars(json_encode($producto), ENT_QUOTES, "UTF-8") ?>'
         data-tematica="<?= htmlspecialchars($tematica['descripcion']) ?>">

  <img src="/ventaPedido/img/<?= !empty($producto['img']) ? $producto['img'] : 'img/default.png' ?>"
       alt="<?= htmlspecialchars($producto['nombre']) ?>"
       loading="lazy">

  <div class="name">
    <?= htmlspecialchars($producto['nombre']) ?>
  </div>

  <div class="meta">
    Stock disponible: <?= $producto['stock'] ?>
  </div>

</article>

      <?php endif; ?>
    <?php endforeach; ?>

  </div>

</section>
<?php endforeach; ?>

<!-- Overlay oscuro -->
<div id="cartOverlay" class="cart-overlay"></div>

<!-- Drawer del carrito -->
<aside id="cartDrawer" class="cart-drawer" aria-labelledby="cart-title">

  <!-- HEADER -->
  <header class="cart-header">
    <div class="cart-title-wrap">
      <span class="cart-icon">🛒</span>
      <h2 id="cart-title">Tu carrito</h2>
    </div>
    <button id="closeCart" class="close-cart" aria-label="Cerrar carrito">
      ✕
    </button>
  </header>

  <!-- CONTENIDO -->
  <div class="cart-content">

    <!-- Estado vacío -->
    <div class="cart-empty">
      <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Carrito vacío">
      <p>Tu carrito está vacío</p>
      <span>Agrega productos para continuar</span>
    </div>

    <!-- EJEMPLO DE ITEM (cuando haya productos) -->
    <!--
    <div class="cart-item">
      <img src="producto.jpg" alt="Producto">
      <div class="cart-item-info">
        <h4>Producto Natural</h4>
        <span>Cantidad: 1</span>
        <strong>$12.00</strong>
      </div>
      <button class="remove-item">✖</button>
    </div>
    -->

  </div>

  <!-- FOOTER -->
  <footer class="cart-footer">

    <div class="cart-summary">
      <div class="summary-line">
        
      </div>
      <div class="summary-line total">
        
      </div>
    </div>

    <?php if ($usuarioLogueado): ?>
      <button class="checkout-btn" id="btnCheckout">
        🧾 Finalizar compra
      </button>
    <?php else: ?>
      <button class="checkout-btn disabled" id="btnLoginRequired">
        🔒 Inicia sesión para comprar
      </button>
    <?php endif; ?>

  </footer>

</aside>

</div> <!----------FIN CONTENT BASE -------------------->


<script src="/ventaPedido/js/jsComer/interPrincipal.js"></script>


</body>
</html>