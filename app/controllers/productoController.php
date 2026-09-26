<?php
class productoController extends Controller
{
    private $daoProd;
    private $daoEspe;
    private $daoCateg;

    public function __construct(){

    $this->daoProd = new DaoProductos();
    
    $this->daoEspe = new DaoEspecificaciones();
    $this->daoCateg = new DaoCategorias();
    

    }

public function productoXtematica(){

$productosXtematica = $this->daoProd->obtenerProductosXtematica();


}


    /* ==========================================
       GUARDAR PRODUCTO
       ========================================== */
    public function insertProducto() {

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Location: /ventaPedido/inicio/registrarProducto');
            exit;
        }

        $dataProducto = [
            'idCategoria' => $_GET['idCategoria'],
            'idTematica'  => $_GET['idTematica'],
            'nombre'      => $_GET['nombre'],
            'descripcion' => $_GET['descripcion'],
            'stock'       => $_GET['stock'],
            'img'         => $_GET['img'],
            'activo'      => isset($_GET['activo']) ? 1 : 0
        ];

        $resultado = $this->daoProd->insertarProducto($dataProducto);

        if ($resultado) {
            header('Location: /ventaPedido/inicio/registrarProducto');
        } else {
            echo "Error al registrar producto";
        }
    }





public function updateProducto() {

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        header('Location: /ventaPedido/inicio/editarProducto/' . $_GET['idProducto']);
        exit;
    }

    $data = [
        'idProducto'   => $_GET['idProducto'],
        'idCategoria'  => $_GET['idCategoria'],
        'idTematica'   => $_GET['idTematica'],
        'nombre'       => $_GET['nombre'],
        'descripcion'  => $_GET['descripcion'],
        'stock'        => $_GET['stock'],
        'img'          => $_GET['img'],
        'activo'       => isset($_GET['activo']) ? 1 : 0
    ];

    $resultado = $this->daoProd->actualizarProducto($data);

    if ($resultado) {
        $idProducto = $_GET['idProducto'];
        

    // Producto base
    $producto = $this->daoProd->obtenerProducto($idProducto);

    if (!$producto) {
        echo "Producto no encontrado";
        exit;
    }

    // Listas necesarias para selects
    $categorias  = $this->daoCateg->listarCategorias();
    $tematicas   = $this->daoEspe->listarTematicas();
    $dimensiones = $this->daoEspe->listarDimensiones();
    $modelos     = $this->daoEspe->listarModelos();
    $impresiones = $this->daoEspe->listarTiposImpresion();
    $piezas      = $this->daoEspe->listarCantidadPiezasYEdades();

    // Cargar vista
    $datos = [
      'producto'      => $producto,
      'categorias'    => $categorias,
      'tematicas'     => $tematicas,
      'dimensiones'   => $dimensiones,
      'modelos'       => $modelos,
      'impresiones'   => $impresiones,
      'piezas'        => $piezas
];

    $this->render('Admin/editarProducto', $datos);


    } else {
        echo "Error al actualizar el producto";
    }
}

public function eliminarProducto(){
    
    session_start();

if (isset($_GET['submit'])) {
    $productId = intval($_GET['idProducto']);
    if ($this->daoProd->eliminarProducto($productId)) {
        
        $_SESSION['success'] = 'Producto eliminado correctamente';
    } else {
        $_SESSION['error'] = 'Error al eliminar el producto';
    }
    
    header('Location: /ventaPedido/inicio/inventario');
    exit();
}

// Cargar productos
$productos = $this->daoProd->listarProductos();

$datos = [
    'datosProductos' => $productos
];

$this->render('Admin/inventario', $datos);

}

}

?>