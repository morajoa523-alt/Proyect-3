<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Inventario</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
 
  <style>
    body {
      background: #f8fafc;
      font-family: "Segoe UI", system-ui, sans-serif;
    }

  /* ===== SIDEBAR ===== */
.sidebar {
  position: fixed; /* ⬅ CLAVE */
  top: 0;
  left: 0;

  width: 240px;
  height: 100vh;

  background: linear-gradient(180deg, #0f172a, #020617);
  color: #e5e7eb;
  display: flex;
  flex-direction: column;
  padding: 24px 20px;
  box-shadow: 4px 0 15px rgba(0, 0, 0, 0.35);
}


/* ===== TÍTULO / LOGO ===== */
.sidebar h2 {
  font-size: 1.5rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  margin-bottom: 35px;
  color: #f8fafc;
}

/* ===== SECCIÓN ===== */
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

/* ICONOS (si usas <i> o svg) */
.sidebar a i {
  font-size: 1.1rem;
  opacity: 0.9;
}

/* HOVER */
.sidebar a:hover {
  background: rgba(255, 255, 255, 0.08);
  color: #ffffff;
  transform: translateX(4px);
}

/* ACTIVO */
.sidebar a.active {
  background: linear-gradient(90deg, #2563eb, #1d4ed8);
  color: #ffffff;
  box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
}

/* INDICADOR ACTIVO */
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

/* ===== FOOTER / USUARIO ===== */
.sidebar .sidebar-footer {
  margin-top: auto;
  padding-top: 20px;
  border-top: 1px solid rgba(255,255,255,0.08);
}

.sidebar .sidebar-footer p {
  font-size: 0.85rem;
  color: #9ca3af;
  margin: 0;
}



    /* CONTENIDO BASE (sidebar ya fijo) */
    .content-base {
      margin-left: 260px;
      padding: 30px;
      min-height: 100vh;
    }

    /* CARD PRINCIPAL */
    .report-card {
      max-width: 900px;
      margin: auto;
      border-radius: 18px;
      overflow: hidden;
      border: none;
      box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    }

    .report-header {
      background: linear-gradient(135deg, #2563eb, #1e40af);
      color: white;
      padding: 30px;
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .report-header i {
      font-size: 2.8rem;
      opacity: 0.9;
    }

    .report-header h4 {
      margin: 0;
      font-weight: 600;
    }

    .report-body {
      padding: 35px;
      text-align: center;
    }

    .report-body img {
      max-width: 220px;
      margin-bottom: 25px;
    }

    .report-body p {
      font-size: 1rem;
      color: #475569;
      margin-bottom: 30px;
    }

    /* BOTÓN EXCEL */
    .btn-excel {
      background: linear-gradient(135deg, #1D6F42, #166534);
      color: white;
      font-weight: 600;
      padding: 14px 28px;
      border-radius: 12px;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      transition: all 0.25s ease;
      box-shadow: 0 8px 20px rgba(22, 101, 52, 0.35);
    }

    .btn-excel:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(22, 101, 52, 0.45);
      color: #fff;
    }

    .report-footer {
      background: #f1f5f9;
      padding: 15px;
      text-align: center;
      font-size: 0.85rem;
      color: #64748b;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .content-base {
        margin-left: 0;
        padding: 20px;
      }

      .report-header {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>

<?php require_once APP . '/views/inc/admin/sidebarAdmin.php' ?>

<body>

<main class="content-base">

  <div class="card report-card">

    <!-- HEADER -->
    <div class="report-header">
      <i class="bi bi-box-seam"></i>
      <div>
        <h4>Reporte de Inventario</h4>
        <small>Exportación de productos registrados</small>
      </div>
    </div>

    <!-- BODY -->
    <div class="report-body">

      <!-- Imagen ilustrativa -->
      <img src="https://cdn-icons-png.flaticon.com/512/3159/3159066.png" alt="Reporte Inventario">

      <p>
        Genera un archivo Excel con el listado completo del inventario,
        incluyendo stock, categorías y estado de los productos.
      </p>

      <a href="/ventaPedido/reportes/exportarInventarioExcel" class="btn btn-excel btn-lg">
        <i class="bi bi-file-earmark-excel-fill"></i>
        Descargar reporte Excel
      </a>

    </div>

    <!-- FOOTER -->
    <div class="report-footer">
      <i class="bi bi-shield-check"></i>
      Sistema de Inventario © <?= date('Y') ?>
    </div>

  </div>

</main>

</body>
</html>
