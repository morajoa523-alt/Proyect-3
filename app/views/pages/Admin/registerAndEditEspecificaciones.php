<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  
 
  <title>Admin</title>
  
</head>

<style>

/* ===== RESET BÁSICO ===== */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

body{
  background:#f4f6f9;
  font-family:'Segoe UI',sans-serif;
  display:flex;
}

/* =====================================================
   SIDEBAR
===================================================== */
.sidebar{
  position:fixed;
  top:0;
  left:0;
  width:240px;
  height:100vh;
  background:linear-gradient(180deg,#0f172a,#020617);
  color:#e5e7eb;
  display:flex;
  flex-direction:column;
  padding:24px 20px;
  box-shadow:4px 0 15px rgba(0,0,0,0.35);
  overflow-y:auto;
  z-index:1000;
}

.sidebar h2{
  font-size:1.5rem;
  font-weight:700;
  margin-bottom:35px;
  color:#f8fafc;
}

/* SECCIONES */
.sidebar .sidebar-section{
  margin-bottom:25px;
}

.sidebar .sidebar-section span{
  display:block;
  font-size:0.75rem;
  text-transform:uppercase;
  letter-spacing:1px;
  color:#94a3b8;
  margin-bottom:10px;
}

/* LINKS */
.sidebar a{
  display:flex;
  align-items:center;
  gap:10px;
  margin-bottom:8px;
  padding:10px 14px;
  border-radius:8px;
  font-size:0.95rem;
  font-weight:500;
  color:#cbd5e1;
  text-decoration:none;
  transition:all 0.25s ease;
  position:relative;
}

.sidebar a:hover{
  background:rgba(255,255,255,0.08);
  color:#ffffff;
  transform:translateX(3px);
}

.sidebar a.active{
  background:linear-gradient(90deg,#2563eb,#1d4ed8);
  color:#ffffff;
  box-shadow:0 4px 12px rgba(37,99,235,0.4);
}

.sidebar a.active::before{
  content:'';
  position:absolute;
  left:-20px;
  top:50%;
  transform:translateY(-50%);
  width:4px;
  height:70%;
  background:#60a5fa;
  border-radius:4px;
}

.sidebar .sidebar-footer{
  margin-top:auto;
  padding-top:20px;
  border-top:1px solid rgba(255,255,255,0.08);
}

.sidebar .sidebar-footer p{
  font-size:0.85rem;
  color:#9ca3af;
}

/* =====================================================
   CONTENIDO PRINCIPAL
===================================================== */
.admin-container{
  margin-left:240px; /* 👈 compensa sidebar */
  padding:30px;
  width:100%;
}

/* CARDS */
.card-admin{
  background:#ffffff;
  padding:25px;
  border-radius:12px;
  box-shadow:0 6px 18px rgba(0,0,0,0.06);
  margin-bottom:30px;
}

.card-admin h4{
  font-weight:600;
  margin-bottom:20px;
  color:#1e293b;
  border-bottom:1px solid #eee;
  padding-bottom:10px;
}

/* FORMULARIOS */
.form-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:15px;
}

input{
  padding:10px;
  border-radius:8px;
  border:1px solid #d1d5db;
  font-size:14px;
  transition:0.2s;
}

input:focus{
  outline:none;
  border-color:#2563eb;
  box-shadow:0 0 0 2px rgba(37,99,235,0.15);
}

/* BOTONES */
.btn{
  padding:8px 16px;
  border:none;
  border-radius:8px;
  cursor:pointer;
  font-size:14px;
  font-weight:500;
  transition:0.2s;
}

.btn:hover{
  opacity:0.9;
  transform:translateY(-1px);
}

.btn-primary{ background:#2563eb; color:white; }
.btn-success{ background:#16a34a; color:white; }
.btn-danger{ background:#dc2626; color:white; }
.btn-warning{ background:#f59e0b; color:white; }
.btn-secondary{ background:#64748b; color:white; }

/* TABLAS */
.table-container{
  display:none;
  margin-top:15px;
  background:white;
  border-radius:10px;
  overflow:hidden;
  box-shadow:0 4px 12px rgba(0,0,0,0.05);
}

.table{
  width:100%;
  border-collapse:collapse;
}

.table th{
  background:#1e293b;
  color:white;
  font-weight:500;
  padding:12px;
}

.table td{
  padding:10px;
  border-bottom:1px solid #eee;
  font-size:14px;
}

.table tr:hover{
  background:#f1f5f9;
}

/* ETIQUETA DESPLEGABLE */
.toggle-title{
  cursor:pointer;
  padding:10px 14px;
  background:#334155;
  color:white;
  border-radius:8px;
  margin-top:20px;
  font-size:14px;
  transition:0.2s;
}

.toggle-title:hover{
  background:#1e293b;
}

/* RESPONSIVE */
@media(max-width:900px){
  .sidebar{
    width:200px;
  }
  .admin-container{
    margin-left:200px;
  }
}

@media(max-width:768px){
  .sidebar{
    position:absolute;
    left:-240px;
  }
  .admin-container{
    margin-left:0;
  }
}

</style>
</head>
<body>

  <?php require_once APP . '/views/inc/admin/sidebarAdmin.php' ?>


<div class="admin-container">

<!-- ===================================================== -->
<!-- DIMENSIONES -->
<!-- ===================================================== -->
<div class="card-admin">
<h4>Dimensiones</h4>

<form id="formDimension" method="GET">
<input type="hidden" name="idDimension" id="idDimension">

<div class="form-grid">
<input type="number" step="0.01" name="anchoDimension" id="anchoDimension" placeholder="Ancho">
<input type="number" step="0.01" name="largoDimension" id="largoDimension" placeholder="Largo">
<input type="number" name="tiempoExtraDimension" id="tiempoExtraDimension" placeholder="Tiempo Extra">
<input type="number" step="0.01" name="costoExtraDimension" id="costoExtraDimension" placeholder="Costo Extra">
</div><br>

<button class="btn btn-primary" id="btnRegistrarDimension"
formaction="/ventaPedido/especificaciones/insertDimension" name="submit">Registrar</button>

<button class="btn btn-success" style="display:none"
id="btnGuardarDimension"
formaction="/ventaPedido/especificaciones/updateDimension" name="submit">Guardar Cambios</button>

<button type="button" class="btn btn-secondary"
style="display:none" id="btnCancelarDimension">Cancelar</button>
</form>

<div class="toggle-title" onclick="toggleTable('tablaDimensiones')">
▼ Ver Dimensiones Registradas
</div>

<div class="table-container" id="tablaDimensiones">
<table class="table">
<thead>
<tr><th>Ancho</th><th>Largo</th><th>Tiempo</th><th>Costo</th><th>Acciones</th></tr>
</thead>
<tbody>
<?php foreach($data['dimensiones'] as $d): ?>
<tr id="rowDim<?= $d['idDimension'] ?>">
<td><?= $d['ancho'] ?></td>
<td><?= $d['largo'] ?></td>
<td><?= $d['tiempoExtra'] ?></td>
<td><?= $d['costoExtra'] ?></td>
<td>
<button class="btn btn-warning"
onclick="editarDimension(<?= $d['idDimension'] ?>,<?= $d['ancho'] ?>,<?= $d['largo'] ?>,<?= $d['tiempoExtra'] ?>,<?= $d['costoExtra'] ?>)">✏</button>

<a class="btn btn-danger"
href="/ventaPedido/especificaciones/deleteDimension?idDimension=<?= $d['idDimension'] ?>&submit=1"
onclick="return eliminarFila('rowDim<?= $d['idDimension'] ?>')">🗑</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>

<!-- ===================================================== -->
<!-- MODELOS -->
<!-- ===================================================== -->
<div class="card-admin">
<h4>Modelos</h4>

<form id="formModelo" method="GET">
<input type="hidden" name="idModelo" id="idModelo">

<div class="form-grid">
<input type="text" name="descripcionModelo" id="descripcionModelo" placeholder="Descripción">
<input type="number" name="tiempoExtraModelo" id="tiempoExtraModelo" placeholder="Tiempo Extra">
<input type="number" step="0.01" name="costoExtraModelo" id="costoExtraModelo" placeholder="Costo Extra">
</div><br>

<button class="btn btn-primary" id="btnRegistrarModelo"
formaction="/ventaPedido/especificaciones/insertModelo" name="submit">Registrar</button>

<button class="btn btn-success" style="display:none"
id="btnGuardarModelo"
formaction="/ventaPedido/especificaciones/updateModelo" name="submit">Guardar Cambios</button>

<button type="button" class="btn btn-secondary"
style="display:none" id="btnCancelarModelo">Cancelar</button>
</form>

<div class="toggle-title" onclick="toggleTable('tablaModelos')">
▼ Ver Modelos Registrados
</div>

<div class="table-container" id="tablaModelos">
<table class="table">
<thead>
<tr><th>Descripción</th><th>Tiempo</th><th>Costo</th><th>Acciones</th></tr>
</thead>
<tbody>
<?php foreach($data['modelos'] as $m): ?>
<tr id="rowMod<?= $m['idModelo'] ?>">
<td><?= $m['descripcion'] ?></td>
<td><?= $m['tiempoExtra'] ?></td>
<td><?= $m['costoExtra'] ?></td>
<td>
<button class="btn btn-warning"
onclick="editarModelo(<?= $m['idModelo'] ?>,'<?= $m['descripcion'] ?>',<?= $m['tiempoExtra'] ?>,<?= $m['costoExtra'] ?>)">✏</button>

<a class="btn btn-danger"
href="/ventaPedido/especificaciones/deleteModelo?idModelo=<?= $m['idModelo'] ?>&submit=1"
onclick="return eliminarFila('rowMod<?= $m['idModelo'] ?>')">🗑</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>

<!-- ===================================================== -->
<!-- TIPO IMPRESION -->
<!-- ===================================================== -->
<div class="card-admin">
<h4>Tipo Impresión</h4>

<form id="formTipo" method="GET">
<input type="hidden" name="idTipoImpresion" id="idTipoImpresion">

<div class="form-grid">
<input type="text" name="descripcionTipoImpresion" id="descripcionTipoImpresion" placeholder="Descripción">
<input type="number" name="tiempoExtraTipoImpresion" id="tiempoExtraTipoImpresion" placeholder="Tiempo Extra">
<input type="number" step="0.01" name="costoExtraTipoImpresion" id="costoExtraTipoImpresion" placeholder="Costo Extra">
</div><br>

<button class="btn btn-primary" id="btnRegistrarTipo"
formaction="/ventaPedido/especificaciones/insertTipoImpresion" name="submit">Registrar</button>

<button class="btn btn-success" style="display:none"
id="btnGuardarTipo"
formaction="/ventaPedido/especificaciones/updateTipoImpresion" name="submit">Guardar Cambios</button>

<button type="button" class="btn btn-secondary"
style="display:none" id="btnCancelarTipo">Cancelar</button>
</form>

<div class="toggle-title" onclick="toggleTable('tablaTipo')">
▼ Ver Tipos de Impresión
</div>

<div class="table-container" id="tablaTipo">
<table class="table">
<thead>
<tr><th>Descripción</th><th>Tiempo</th><th>Costo</th><th>Acciones</th></tr>
</thead>
<tbody>
<?php foreach($data['tiposImpresion'] as $t): ?>
<tr id="rowTipo<?= $t['idTipoImpresion'] ?>">
<td><?= $t['descripcion'] ?></td>
<td><?= $t['tiempoExtra'] ?></td>
<td><?= $t['costoExtra'] ?></td>
<td>
<button class="btn btn-warning"
onclick="editarTipo(<?= $t['idTipoImpresion'] ?>,'<?= $t['descripcion'] ?>',<?= $t['tiempoExtra'] ?>,<?= $t['costoExtra'] ?>)">✏</button>

<a class="btn btn-danger"
href="/ventaPedido/especificaciones/deleteTipoImpresion?idTipoImpresion=<?= $t['idTipoImpresion'] ?>&submit=1"
onclick="return eliminarFila('rowTipo<?= $t['idTipoImpresion'] ?>')">🗑</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>

<!-- ===================================================== -->
<!-- CANTIDAD DE PIEZAS -->
<!-- ===================================================== -->
<div class="card-admin">
<h4>Cantidad de Piezas</h4>

<form id="formCantidad" method="GET">
<input type="hidden" name="idCantidadPiezas" id="idCantidadPiezas">

<div class="form-grid">
<input type="number" name="cantidadCantidadPiezas" id="cantidadCantidadPiezas" placeholder="Cantidad">
<input type="number" name="tiempoXpiezaCantidadPiezas" id="tiempoXpiezaCantidadPiezas" placeholder="Tiempo x Pieza">
<input type="number" step="0.01" name="costoXpiezaCantidadPiezas" id="costoXpiezaCantidadPiezas" placeholder="Costo x Pieza">
<input type="number" name="edadRecomendadaCantidadPiezas" id="edadRecomendadaCantidadPiezas" placeholder="Edad Recomendada">
</div><br>

<button class="btn btn-primary" id="btnRegistrarCantidad"
formaction="/ventaPedido/especificaciones/insertCantidadPiezas" name="submit">Registrar</button>

<button class="btn btn-success" style="display:none"
id="btnGuardarCantidad"
formaction="/ventaPedido/especificaciones/updateCantidadPiezas" name="submit">Guardar Cambios</button>

<button type="button" class="btn btn-secondary"
style="display:none" id="btnCancelarCantidad">Cancelar</button>
</form>

<div class="toggle-title" onclick="toggleTable('tablaCantidad')">
▼ Ver Cantidades Registradas
</div>

<div class="table-container" id="tablaCantidad">
<table class="table">
<thead>
<tr><th>Cantidad</th><th>Tiempo x Pieza</th><th>Costo x Pieza</th><th>Edad</th><th>Acciones</th></tr>
</thead>
<tbody>
<?php foreach($data['cantidadPiezas'] as $c): ?>
<tr id="rowCant<?= $c['idCantidadPiezas'] ?>">
<td><?= $c['cantidad'] ?></td>
<td><?= $c['tiempoPorPieza'] ?></td>
<td><?= $c['costoPorPieza'] ?></td>
<td><?= $c['edadRecomendada'] ?></td>
<td>
<button class="btn btn-warning"
onclick="editarCantidad(<?= $c['idCantidadPiezas'] ?>,<?= $c['cantidad'] ?>,<?= $c['tiempoPorPieza'] ?>,<?= $c['costoPorPieza'] ?>,<?= $c['edadRecomendada'] ?>)">✏</button>

<a class="btn btn-danger"
href="/ventaPedido/especificaciones/deleteCantidadPiezas?idCantidadPiezas=<?= $c['idCantidadPiezas'] ?>&submit=1"
onclick="return eliminarFila('rowCant<?= $c['idCantidadPiezas'] ?>')">🗑</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>

</div>

<script>
function toggleTable(id){
const el=document.getElementById(id);
el.style.display = el.style.display==="none"?"block":"none";
}
function eliminarFila(id){
if(confirm("¿Desea eliminar este registro?")){
document.getElementById(id).remove();
return true;}
return false;
}

/* ===== FUNCIONES EDITAR ===== */
function activarModoEdicion(reg,guard,can){
document.getElementById(reg).style.display='none';
document.getElementById(guard).style.display='inline-block';
document.getElementById(can).style.display='inline-block';
}

/* DIMENSION */
function editarDimension(id,a,l,t,c){
idDimension.value=id;
anchoDimension.value=a;
largoDimension.value=l;
tiempoExtraDimension.value=t;
costoExtraDimension.value=c;
activarModoEdicion('btnRegistrarDimension','btnGuardarDimension','btnCancelarDimension');
}
btnCancelarDimension.onclick=()=>location.reload();

/* MODELO */
function editarModelo(id,d,t,c){
idModelo.value=id;
descripcionModelo.value=d;
tiempoExtraModelo.value=t;
costoExtraModelo.value=c;
activarModoEdicion('btnRegistrarModelo','btnGuardarModelo','btnCancelarModelo');
}
btnCancelarModelo.onclick=()=>location.reload();

/* TIPO */
function editarTipo(id,d,t,c){
idTipoImpresion.value=id;
descripcionTipoImpresion.value=d;
tiempoExtraTipoImpresion.value=t;
costoExtraTipoImpresion.value=c;
activarModoEdicion('btnRegistrarTipo','btnGuardarTipo','btnCancelarTipo');
}
btnCancelarTipo.onclick=()=>location.reload();

/* CANTIDAD */
function editarCantidad(id,ca,t,c,e){
idCantidadPiezas.value=id;
cantidadCantidadPiezas.value=ca;
tiempoXpiezaCantidadPiezas.value=t;
costoXpiezaCantidadPiezas.value=c;
edadRecomendadaCantidadPiezas.value=e;
activarModoEdicion('btnRegistrarCantidad','btnGuardarCantidad','btnCancelarCantidad');
}
btnCancelarCantidad.onclick=()=>location.reload();
</script>
</body>
</html>
