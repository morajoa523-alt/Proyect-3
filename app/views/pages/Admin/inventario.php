<?php
session_start();

// Verificar administrador
/*if (!isset($_SESSION['admin'])) {
    header('Location: /ventaPedido/user/inicioSesionAdmin');
    exit();
}
*/
?>

<?php require_once APP . '/views/inc/admin/headerDatosProductos.php' ?>

<body>

  <div class="dashboard">
    <!-- Sidebar -->
<?php require_once APP . '/views/inc/admin/sidebarAdmin.php' ?>




    <!-- Main Content -->
    <div class="main-content">
      <!-- Mostrar mensajes de éxito/error -->
      <?php if (isset($_SESSION['success'])): ?>
        <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #bbf7d0;">
          <i class="fas fa-check-circle"></i> Producto eliminado correctamente<?php htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['error'])): ?>
        <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #fecaca;">
          <i class="fas fa-exclamation-triangle"></i> Se produjo un error al eliminar<?php htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>

      <div class="header">
        <div class="header-title">
          <h1>Gestión de Productos</h1>
        </div>
        
      </div>

      <div class="table-container">
        <div class="table-header">
          <h2 class="table-title">Lista de Productos</h2>
        </div>
        <table>
          <thead>
            <tr>
              <th>ID</th><th>Nombre</th><th>Stock</th>
              <th>Categoría</th><th>Estado</th><th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datosProductos as $product): ?>
            <tr>
              <td>#<?php echo $product['idProducto']; ?></td>
              <td>
                <div style="display:flex; align-items:center; gap:0.5rem;">
                  
                  <?php echo $product['nombre']; ?>
                </div>
              </td>
              
              <td><?php echo $product['stock']; ?></td>
              <td><?php echo $product['categoria']; ?></td>
              <td>
                <?php
                if ($product['stock'] > 10) {
                  $c='status-in-stock'; $t='En Stock';
                } elseif ($product['stock'] > 0) {
                  $c='status-low-stock'; $t='Stock Bajo';
                } else {
                  $c='status-out-stock'; $t='Sin Stock';
                }
                ?>
                <span class="status-badge <?php echo $c; ?>"><?php echo $t; ?></span>
              </td>
              <td>
                <div class="actions">

                  <form action="/ventaPedido/inicio/editarProducto" method="GET">
                    <input type="hidden" name="idProducto" value="<?= $product['idProducto']; ?>">
                  <button type="submit" name="submit" class="action-btn edit-btn" title="Editar" >
                    <i class="fas fa-edit"></i>
                  </button>
                  </form>

                  <form action="/ventaPedido/productos/eliminarProducto" method="GET">
                    <input type="hidden" name="idProducto" value="<?= $product['idProducto']; ?>">
                  <button onclick="deleteProduct(<?= $product['idProducto']; ?>)" type="submit" name="submit" class="action-btn delete-btn" title="Eliminar">
                    <i class="fas fa-trash"></i>
                  </button>
                 </form>

                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>

    </div>
  </div>

  <script>
    function deleteProduct(productId) {
      if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        window.location.href = `/ventaPedido/Productos/eliminarProducto?idProducto=${productId}`;
      }
    }

    // Agregar funcionalidad de búsqueda en tiempo real
    function addSearchFunctionality() {
      const searchInput = document.createElement('input');
      searchInput.type = 'text';
      searchInput.placeholder = 'Buscar productos...';
      searchInput.style.cssText = `
        padding: 0.5rem;
        border: 1px solid var(--border-color);
        border-radius: 0.375rem;
        margin-bottom: 1rem;
        width: 300px;
      `;
      
      const tableContainer = document.querySelector('.table-container');
      tableContainer.insertBefore(searchInput, tableContainer.firstChild);
      
      searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
          const productName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
          const category = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
          
          if (productName.includes(searchTerm) || category.includes(searchTerm)) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    }

    // Inicializar funcionalidades cuando carga la página
    document.addEventListener('DOMContentLoaded', function() {
      addSearchFunctionality();
    });
  </script>
</body>
</html>
