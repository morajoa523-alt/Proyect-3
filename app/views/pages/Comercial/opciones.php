<?php require_once APP . "/views/inc/comercial/headerOpciones.php"; ?>

<div class="content-base">

<form action="/ventaPedido/inicio/prepararPago" method="GET">

<!-- ================= PRODUCTOS ================= -->
<div class="content-storet-left">
<section class="store-products">

<?php foreach ($_SESSION['datosCarrito']['datosProdCarrito'] as $index => $producto): ?>

<div class="store-card producto-opciones"
     >

  <!-- ID PRODUCTO -->
  <input type="hidden"
         name="productos[<?= $index ?>][idProducto]"
         value="<?= $producto['idProducto'] ?>">

  <!-- IMAGEN -->
  <div class="store-img">
    <img src="<?php echo '/ventaPedido/img/'.$producto['img'];?>">
  </div>

  <!-- INFO -->
  <div class="store-info">

    <h3 class="store-title"><?= $producto['nombre'] ?></h3>
    <p class="store-desc"><?= $producto['descripcion'] ?></p>

    <div class="store-status">
      <span class="<?= $producto['activo'] ? 'available' : 'not-available' ?>">
        <?= $producto['activo'] ? 'Disponible' : 'Agotado' ?>
      </span>
      <small>Stock: <?= $producto['stock'] ?></small>
    </div>

    <!-- OPCIONES -->
    <div class="store-options">

      <!-- Cantidad -->
      <div class="option">
        <label>Cantidad</label>
        <input type="number"
               class="cantidad-producto"
               name="productos[<?= $index ?>][cantidad]"
               value="<?= $producto['cantidad'] ?>"
               min="1"
               max="<?= $producto['stock'] ?>">
      </div>

      <!-- Tipo impresión -->
    <div class="opcion">
      <label>Tipo de impresión</label>
      
      <select class="tipo-impresion"
              data-multiplicador="1"
              name="productos[<?= $index ?>][idTipoImpresion]">
              
        <?php foreach ($_SESSION['datosCarrito']['tipoImpresion'] as $imp): ?>
          
          <option value=<?php echo($imp['idTipoImpresion']); 
          $datosPedidos['pedido']['tipoImpresion'][$imp['idTipoImpresion']] = $imp['descripcion']?> 
          data-multiplicador="<?= $imp['costoExtra']?>">
            
            <?= $imp['descripcion'] ?>
            
          </option>
          
        <?php endforeach; ?>
      </select>
      
    </div>

    <!-- Cantidad piezas -->
    <div class="opcion">
      <label>Cantidad de piezas</label>
      <select class="cantidad-piezas"
              data-tiempo="1"
              data-costo="2"
              name="productos[<?= $index ?>][idCantidadPiezas]">
        <?php foreach ($_SESSION['datosCarrito']['cantidadPiezasYedades'] as $pieza): ?>
          <option value="<?php echo($pieza['idCantidadPiezas']); 
           $datosPedidos['pedido']['cantidadPiezas'][$pieza['idCantidadPiezas']] = $pieza['cantidad'] . ' piezas'?>"
                  data-tiempo="<?= $pieza['cantidad'] * $pieza['tiempoPorPieza'] ?>"
                  data-costo="<?= $pieza['cantidad'] * $pieza['costoPorPieza'] ?>">
            <?= $pieza['cantidad'] ?> piezas
          </option>
         
        <?php endforeach; ?>
      </select>
    </div>

    </div>

  </div>
</div>

<?php endforeach; ?>

</section>
</div>
<!-- =============== FIN PRODUCTOS =============== -->

<!-- ================= RESUMEN ================= -->
<div class="content-resumen-rigth">
<aside class="store-cart">

  <h2>🛍️ Resumen de compra</h2>

  <div class="cart-line">
    <div>💰 Costo total: $<span id="totalCosto">0.00</span></div>
    <div>⏱️ Tiempo total: <span id="totalTiempo">0</span> hrs</div>
    <!--<span>Total</span>
    <strong>$<span id="totalCosto">0.00</span></strong>--->
  </div>

  <!-- INPUTS OCULTOS -->
  <input type="hidden" name="totalCosto" id="inputTotalCosto">
  <input type="hidden" name="datosProdCarrito"
         value="<?= htmlspecialchars(json_encode($_SESSION['datosCarrito']['datosProdCarrito'])) ?>">

  <button type="submit" class="btn-buy">
    Finalizar compra 🧾
  </button>

</aside>
</div>
<!-- =============== FIN RESUMEN =============== -->

</form>
</div>

<!-- ================= JS ================= -->
<script>
document.addEventListener('DOMContentLoaded', () => {

  function recalcular() {
    let totalCosto = 0;
    let totalTiempo = 0; // EN HORAS

    document.querySelectorAll('.producto-opciones').forEach(prod => {

      const cantidad = Number(prod.querySelector('.cantidad-producto').value);

      const piezas = prod.querySelector('.cantidad-piezas').selectedOptions[0];
      const impresion = prod.querySelector('.tipo-impresion').selectedOptions[0];

      const tiempoBase = Number(piezas.dataset.tiempo);
      const costoBase = Number(piezas.dataset.costo);
      const multiplicador = Number(impresion.dataset.multiplicador);

      totalCosto += costoBase * cantidad * multiplicador;
      totalTiempo += tiempoBase * cantidad * multiplicador;
    });

    /* ===== MOSTRAR COSTO ===== */
    document.getElementById('totalCosto').innerText = totalCosto.toFixed(2);
    document.querySelector('input[name="totalCosto"]').value = totalCosto;

    /* ===== MOSTRAR TIEMPO ===== */
    const totalTiempoEl = document.getElementById('totalTiempo');

    if (totalTiempo >= 24) {
      const dias = Math.floor(totalTiempo / 24);
      const horas = totalTiempo % 24;
      totalTiempoEl.innerText = `${dias} días ${horas.toFixed(1)} hrs`;
    } else {
      totalTiempoEl.innerText = totalTiempo.toFixed(2) + ' hrs';
    }

    // 👉 ESTE ES EL QUE SE ENVÍA AL BACKEND
    document.querySelector('input[name="totalTiempoHoras"]').value = totalTiempo;
  }

  document.querySelectorAll(
    '.cantidad-producto, .cantidad-piezas, .tipo-impresion'
  ).forEach(el => {
    el.addEventListener('change', recalcular);
    el.addEventListener('keyup', recalcular);
  });

  recalcular();
});
</script>

</body>
</html>
