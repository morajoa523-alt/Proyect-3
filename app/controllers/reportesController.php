<?php 
class reportesController extends Controller
{

   private $daoProd;
   public function __construct(){
           $this->daoProd = new DaoProductos();
   }
    public function exportarInventarioExcel() {
        
        $productos = $this->daoProd->listarProductos();

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=reporte_inventario.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "<table border='1'>";
        echo "<tr style='background:#f2f2f2'>
                <th>ID</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Stock</th>
                <th>Activo</th>
              </tr>";

        foreach ($productos as $p) {
            echo "<tr>
                    <td>{$p['idProducto']}</td>
                    <td>{$p['nombre']}</td>
                    <td>{$p['categoria']}</td>
                    <td>{$p['descripcion']}</td>
                    <td>{$p['stock']}</td>
                    <td>" . ($p['activo'] ? 'SI' : 'NO') . "</td>
                  </tr>";
        }

        echo "</table>";
        exit;
    }



}
?>