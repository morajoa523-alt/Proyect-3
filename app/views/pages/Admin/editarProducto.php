<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Producto</title>

  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", system-ui, sans-serif;
      background: #f8fafc;
      color: #0f172a;
    }



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


    /* ===== CONTENEDOR PRINCIPAL ===== */
    .content-base {
      margin-left: 260px;
      padding: 32px;
    }

    /* ===== CARD ===== */
    .card {
      max-width: 950px;
      margin: auto;
      background: #ffffff;
      border-radius: 18px;
      padding: 30px;
      box-shadow: 0 20px 40px rgba(0,0,0,.12);
    }

    .card h1 {
      font-size: 1.6rem;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* ===== FIELDSET ===== */
    fieldset {
      border: none;
      margin-bottom: 30px;
    }

    legend {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 20px;
      color: #2563eb;
    }

    /* ===== GRID ===== */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-group.full {
      grid-column: 1 / -1;
    }

    label {
      font-size: 0.85rem;
      margin-bottom: 6px;
      color: #64748b;
      font-weight: 600;
    }

    input,
    select,
    textarea {
      padding: 10px 14px;
      border-radius: 10px;
      border: 1px solid #e2e8f0;
      font-size: 0.95rem;
    }

    input:focus,
    select:focus,
    textarea:focus {
      outline: none;
      border-color: #2563eb;
    }

    /* ===== IMAGEN ===== */
    .img-preview {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-top: 10px;
    }

    .img-preview img {
      width: 140px;
      height: 140px;
      object-fit: cover;
      border-radius: 14px;
      border: 1px solid #e2e8f0;
      background: #f1f5f9;
    }

    /* ===== CHECKBOX ===== */
    .checkbox {
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 600;
      color: #334155;
      margin-top: 10px;
    }

    /* ===== BOTONES ===== */
    .actions {
      display: flex;
      gap: 14px;
      margin-top: 20px;
    }

    .btn {
      padding: 12px 24px;
      border-radius: 12px;
      border: none;
      font-size: 0.95rem;
      font-weight: 700;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-primary {
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      color: #ffffff;
      box-shadow: 0 10px 22px rgba(37,99,235,.4);
    }

    .btn-danger {
      background: #fee2e2;
      color: #991b1b;
    }

    .btn:hover {
      transform: translateY(-1px);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
      .content-base {
        margin-left: 0;
      }
    }

    @media (max-width: 640px) {
      .form-grid {
        grid-template-columns: 1fr;
      }

      .img-preview {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
</head>

<?php require_once APP . '/views/inc/admin/sidebarAdmin.php' ?>

<body>


<div class="content-base">

  <div class="card">
    <h1>✏️ Editar Producto</h1>

    <form action="/ventaPedido/productos/updateProducto"
          method="GET"
          enctype="multipart/form-data">

      <input type="hidden" name="idProducto" value="<?= $producto['idProducto'] ?>">

      <fieldset>
        <legend>📦 Información del producto</legend>

        <div class="form-grid">

          <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre"
                   value="<?= htmlspecialchars($producto['nombre']) ?>" required>
          </div>

          

          <div class="form-group full">
            <label>Descripción</label>
            <textarea name="descripcion" rows="3"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
          </div>

          <div class="form-group">
            <label>Categoría</label>
            <select name="idCategoria" required>
              <?php foreach ($categorias as $c): ?>
                <option value="<?= $c['idCategoria'] ?>"
                  <?= $c['idCategoria'] == $producto['idCategoria'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($c['descripcion']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Temática</label>
            <select name="idTematica" required>
              <?php foreach ($tematicas as $t): ?>
                <option value="<?= $t['idTematica'] ?>"
                  <?= $t['idTematica'] == $producto['idTematica'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($t['descripcion']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock"
                   value="<?= $producto['stock'] ?>" min="0" required>
          </div>

          <div class="form-group full">
            <label>Imagen del producto</label>

            <div class="img-preview">
              <?php if (!empty($producto['img'])): ?>
                <img src="public/img/productos/<?= $producto['img'] ?>">
              <?php else: ?>
                <img src="public/img/productos/default.png">
              <?php endif; ?>

              <input type="file" name="img" accept="image/*">
            </div>
          </div>

          <div class="form-group full">
            <div class="checkbox">
              <input type="checkbox" name="activo" value="1"
                <?= $producto['activo'] ? 'checked' : '' ?>>
              Producto activo
            </div>
          </div>

        </div>
      </fieldset>

      <div class="actions">
        <button type="submit" class="btn btn-primary">
          💾 Guardar cambios
        </button>

        <button type="button" onclick="cancelar()" class="btn btn-danger">
          ❌ Cancelar
        </button>
      </div>

    </form>
  </div>

</div>

<script>
function cancelar(){
  window.location.href = '/ventaPedido/inicio/inventario';
}
</script>

</body>
</html>
