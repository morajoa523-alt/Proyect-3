
<?php
/*session_start();
if (!isset($_SESSION['idusuario']) || $_SESSION['rol'] !== 'ADMIN') {
    header("Location: views/inicioSesionAdmin");
    exit();
}*/
?>
<?php require_once APP . '/views/inc/admin/headerInicioAdmin.php'?>


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
    

  </div> <!-- main -->
</div> <!-- layout -->

</body>
</html>
