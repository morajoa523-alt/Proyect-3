<?php require_once APP . "/views/inc/comercial/headerOpciones.php"; ?>

<div class="content-base">

<form action="/ventaPedido/inicio/prepararPago" method="GET">

<?php foreach ($_SESSION['datosCarrito']['datosProdCarrito'] as $index => $producto): ?>

<?php
 $datosPedidos = [];
  ?>




<section class="producto-opciones">

<input type="hidden" name="productos[<?= $index ?>][idProducto]" value="<?= $producto['idProducto'] ?>">

<div class="content-left">

  <div class="content-img">
    <img src="<?= !empty($producto['img']) ? URL.'/img/productos/'.$producto['img'] : URL.'/img/productos/default.png' ?>">
  </div>

  <div class="content-opcionesProductos">

    <!-- Tipo impresión -->
    <div class="opcion">
      <label>Tipo de impresión</label>
      
      <select class="tipo-impresion"
              data-multiplicador="1.2"
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
              data-tiempo="1.5"
              data-costo="3.5"
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

    <!-- Cantidad -->
    <div class="opcion">
      <label>Cantidad</label>
      <input type="number"
             name="productos[<?= $index ?>][cantidad]"
             class="cantidad-producto"
             value="<?= $producto['cantidad'] ?>"
             min="1">
        
    </div>

  </div>

  <div class="content-detallesProductos">
    <h2><?= $producto['nombre'] ?></h2>
    <p><?= $producto['descripcion'] ?></p>
    
    <ul>
      <li><strong>Stock:</strong> <?= $producto['stock'] ?></li>
      <li><strong>Estado:</strong> <?= $producto['activo'] ? 'Disponible' : 'No disponible' ?></li>
    </ul>
  </div>

</div>
</section>

<?php endforeach; ?>

<div class="content-ritch">

  <div class="resumen-pedido">
    <div>💰 Costo total: $<span id="totalCosto">0.00</span></div>
    <div>⏱️ Tiempo total: <span id="totalTiempo">0</span> hrs</div>
  </div>
  <input type="hidden" name="datosPedidos" value="<?=  htmlspecialchars(json_encode($datosPedidos))?>">
  <input type="hidden" name="totalCosto" id="inputTotalCosto">
  <input type="hidden" name="totalTiempoHoras" id="inputTotalTiempo">
  <input type="hidden" name="datosProdCarrito" value="<?= htmlspecialchars(json_encode($_SESSION['datosCarrito']['datosProdCarrito'])) ?>">
  
  <div class="content-btn">
    <button type="submit" name="submit" >Continuar con el pedido</button>
  </div>

</div>

</form>
</div>

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
