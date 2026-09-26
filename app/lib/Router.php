<?php
class Router
{
     public $rutas = [];
     public $controllers = [];

     public function __construct(){

       $this->rutas = ['inicio', 'user', 'productos','opciones','carrito','confirmarPago',
       'especificaciones','reportes', 'pedidos'];
       $this->controllers = ['interfacesController','userController','productoController'
       ,'opcionesProductosController','carritoController', 'formaPagoController',
       'especificacionesController','reportesController','pedidosController'];
       

     }

}
?>