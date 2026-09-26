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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  
 
  <title>Admin</title>

  
<style>
/* ===== RESET GENERAL ===== */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

body{
  font-family: 'Segoe UI', sans-serif;
  background:#f1f5f9;
  display:flex;
}

/* ===== SIDEBAR ===== */
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: 260px;
  height: 100vh;
  background: linear-gradient(180deg, #0f172a, #020617);
  color: #e5e7eb;
  display: flex;
  flex-direction: column;
  padding: 24px 20px;
  box-shadow: 4px 0 15px rgba(0, 0, 0, 0.35);
}

/* ===== TÍTULO ===== */
.sidebar h2 {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 35px;
  color: #f8fafc;
}

/* ===== SECCIONES ===== */
.sidebar .sidebar-section {
  margin-bottom: 25px;
}

.sidebar .sidebar-section span {
  display: block;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #94a3b8;
  margin-bottom: 10px;
}

/* ===== LINKS ===== */
.sidebar a {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 10px;
  padding: 12px 14px;
  border-radius: 10px;
  font-size: 0.95rem;
  font-weight: 500;
  color: #cbd5e1;
  text-decoration: none;
  transition: all 0.25s ease;
  position: relative;
}

.sidebar a i {
  font-size: 1.1rem;
}

.sidebar a:hover {
  background: rgba(255, 255, 255, 0.08);
  color: #ffffff;
  transform: translateX(4px);
}

.sidebar a.active {
  background: linear-gradient(90deg, #2563eb, #1d4ed8);
  color: #ffffff;
  box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
}

.sidebar a.active::before {
  content: '';
  position: absolute;
  left: -20px;
  top: 50%;
  transform: translateY(-50%);
  width: 4px;
  height: 70%;
  background: #60a5fa;
  border-radius: 4px;
}

/* ===== FOOTER ===== */
.sidebar .sidebar-footer {
  margin-top: auto;
  padding-top: 20px;
  border-top: 1px solid rgba(255,255,255,0.08);
}

.sidebar .sidebar-footer p {
  font-size: 0.85rem;
  color: #9ca3af;
}

/* ===== CONTENIDO DASHBOARD ===== */
.dashboard-container{
  margin-left:260px; /* igual al width sidebar */
  padding:30px;
  width:100%;
  min-height:100vh;
}

.dashboard-title{
  font-size:24px;
  font-weight:600;
  margin-bottom:25px;
  color:#1e293b;
}

/* ===== CARDS ===== */
.cards{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:20px;
  margin-bottom:40px;
}

.card{
  background:white;
  padding:20px;
  border-radius:12px;
  box-shadow:0 6px 18px rgba(0,0,0,0.05);
  transition:0.3s;
}

.card:hover{
  transform:translateY(-4px);
}

.card h5{
  font-size:14px;
  color:#64748b;
}

.card h3{
  margin:10px 0;
  font-size:20px;
  color:#0f172a;
}

.badge{
  display:inline-block;
  padding:4px 8px;
  font-size:12px;
  border-radius:6px;
  background:#2563eb;
  color:white;
}

/* ===== CHART ===== */
.chart-container{
  background:white;
  padding:25px;
  border-radius:12px;
  box-shadow:0 6px 18px rgba(0,0,0,0.05);
}

</style>
  
</head>

<body>
    <?php require_once APP . '/views/inc/admin/sidebarAdmin.php' ?>
<div class="dashboard-container">

<div class="dashboard-title">
📊 Dashboard de Ventas (<?= date('Y') ?>)
</div>

<div class="cards">

<?php
$nombresMeses = [
1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
];

foreach($ventasMensuales as $mes => $venta):
$productoMes = '';
foreach($productosTop as $p){
    if($p['mes'] == $mes){
        $productoMes = $p['nombre'];
    }
}
?>

<div class="card">
    <h5><?= $nombresMeses[$mes] ?></h5>
    <h3>$<?= number_format($venta,2) ?></h3>
    <span class="badge"><?= $porcentajes[$mes] ?>%</span>
    
</div>

<?php endforeach; ?>

</div>

<div class="chart-container">
    <canvas id="ventasChart"></canvas>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('ventasChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_values($nombresMeses)) ?>,
        datasets: [{
            label: 'Ventas ($)',
            data: <?= json_encode(array_values($ventasMensuales)) ?>,
            backgroundColor: '#2563eb'
        }]
    },
    options: {
        responsive:true,
        plugins:{
            legend:{display:false}
        }
    }
});
</script>

</bodyc>
</html>
