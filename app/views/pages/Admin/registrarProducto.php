<?php require_once APP . '/views/inc/admin/headerRegistrarProducto.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Producto</title>

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", system-ui, sans-serif;
      background: #f8fafc;
      color: #0f172a;
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


    .app {
      display: flex;
      min-height: 100vh;
    }

    /* ===== MAIN ===== */
    .main {
      flex: 1;
      padding: 40px;
      margin-left: 260px;
    }

    /* ===== CARD ===== */
    .card {
      max-width: 900px;
      margin: auto;
      background: #ffffff;
      border-radius: 18px;
      padding: 35px 40px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    }

    .card h1 {
      font-size: 1.8rem;
      margin-bottom: 25px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .card h1 i {
      color: #2563eb;
      font-size: 1.8rem;
    }

    /* ===== FIELDSET ===== */
    fieldset {
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      padding: 25px;
      margin-bottom: 30px;
    }

    legend {
      padding: 0 10px;
      font-weight: 600;
      color: #2563eb;
      font-size: 0.95rem;
    }

    /* ===== GRID FORM ===== */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-group.full {
      grid-column: span 2;
    }

    .form-group label {
      font-size: 0.85rem;
      color: #64748b;
      margin-bottom: 6px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      padding: 12px 14px;
      border-radius: 10px;
      border: 1px solid #cbd5e1;
      font-size: 0.95rem;
      transition: border 0.2s ease, box-shadow 0.2s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    textarea {
      resize: none;
    }

    /* ===== CHECKBOX ===== */
    .checkbox {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 10px;
    }

    .checkbox input {
      width: 18px;
      height: 18px;
      accent-color: #2563eb;
    }

    .checkbox label {
      font-size: 0.9rem;
      color: #334155;
    }

    /* ===== BOTÓN ===== */
    .btn-submit {
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      color: white;
      padding: 14px 28px;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      transition: all 0.25s ease;
      box-shadow: 0 10px 25px rgba(37, 99, 235, 0.35);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 14px 35px rgba(37, 99, 235, 0.45);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
      .main {
        margin-left: 0;
        padding: 20px;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      .form-group.full {
        grid-column: span 1;
      }
    }
  </style>
</head>

<body>

<div class="app">

  <?php require_once APP . '/views/inc/admin/sidebarAdmin.php' ?>

  <!-- ===== CONTENIDO ===== -->
  <main class="main">

    <div class="card">

      <h1>
        <i class="bi bi-box-seam"></i>
        Registrar producto
      </h1>

      <form action="/ventaPedido/productos/insertProducto"
            method="GET"
            enctype="multipart/form-data">

        <fieldset>
          <legend>Información del producto</legend>

          <div class="form-grid">

            <div class="form-group">
              <label>Nombre del producto</label>
              <input type="text" name="nombre" required>
            </div>

             

            <div class="form-group">
              <label>Stock disponible</label>
              <input type="number" name="stock" min="0" required>
            </div>

            <div class="form-group full">
              <label>Descripción</label>
              <textarea name="descripcion" rows="3"></textarea>
            </div>

            <div class="form-group">
              <label>Categoría</label>
              <select name="idCategoria" required>
            <option value="">Seleccione</option>
            <?php foreach ($categorias as $c): ?>
                <option value="<?= $c['idCategoria'] ?>">
                    <?= htmlspecialchars($c['descripcion']) ?>
                </option>
            <?php endforeach; ?>
        </select>
            </div>

            <div class="form-group">
              <label>Temática</label>
              <select name="idTematica" required>
            <option value="">Seleccione</option>
            <?php foreach ($tematicas as $t): ?>
                <option value="<?= $t['idTematica'] ?>">
                    <?= htmlspecialchars($t['descripcion']) ?>
                </option>
            <?php endforeach; ?>
        </select>
            </div>

            <div class="form-group full">
              <label>Imagen del producto</label>
              <input type="file" name="img">
            </div>

            <div class="form-group full">
              <div class="checkbox">
                <input type="checkbox" name="activo" value="1" checked>
                <label>Producto activo</label>
              </div>
            </div>

          </div>
        </fieldset>

        <button type="submit" class="btn-submit">
          <i class="bi bi-check-circle"></i>
          Registrar producto
        </button>

      </form>

    </div>

  </main>

</div>

</body>
</html>
