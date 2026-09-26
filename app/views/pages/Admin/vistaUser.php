<?php require_once APP . '/views/inc/admin/headerVistaUser.php' ?>
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


<!-- CONTINUACIÓN DEL BODY -->
<div class="content">
  <div class="card" style="max-width: 900px;">
    <h1>Usuarios Registrados</h1>

    <table style="width:100%; border-collapse: collapse; margin-top: 20px;">
      <thead>
        <tr style="background:#2563eb; color:#fff;">
          <th style="padding:12px; text-align:left;">ID</th>
          <th style="padding:12px; text-align:left;">Nombre</th>
          <th style="padding:12px; text-align:left;">Email</th>
          <th style="padding:12px; text-align:left;">Rol</th>
          <th style="padding:12px; text-align:left;">Fecha Registro</th>
          <th style="padding:12px; text-align:center;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($datos['usuarios'])): ?>
            <?php foreach($datos['usuarios'] as $usuario): ?>
                <tr style="border-bottom:1px solid #e5e7eb;">
                  <td style="padding:10px;"><?php echo htmlspecialchars($usuario['idusuario']); ?></td>
                  <td style="padding:10px;"><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                  <td style="padding:10px;"><?php echo htmlspecialchars($usuario['email']); ?></td>
                  <td style="padding:10px;"><?php echo htmlspecialchars($usuario['rol']); ?></td>
                  <td style="padding:10px;"><?php echo htmlspecialchars($usuario['fecharegistro']); ?></td>
                  <td style="padding:10px; text-align:center;">
                    <a href="editarUsuario.php?id=<?php echo $usuario['idusuario']; ?>" class="btn-primary">Editar</a>
                    <a href="eliminarUsuario.php?id=<?php echo $usuario['idusuario']; ?>" class="btn-secondary" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
                  </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
              <td colspan="6" style="padding:10px; text-align:center; color:#6b7280;">No hay usuarios registrados.</td>
            </tr>
        <?php endif; ?>
      </tbody>
    </table>

  </div>
</div>



    

  <!-- layout -->

           </body>
    </html>
