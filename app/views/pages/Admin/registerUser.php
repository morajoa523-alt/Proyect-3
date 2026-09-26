<?php require_once APP . '/views/inc/admin/headerRegisterUser.php' ?>
<body>


<div class="layout">
<?php require_once APP . '/views/inc/admin/sidebarAdmin.php' ?>


  <!-- MAIN -->
  <div class="main">

    <!-- HEADER -->
    <header class="topbar">
      <div class="logo">Panel Admin</div>
      <div class="menu-actions">
        <button>👤 Perfil</button>
        <button>🔔 Notificaciones</button>
      </div>
    </header>

    <!-- CONTENT -->
    <section class="content">
      <div class="card">
        <h1>Registrar Usuario</h1>
        <form action="insertUser" method="POST">
          <label for="nombre">Nombre completo</label>
          <input type="text" id="nombre" name="nombre" required>

          <label for="email">Correo electrónico</label>
          <input type="email" id="email" name="email" required>

          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" required>

          <label for="rol">Rol de usuario</label>
          <select id="rol" name="rol" required>
            <option value="">Seleccione un rol</option>
            <option value="admin">Administrador</option>
            <option value="almacen">Almacén</option>
            <option value="ventas">Ventas</option>
            <option value="usuario">Usuario</option>
          </select>

          <div class="form-actions">
            <button type="submit" class="btn-primary">Registrar</button>
            <button type="reset" class="btn-secondary">Limpiar</button>
          </div>
        </form>
      </div>
    </section>

  </div> <!-- main -->
</div> <!-- layout -->

</body>
</html>




 <fieldset>
        <legend>Datos del Producto</legend>

        <label>Nombre del producto</label>
        <input type="text" name="nombre" required>

        <label>Descripción</label>
        <textarea name="descripcion" rows="3"></textarea>

        <label>Categoría</label>
        <select name="idCategoria" required>
            <option value="">Seleccione</option>
            <?php foreach ($categorias as $c): ?>
                <option value="<?= $c['idCategoria'] ?>">
                    <?= htmlspecialchars($c['descripcion']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Temática</label>
        <select name="idTematica" required>
            <option value="">Seleccione</option>
            <?php foreach ($tematicas as $t): ?>
                <option value="<?= $t['idTematica'] ?>">
                    <?= htmlspecialchars($t['descripcion']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Stock</label>
        <input type="number" name="stock" min="0" required>

        <label>Imagen</label>
        <input type="file" name="img">

        <label style="margin-top:15px;">
            <input type="checkbox" name="activo" value="1" checked>
            Producto activo
        </label>
    </fieldset>