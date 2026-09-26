# ventaPedido — Tienda en línea de juegos de mesa

Aplicación web de comercio electrónico para la venta de juegos de mesa, desarrollada en **PHP puro** con arquitectura **MVC**. Permite a los clientes explorar el catálogo por temática, personalizar su pedido (dimensiones, modelo, tipo de impresión, edad recomendada) y pagarlo con tarjeta simulada, mientras que el panel de administración gestiona productos, usuarios, pedidos y reportes.

## Funcionalidades principales

### Cliente
- Catálogo de productos organizado por **temática** (ej. safari, mundo, cartas).
- Carrito de compras con selección de opciones/especificaciones por producto.
- Flujo de pago con validación contra tarjetas de prueba (VISA, Mastercard, Amex, Discover) y saldo simulado.
- Envío de correo de confirmación de compra (vía PHPMailer).
- Registro e inicio de sesión de cliente, e historial de compras del usuario.

### Administrador
- Gestión de inventario y productos (alta, edición, activar/desactivar).
- Gestión de especificaciones (dimensiones, modelos, tipos de impresión, piezas y edades).
- Gestión de usuarios y roles (Admin / Cliente).
- Panel de pedidos con cambio de estado.
- Exportación del inventario a Excel.

## Arquitectura técnica

- **Patrón:** MVC hecho a mano (sin framework), con un `Core`/`Router` propio que resuelve rutas desde `?url=` mediante `.htaccess` y `mod_rewrite`.
- **Backend:** PHP + PDO (MySQL), autoload propio vía `spl_autoload_register`.
- **Base de datos:** MySQL, esquema `GestionTienda` (ver `datapedidos (1).sql`) con tablas para usuarios/roles, categorías, temáticas, productos, especificaciones (dimensiones, modelos, impresión, piezas, edad), pedidos y detalle de pedidos, y tarjetas de prueba.
- **Correo:** PHPMailer (`composer.json`) para el envío de confirmación de pedido.
- **Frontend:** HTML/CSS (Bootstrap) y JavaScript por vista, organizado en `public/css` y `public/js`.

## Estructura del proyecto

```
app/
 ├─ controllers/   # Lógica de cada módulo (productos, carrito, pagos, pedidos, usuarios, reportes...)
 ├─ models/        # DAOs de acceso a datos (Productos, Usuarios, Pedidos, Especificaciones...)
 ├─ views/          # Vistas separadas en pages/Admin y pages/Comercial
 ├─ lib/            # Core y Router del framework casero
 ├─ helpers/        # Sesiones, cookies, ayudante de validación de tarjeta
 └─ config/         # Configuración de la app y conexión a BD
public/
 ├─ index.php       # Punto de entrada
 ├─ css/ js/ img/    # Recursos estáticos
datapedidos (1).sql # Script de creación y datos de prueba de la base de datos
```

## Instalación local

1. Clonar/copiar el proyecto en el servidor (ej. `htdocs/ventaPedido`).
2. Crear la base de datos `GestionTienda` e importar `datapedidos (1).sql`.
3. Ajustar credenciales de conexión en `app/config/conexionbd.php` si es necesario.
4. Ajustar la URL base en `app/config/config.php` (`URL`) según el entorno.
5. Ejecutar `composer install` para instalar PHPMailer.
6. Servir el proyecto con Apache (mod_rewrite habilitado) apuntando a la carpeta `public/`.

## Notas

- Las tarjetas de pago son **de prueba**; no se procesan pagos reales.

