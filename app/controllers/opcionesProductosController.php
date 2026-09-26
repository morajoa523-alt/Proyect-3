<?php
class opcionesProductosController extends Controller
{
    private $daoEsp;

    public function __construct(){

      $this->daoEsp = new DaoEspecificaciones();

    }

public function opciones()
{
    // Iniciar sesión si no está iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    

    // Decodificar carrito
    $carrito = json_decode($_POST['carrito'], true);


    if (!$carrito || !is_array($carrito)) {
        die('Error: Carrito inválido');
    }

    /*
     |-------------------------------------------------
     | Guardar datos en sesión
     |-------------------------------------------------
     */
    $_SESSION['carrito'] = $carrito;
    /*
     |-------------------------------------------------
     | Datos adicionales para la vista
     |-------------------------------------------------
     */
    $tipoImpresion  = $this->daoEsp->listarTiposImpresion();
    $cantidadPiezasYedades = $this->daoEsp->listarCantidadPiezasYedades();
    /*
     |-------------------------------------------------
     | Preparar datos para la vista
     |-------------------------------------------------
     */
    
    $datos = [
        'datosProdCarrito'        => $carrito,
        'tipoImpresion'           => $tipoImpresion,
        'cantidadPiezasYedades'          => $cantidadPiezasYedades
        
    ];


    $_SESSION['datosCarrito'] = $datos;



    $this->render('Comercial/opciones', []);
}




}
?>