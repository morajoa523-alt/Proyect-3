
<?php require_once APP . '/views/inc/admin/headerInicioSesionAdmin.php'?>

<body>



  <div class="login-card">
    <h1>Iniciar Sesión</h1>
    <form action="/ventaPedido/user/validacionUser" method="POST">
      
      <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" name="email" placeholder="usuario@correo.com" required>
        <span class="icon">📧</span>
      </div>

      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" name="password" placeholder="********" required>
        <span class="icon">🔒</span>
      </div>

      <button type="submit" class="btn-login">Ingresar</button>

      <div class="links">
        ¿No tienes cuenta? <a href="/usuarios/registrar">Regístrate</a>
      </div>

    </form>
  </div>

</body>
</html>
