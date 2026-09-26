<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class interfacesController extends Controller
{
      private $daoProd;
      private $daoEspe;
      private $daoCateg;
      private $daoUser;
      private $daoPedidos;
      private $daoDash;
      public function __construct(){

       $this->daoProd = new DaoProductos();
       $this->daoEspe = new DaoEspecificaciones();
       $this->daoCateg = new DaoCategorias();
       $this->daoUser = new DaoUsuarios();
       $this->daoPedidos = new DaoPedidos();
       $this->daoDash = new DaoDashboards();
    }


      public function inicioSesionComercial(){

      $datos = [];

        $this->render('inicioSesion', $datos);


      }

      

public function inicio()
{
    $tematicas = $this->daoEspe->listarTematicas();
    $productosXtematica = $this->daoProd->obtenerProductosXtematica();
   

    // CONTINÚA FLUJO NORMAL
    $datos = 
    [
     'tematicas' => $tematicas,
     'productosXtematicas' =>$productosXtematica
     
    ];
    $this->render('Comercial/interPrincipal', $datos);
}







      public function carrito(){

      $datos = [];

      $this->render('Comercial/interCarrito', $datos);
      }


      



  


public function prepararPago()
{
    // =============================
    // Asegurar sesión
    // =============================
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // =============================
    // Validar datos recibidos
    // =============================
    if (
        !isset($_GET['productos']) ||
        !isset($_GET['totalCosto']) ||
        !isset($_GET['datosProdCarrito'])
    ) {
        die('Error: Datos incompletos para el pago');
    }

    $productos  = $_GET['productos'];
    $totalCosto = (float) $_GET['totalCosto'];

    if ($totalCosto <= 0) {
        die('Error: Total inválido');
    }

    // =============================
    // Decodificar carrito
    // =============================
    $datosProdCarrito = json_decode($_GET['datosProdCarrito'], true);

    if (!$datosProdCarrito || !is_array($datosProdCarrito)) {
        die('Error: Carrito inválido');
    }

    // =============================
    // Construir datos de factura
    // =============================
    $datosFact = [];

    foreach ($datosProdCarrito as $i => $producto) {

        $cantidad = $productos[$i]['cantidad'] ?? 1;
        $precio   = $producto['precio'] ?? 0;

        $datosFact[] = [
            'nombreProd' => $producto['nombre'] ?? '',
            'descripcion'=> $producto['descripcion'] ?? '',
            'cantidad'   => (int) $cantidad,
            'precioUnit' => (float) $precio,
            'subTotal'   => number_format($precio * $cantidad, 2)
        ];
    }

    // =============================
    // Datos para la vista
    // =============================
    $datos = [
        'datosFact'  => $datosFact,
        'totalCosto' => number_format($totalCosto, 2)
    ];

    // =============================
    // Renderizar vista
    // =============================
    $this->render('Comercial/prepararPago', $datos);
}


//Metodos administrativos
 public function inicioSesionAdmin()
  {
    $datos = [
      "title" => "Inicio"
    ];
    $this->render('Admin/inicioSesionAdmin', $datos);
  }

   public function inicioSesionCliente()
  {
    $datos = [
      "title" => "Inicio"
    ];
    $this->render('Comercial/inicioSesionCliente', $datos);
  }


public function inicioAdmin()
  {
    $datos = [
      "title" => "Inicio"
    ];
    $this->render('Admin/inicioAdmin', $datos);
  }



public function inventario()
  {
    $productos = $this->daoProd->listarProductos();

$datos = [
    'datosProductos' => $productos
];

$this->render('Admin/inventario', $datos);
  }

 
  public function registrarProducto(){

        $tematicas   = $this->daoEspe->listarTematicas();
        $categorias  = $this->daoCateg->listarCategorias();
        // Especificaciones
        $dimensiones = $this->daoEspe->listarDimensiones();
        $modelos     = $this->daoEspe->listarModelos();
        $impresiones = $this->daoEspe->listarTiposImpresion();
        $piezas      = $this->daoEspe->listarCantidadPiezasYEdades();

$datos = [
'categorias'    => $categorias,
'tematicas'     => $tematicas,
'dimensiones'   => $dimensiones,
'modelos'       => $modelos,
'impresiones'   => $impresiones,
'piezas'        => $piezas
];

$this->render('Admin/registrarProducto', $datos);

}


public function editarProducto() {

    if (!isset($_GET['idProducto'])) {
        
    }

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
}


public function registerAndEditEspecificaciones(){


        // Obtener datos
        $dimensiones       = $this->daoEspe->listarDimensiones();
        $modelos           = $this->daoEspe->listarModelos();
        $tiposImpresion    = $this->daoEspe->listarTiposImpresion();
        $cantidadPiezas    = $this->daoEspe->listarCantidadPiezasYEdades();


$datos = [
  'dimensiones'    => $dimensiones,
  'modelos'        => $modelos,
  'tiposImpresion' => $tiposImpresion,
  'cantidadPiezas' => $cantidadPiezas
];
 $this->render('Admin/registerAndEditEspecificaciones', $datos);


}

public function users()
  {
    session_start();
    $datosRolUser = $this->daoUser->selectTiposUsuario();
    $datosUsers = $this->daoUser->selectUsuarios();
    $datosUserLogueado = $this->daoUser->selectUsuario($_SESSION['usuario']['id_usuario']);

      $datos = [
      "tiposUsuario" => $datosRolUser,
      "usuarioLogueado" => $datosUserLogueado,
      "usuarios"  => $datosUsers 

      

    ];
    //print_r($datos['meses']);
    $this->render('Admin/userAndRegisterUser', $datos);
  }

public function panelUser()
  {
      $datos = [
      "usuario" => ""
      

    ];
    //print_r($datos['meses']);
    $this->render('panelUserNoAdmin', $datos);
  }


  public function editarUsuario(){

  $id = $_POST['id_usuario'] ?? 0;
  $datosUser = $this->daoUser->selectUsuario($id);
  $correo = $_POST['correo'] ?? '';

  $datos = [
    "idUsuario" => $id,
    "correo" => $correo,
    "datosUsuario" => $datosUser
  ];


  $this->render('Admin/edicionDatosUser', $datos);
 }



  public function reportes(){
     $datos = [
      'hola' => ''
     ];

      $this->render('Admin/reportes', $datos);
  }


  public function panelPedidos(){
      $pedidos = $this->daoPedidos->listarPedidos();
      $datos = [
        'pedidos' => $pedidos
      ];
      $this->render('Admin/pedidos', $datos);
  }

  public function registroUser(){
      
      $datos = [
        'kkkk' => ''
      ];
      $this->render('Comercial/registrarUser', $datos);
  }

  public function dashboardVentas()
{
    $ventas = $this->daoDash->obtenerVentasMensuales();
    $productosTop = $this->daoDash->obtenerProductoMasVendidoPorMes();
   
    // Convertir ventas en array 12 meses
    $meses = array_fill(1, 12, 0);
    $totalAnual = 0;

    foreach ($ventas as $v) {
        $meses[$v['mes']] = $v['total_mes'];
        $totalAnual += $v['total_mes'];
    }

    // Calcular porcentaje
    $porcentajes = [];
    foreach ($meses as $mes => $valor) {
        $porcentajes[$mes] = $totalAnual > 0 
            ? round(($valor / $totalAnual) * 100, 2) 
            : 0;
    }

    $datos = [
        "title" => "Dashboard Ventas",
        "ventasMensuales" => $meses,
        "porcentajes" => $porcentajes,
        "productosTop" => $productosTop,
        "totalAnual" => $totalAnual

    ];

    

    $this->render('Admin/dashboards', $datos);
}


} 

?>
