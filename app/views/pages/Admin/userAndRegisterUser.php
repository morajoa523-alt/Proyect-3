<?php require_once APP . '/views/inc/admin/headerUserAndRegisterUser.php'; ?>

<body>
<?php require_once APP . '/views/inc/admin/sidebarAdmin.php'; ?>


<div class="content-base">

    <!-- =============================
         BLOQUE SUPERIOR (60% ALTO)
    ============================== -->
    <div class="top-panels">

        <!-- =====================
             USUARIO LOGUEADO
        ====================== -->
        <section class="panel panel-user">
            <h2>Perfil del usuario</h2>

            <div class="user-card">
                <div class="user-row">
                    <span class="label">Correo</span>
                    <span class="value">
                        <?= htmlspecialchars($_SESSION['usuario']['correo'] ?? '') ?>
                    </span>
                </div>

                <div class="user-row">
                    <span class="label">Rol</span>
                    <span class="value">
                        <?= htmlspecialchars($_SESSION['usuario']['rol'] ?? '') ?>
                    </span>
                </div>

                <div class="user-row">
                    <span class="label">ID</span>
                    <span class="value">
                        <?= htmlspecialchars($_SESSION['usuario']['id_usuario'] ?? '') ?>
                    </span>
                </div>

                <form method="POST" action="/ventaPedido/inicio/editarUsuario" class="inline-form">
                <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($_SESSION['usuario']['id_usuario'] ?? '') ?>">
                <input type="hidden" name="correo" value="<?= htmlspecialchars($_SESSION['usuario']['correo'] ?? '') ?>">
                <button type="submit" class="btn-edit">
                Editar
                </button>
                </form>
            </div>
        </section>

        <!-- =====================
             REGISTRO DE USUARIOS
        ====================== -->
        <section class="panel panel-register">
            <h2>Registrar nuevo usuario</h2>

            <form class="form-user" method="post" action="/ventaPedido/user/insertUser">
                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" name="correo" id="correo" required>
                </div>

                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" required>
                </div>

                <div class="form-group">
                    <label for="id_tipo">Rol</label>
                    <select name="id_tipo" id="id_tipo" required>
                        <?php foreach ($tiposUsuario as $tipo): ?>
                            <option value="<?= $tipo['idRol'] ?>">
                                <?= htmlspecialchars($tipo['descripcion']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn-primary">
                    Registrar usuario
                </button>
            </form>
        </section>

    </div>

    <!-- =============================
         TABLA USUARIOS (100% ANCHO)
    ============================== -->
    <section class="panel panel-table">
        <h2>Usuarios registrados</h2>

        <div class="table-container">
            <table class="tabla-usuarios">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $user): ?>
                            <tr>
                                <td><?= (int) $user['idUsuario'] ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <?php foreach($tiposUsuario as $tipoUser){
                                 if($tipoUser['idRol'] === $user['idRol']){ ?>
                                <td><?= htmlspecialchars($tipoUser['descripcion']) ?></td>
                                         
                                <?PHP break; 
                                  } 
                                } ?>
                                <td class="acciones">
                                    
                                    <form method="POST" action="/ventaPedido/user/deleteUser" class="inline-form">
                                        <input type="hidden" name="id_usuario" value="<?= $user['idUsuario'] ?>">
                                        <button type="submit" name="submit" class="btn-delete"
                                                onclick="return confirm('¿Eliminar este usuario?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="empty">
                                No hay usuarios registrados
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
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


