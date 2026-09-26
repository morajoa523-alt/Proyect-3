<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Proceso de Pago</title>

<!-- ICONOS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{box-sizing:border-box}

body{
  margin:0;
  font-family:Inter, system-ui, sans-serif;
  background:linear-gradient(135deg,#f3f4f6,#e5e7eb);
  padding:24px;
  color:#1f2937;
}

.checkout-container{
  max-width:1000px;
  margin:auto;
  background:#fff;
  padding:32px;
  border-radius:18px;
  box-shadow:0 12px 35px rgba(0,0,0,.1);
  display:grid;
  grid-template-columns:1fr 360px;
  gap:28px;
}

h2{
  margin:0 0 16px;
  display:flex;
  align-items:center;
  gap:10px;
  font-size:1.45rem;
}

.section{
  display:flex;
  flex-direction:column;
  gap:16px;
  margin-bottom:22px;
}

.form-group{
  display:flex;
  flex-direction:column;
  gap:6px;
}

label{
  font-size:.85rem;
  font-weight:600;
  display:flex;
  align-items:center;
  gap:6px;
}

input,select{
  padding:11px 12px;
  border:1px solid #d1d5db;
  border-radius:10px;
  font-size:.95rem;
}

input:focus{
  outline:none;
  border-color:#6366f1;
  box-shadow:0 0 0 3px rgba(99,102,241,.25);
}

.card-row{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:14px;
}

.payment-option{
  display:flex;
  align-items:center;
  gap:10px;
  padding:12px;
  border:1px solid #e5e7eb;
  border-radius:10px;
  cursor:pointer;
}

.payment-option:hover{
  background:#f9fafb;
}

.metodo-pago{
  background:#fafafa;
  padding:16px;
  border-radius:12px;
  border:1px solid #e5e7eb;
}

.summary{
  background:linear-gradient(180deg,#fafafa,#f3f4f6);
  padding:22px;
  border-radius:16px;
  border:1px solid #e5e7eb;
  display:flex;
  flex-direction:column;
  gap:16px;
  height:fit-content;
}

.summary-row{
  display:flex;
  justify-content:space-between;
}

.summary-total{
  font-size:1.4rem;
  font-weight:800;
  border-top:1px dashed #d1d5db;
  padding-top:12px;
}

.pay-btn{
  margin-top:10px;
  padding:15px;
  border:none;
  border-radius:12px;
  background:linear-gradient(135deg,#10b981,#059669);
  color:#fff;
  font-size:1.1rem;
  font-weight:700;
  cursor:pointer;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:10px;
}

.pay-btn:hover{
  box-shadow:0 6px 15px rgba(16,185,129,.35);
  transform:translateY(-1px);
}

.error-box{
  background:#ffe5e5;
  color:#b30000;
  border:1px solid #ffb3b3;
  padding:14px;
  border-radius:8px;
  margin-bottom:20px;
  font-weight:600;
}

@media(max-width:850px){
  .checkout-container{
    grid-template-columns:1fr;
  }
}
</style>
</head>

<body>

<form action="/ventaPedido/confirmarPago/confirmarDatosPago" method="POST" enctype="multipart/form-data">

<?php if (!empty($_SESSION['errorPago'])): ?>
<div class="error-box">
  <?= $_SESSION['errorPago']; unset($_SESSION['errorPago']); ?>
</div>
<?php endif; ?>

<div class="checkout-container">

<!-- FORM -->
<div>

<h2><i class="fa-solid fa-user"></i> Datos personales</h2>
<div class="section">
  <div class="form-group">
    <label><i class="fa-solid fa-user"></i> Nombre completo</label>
    <input type="text" name="cliente[nombre]" required>
  </div>

  <div class="form-group">
    <label><i class="fa-solid fa-envelope"></i> Correo electrónico</label>
    <input type="email" name="cliente[email]" required>
  </div>

  <div class="form-group">
    <label><i class="fa-solid fa-phone"></i> Teléfono</label>
    <input type="text" name="cliente[telefono]" required>
  </div>
</div>

<h2><i class="fa-solid fa-truck-fast"></i> Dirección de envío</h2>
<div class="section">
  <div class="form-group">
    <label>Dirección</label>
    <input type="text" name="direccion[calle]" required>
  </div>

  <div class="form-group">
    <label>Ciudad</label>
    <input type="text" name="direccion[ciudad]" required>
  </div>

  <div class="card-row">
    <input type="text" name="direccion[provincia]" placeholder="Provincia" required>
    <input type="text" name="direccion[codigoPostal]" placeholder="Código postal" required>
  </div>
</div>

<h2><i class="fa-solid fa-credit-card"></i> Método de pago</h2>
<div class="section">
  <label class="payment-option">
    <input type="radio" name="metodoPago" value="tarjeta" required>
    <i class="fa-solid fa-credit-card"></i> Tarjeta
  </label>

  <label class="payment-option">
    <input type="radio" name="metodoPago" value="transferencia">
    <i class="fa-solid fa-building-columns"></i> Transferencia
  </label>
</div>

<div id="pagoTarjeta" class="metodo-pago section" style="display:none">
  <input type="text" name="tarjeta[numero]" data-tarjeta placeholder="Número de tarjeta">
  <div class="card-row">
    <input type="text" name="tarjeta[expiracion]" data-tarjeta placeholder="MM/AA">
    <input type="password" name="tarjeta[cvv]" data-tarjeta placeholder="CVV">
  </div>
  <input type="text" name="tarjeta[nombre]" data-tarjeta placeholder="Nombre en la tarjeta">
</div>

<div id="pagoTransferencia" class="metodo-pago section" style="display:none">
  <p><strong>Banco Ejemplo</strong><br>Cuenta: 1234567890<br>CLABE: 012345678901234567</p>
  <input type="file" name="transferencia[comprobante]" data-transferencia>
</div>

</div>

<!-- RESUMEN -->
<aside class="summary">
  <h2><i class="fa-solid fa-receipt"></i> Resumen</h2>

  <div class="summary-row">
    <span>Total productos</span>
    <span>$<?= $totalCosto ?></span>
  </div>

  <div class="summary-row summary-total">
    <span>Total</span>
    <span>$<?= $totalCosto ?></span>
  </div>

  <input type="hidden" name="datosFact" value="<?= htmlspecialchars(json_encode($datosFact)) ?>">
  <input type="hidden" name="totalCosto" value="<?= $totalCosto ?>">
  <input type="hidden" name="totalTiempoHoras" value="<?= $totalTiempoHoras ?>">

  <button class="pay-btn" type="submit">
    <i class="fa-solid fa-lock"></i> Confirmar pago
  </button>
</aside>

</div>
</form>

<script>
document.addEventListener('DOMContentLoaded',()=>{

  const radios=document.querySelectorAll('input[name="metodoPago"]');
  const tarjeta=document.getElementById('pagoTarjeta');
  const transferencia=document.getElementById('pagoTransferencia');
  const tarjetaInputs=document.querySelectorAll('[data-tarjeta]');
  const transInputs=document.querySelectorAll('[data-transferencia]');

  function reset(){
    tarjetaInputs.forEach(i=>i.required=false);
    transInputs.forEach(i=>i.required=false);
  }

  radios.forEach(r=>{
    r.addEventListener('change',()=>{
      tarjeta.style.display='none';
      transferencia.style.display='none';
      reset();

      if(r.value==='tarjeta'){
        tarjeta.style.display='block';
        tarjetaInputs.forEach(i=>i.required=true);
      }

      if(r.value==='transferencia'){
        transferencia.style.display='block';
        transInputs.forEach(i=>i.required=true);
      }
    });
  });

});
</script>

</body>
</html>
