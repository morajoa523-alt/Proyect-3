
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mis Pedidos</title>

</head>
<body>
  <div class="container">
    <h1>Mis Pedidos</h1>

    <!-- Pedido ejemplo 1 -->
    <div class="order-card">
      <div class="order-header">
        <span>Pedido #12345</span>
        <span>Fecha: 12/01/2025</span>
      </div>

      <div class="order-status status-enviado">En camino</div>

      <div class="order-items">
        <div class="item">
          <img src="img/producto1.jpg" alt="Producto">
          <div class="item-info">
            <h4>Producto de ejemplo</h4>
            <p>Cantidad: 1</p>
          </div>
          <div class="price">$20.00</div>
        </div>

        <div class="item">
          <img src="img/producto2.jpg" alt="Producto">
          <div class="item-info">
            <h4>Otro producto</h4>
            <p>Cantidad: 2</p>
          </div>
          <div class="price">$40.00</div>
        </div>
      </div>

      <div class="order-total">Total: $60.00</div>
      <a href="#" class="ver-detalles">Ver detalles</a>
    </div>

    <!-- Pedido ejemplo 2 -->
    <div class="order-card">
      <div class="order-header">
        <span>Pedido #67890</span>
        <span>Fecha: 03/12/2024</span>
      </div>

      <div class="order-status status-entregado">Entregado</div>

      <div class="order-items">
        <div class="item">
          <img src="img/producto3.jpg" alt="Producto">
          <div class="item-info">
            <h4>Producto entregado</h4>
            <p>Cantidad: 1</p>
          </div>
          <div class="price">$35.00</div>
        </div>
      </div>

      <div class="order-total">Total: $35.00</div>
      <a href="#" class="ver-detalles">Ver detalles</a>
    </div>

  </div>
</body>
</html>

