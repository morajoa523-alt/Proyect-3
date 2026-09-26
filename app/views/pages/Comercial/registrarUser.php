

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de usuario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    /* =========================
       VARIABLES
    ========================= */
    :root {
      --primary: #032757;
      --primary-hover: #1e40af;
      --bg: #f8fafc;
      --panel: #ffffff;
      --text: #0f172a;
      --muted: #64748b;
      --border: #e2e8f0;
      --radius: 12px;
      --shadow: 0 12px 30px rgba(0,0,0,.12);
    }

    /* =========================
       RESET
    ========================= */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      background: var(--bg);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text);
    }

    /* =========================
       CONTENEDOR
    ========================= */
    .auth-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      max-width: 900px;
      width: 100%;
      background: var(--panel);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
    }

    /* =========================
       PANEL IZQUIERDO
    ========================= */
    .auth-aside {
      background: linear-gradient(135deg, var(--primary), #2563eb);
      color: #ffffff;
      padding: 48px 36px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 20px;
    }

    .auth-aside h1 {
      font-size: 1.9rem;
    }

    .auth-aside p {
      font-size: 0.95rem;
      opacity: 0.9;
      line-height: 1.6;
    }

    .auth-aside ul {
      list-style: none;
      font-size: 0.9rem;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .auth-aside li::before {
      content: "✔";
      margin-right: 8px;
      color: #a5f3fc;
    }

    /* =========================
       FORMULARIO
    ========================= */
    .auth-form {
      padding: 40px;
    }

    .auth-form h2 {
      font-size: 1.5rem;
      margin-bottom: 8px;
    }

    .auth-form span {
      font-size: 0.85rem;
      color: var(--muted);
    }

    form {
      margin-top: 28px;
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    label {
      font-size: 0.85rem;
      font-weight: 500;
    }

    input {
      padding: 12px 14px;
      border-radius: 10px;
      border: 1px solid var(--border);
      font-size: 0.95rem;
      outline: none;
    }

    input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(3,39,87,.15);
    }

    /* =========================
       GRID DOBLE
    ========================= */
    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }

    /* =========================
       BOTÓN
    ========================= */
    .btn-submit {
      margin-top: 10px;
      padding: 14px;
      background: linear-gradient(135deg, var(--primary), var(--primary-hover));
      color: #ffffff;
      border: none;
      border-radius: 12px;
      font-size: 0.95rem;
      cursor: pointer;
      transition: transform .15s ease, box-shadow .15s ease;
    }

    .btn-submit:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(0,0,0,.2);
    }

    /* =========================
       FOOTER FORM
    ========================= */
    .auth-footer {
      margin-top: 16px;
      font-size: 0.85rem;
      text-align: center;
    }

    .auth-footer a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 768px) {
      .auth-container {
        grid-template-columns: 1fr;
      }

      .auth-aside {
        display: none;
      }
    }
  </style>
</head>
<body>

  <div class="auth-container">

    <!-- PANEL IZQUIERDO -->
    <aside class="auth-aside">
      <h1>Bienvenido</h1>
      <p>Regístrate y accede a una experiencia de compra rápida, segura y personalizada.</p>
      <ul>
        <li>Historial de pedidos</li>
        <li>Pagos rápidos</li>
        <li>Promociones exclusivas</li>
      </ul>
    </aside>

    <!-- FORMULARIO -->
    <section class="auth-form">
      <h2>Crear cuenta</h2>
      <span>Completa el formulario para registrarte</span>

      <form method="POST" action="">
        <div class="grid-2">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" placeholder="Juan">
          </div>
          <div class="form-group">
            <label>Apellido</label>
            <input type="text" placeholder="Pérez">
          </div>
        </div>

        <div class="form-group">
          <label>Correo electrónico</label>
          <input type="email" placeholder="correo@ejemplo.com">
        </div>

        <div class="grid-2">
          <div class="form-group">
            <label>Contraseña</label>
            <input type="password" placeholder="••••••••">
          </div>
          <div class="form-group">
            <label>Confirmar contraseña</label>
            <input type="password" placeholder="••••••••">
          </div>
        </div>

        <button class="btn-submit">Crear cuenta</button>
      </form>

      <div class="auth-footer">
        ¿Ya tienes cuenta?
        <a href="/ventaPedido/inicio/inicioSesionCliente">Inicia sesión</a>
      </div>
    </section>

  </div>

</body>
</html>
