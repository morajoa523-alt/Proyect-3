<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Pedidos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ICONOS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    /* ===== RESET ===== */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', system-ui, sans-serif;
    }

    body {
      background: #f1f5f9;
      color: #1f2933;
    }

        /* ===== SIDEBAR ===== */
.sidebar {
  width: 260px;
  min-height: 100vh;
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

    /* ===== LAYOUT ===== */
    .app {
      display: flex;
      min-height: 100vh;
    }

    .main {
      flex: 1;
      padding: 40px;
    }

    /* ===== HEADER ===== */
    .page-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 25px;
    }

    .page-header h2 {
      font-size: 1.6rem;
      font-weight: 700;
      color: #0f172a;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* ===== CARD ===== */
    .card {
      background: #ffffff;
      border-radius: 16px;
      padding: 25px;
      box-shadow: 0 20px 35px rgba(0,0,0,0.08);
    }

    /* ===== TABLE ===== */
    .table-wrapper {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.9rem;
    }

    thead {
      background: #f8fafc;
    }

    th {
      text-align: left;
      padding: 14px 12px;
      font-weight: 700;
      color: #334155;
      border-bottom: 2px solid #e5e7eb;
      white-space: nowrap;
    }

    td {
      padding: 14px 12px;
      border-bottom: 1px solid #e5e7eb;
      vertical-align: middle;
    }

    tbody tr:hover {
      background: #f1f5f9;
    }

    /* ===== BADGES ===== */
    .badge {
      padding: 6px 12px;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 700;
      display: inline-block;
    }

    .pendiente {
      background: #fef3c7;
      color: #92400e;
    }

    .proceso {
      background: #dbeafe;
      color: #1e40af;
    }

    .finalizado {
      background: #dcfce7;
      color: #166534;
    }

    .cancelado {
      background: #fee2e2;
      color: #991b1b;
    }

    /* ===== FORM ===== */
    select {
      padding: 8px 12px;
      border-radius: 10px;
      border: 1px solid #cbd5e1;
      background: #f8fafc;
      font-size: 0.85rem;
    }

    select:focus {
      outline: none;
      border-color: #2563eb;
      box-shadow: 0 0 0 2px rgba(37,99,235,.15);
    }

    /* ===== BUTTON ===== */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      border: none;
      background: linear-gradient(90deg, #2563eb, #1d4ed8);
      color: #fff;
      font-size: 0.85rem;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 18px rgba(37,99,235,.35);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
      .main {
        padding: 20px;
      }

      th, td {
        padding: 10px 8px;
      }
    }
  </style>
</head>

<body>

<div class="app">

  <?php require_once APP . '/views/inc/admin/sidebarAdmin.php' ?>

  <main class="main">

    <div class="page-header">
      <h2><i class="fa-solid fa-box"></i> Gestión de Pedidos</h2>
    </div>

    <div class="card">
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Cliente</th>
              <th>Fecha</th>
              <th>Total</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead>

          <tbody>
          <?php foreach ($pedidos as $pedido): ?>
            <tr>
              <td>#<?= $pedido['idPedido'] ?></td>
              <td><?= htmlspecialchars($pedido['usuario']) ?></td>
              <td><?= $pedido['fechaPedido'] ?></td>
              <td><strong>$<?= number_format($pedido['total'], 2) ?></strong></td>
              

              <td>
                <?php
                  $estadoClase = strtolower(str_replace('_','',$pedido['estado']));
                ?>
                <span class="badge <?= $estadoClase ?>">
                  <?= $pedido['estado'] ?>
                </span>
              </td>

              <td>
                <form action="/ventaPedido/pedidos/updatePedidos" method="POST">
                  <input type="hidden" name="idPedido" value="<?= $pedido['idPedido'] ?>">

                  <select name="estado">
                    <?php
                      $estados = ['PENDIENTE', 'EN_PROCESO', 'FINALIZADO', 'CANCELADO'];
                      foreach ($estados as $estado):
                    ?>
                      <option value="<?= $estado ?>" <?= $pedido['estado'] === $estado ? 'selected' : '' ?>>
                        <?= $estado ?>
                      </option>
                    <?php endforeach; ?>
                  </select>

                  <button class="btn" type="submit">
                    <i class="fa-solid fa-rotate"></i> Actualizar
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </main>

</div>

</body>
</html>
