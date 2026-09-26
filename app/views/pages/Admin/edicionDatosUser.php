<?php require_once APP . '/views/inc/admin/headerEditUser.php' ?>
<body>
<?php require_once APP . '/views/inc/admin/sidebarAdmin.php' ?>

<?php
$sesion = $_SESSION['usuario'];
$isAdmin = $sesion['rol'] === 'ADMIN';
$isPropio = $sesion['id_usuario'] == $idUsuario;
$puedeEditar = $isPropio;
?>

<div class="content-base">

  <section class="panel-user">

    <header class="panel-header">
      <h2>Editar usuario</h2>
      <p>
        <?= $puedeEditar
            ? 'Actualiza tu información'
            : 'Vista de información del usuario'
        ?>
      </p>
    </header>

    <form class="form-user" method="post" action="/ventaPedido/user/updateUser">

      <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($idUsuario) ?>">

      <div class="form-grid">


      

        <!-- CORREO -->
        <div class="form-group">
          <label>Correo electrónico</label>
          <input
            type="email"
            name="correo"
            value="<?= htmlspecialchars($datosUsuario['email']) ?>"
            <?= $puedeEditar ? 'required' : 'readonly disabled' ?>
          >
        </div>

        <!-- CONTRASEÑA -->
         
        <div class="form-group">
          <label>Nueva contraseña</label>
          <input
            type="password"
            name="contrasena"
            placeholder="<?= $puedeEditar ? 'Dejar vacío para no cambiar' : '*************************************' ?>"
            <?= $puedeEditar ? '' : 'readonly disabled' ?>
          >
        </div>
        
        <!-- NOMBRES -->
        <div class="form-group">
          <label>Nombre</label>
          <input
            type="text"
            name="nombre"
            value="<?= htmlspecialchars($datosUsuario['nombre']) ?>"
            <?= $puedeEditar ? '' : 'readonly disabled' ?>
          >
        </div>


        <!-- SOLO ADMIN PUEDE CAMBIAR TIPO (A OTROS) -->
        <?php if ($isAdmin && !$isPropio): ?>
        <div class="form-group">
          <label>Tipo de usuario</label>
          <select name="id_tipo">
            <option value="1" <?= $datosUsuario['id_tipo'] == 1 ? 'selected' : '' ?>>Administrador</option>
            <option value="2" <?= $datosUsuario['id_tipo'] == 2 ? 'selected' : '' ?>>Analista</option>
            <option value="3" <?= $datosUsuario['id_tipo'] == 3 ? 'selected' : '' ?>>Usuario Avanzado</option>
          </select>
        </div>

        <button type="submit" name="submit" class="btn-primary">Guardar cambios</button>
        
        <?php endif; ?>

      </div>

      <!-- BOTONES -->
      <div class="form-actions">
        <?php if ($puedeEditar): ?>
          <button type="submit" class="btn-primary">Guardar cambios</button>
        <?php endif; ?>

        <a href="/ventaPedido/inicio/users" class="btn-secondary">Volver</a>
      </div>

    </form>

  </section>

</div>
</body>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const yearInput = document.getElementById('yearInput');
    const btnPrev = document.getElementById('yearPrev');
    const btnNext = document.getElementById('yearNext');

    const MIN_YEAR = 2000;
    const MAX_YEAR = new Date().getFullYear();

    function updateYear(delta) {
        let year = parseInt(yearInput.value, 10);

        if (isNaN(year)) {
            year = MAX_YEAR;
        }

        year += delta;

        if (year < MIN_YEAR) year = MIN_YEAR;
        if (year > MAX_YEAR) year = MAX_YEAR;

        // 🔥 CAMBIO INMEDIATO EN PANTALLA
        yearInput.value = year;
    }

    btnPrev.addEventListener('click', () => updateYear(-1));
    btnNext.addEventListener('click', () => updateYear(1));
});
</script>


</html>
