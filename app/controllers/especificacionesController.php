<?php

class EspecificacionesController extends Controller{

    private $daoEspe;
    public function __construct() {

        $this->daoEspe = new DaoEspecificaciones();

    }

/* =========================================
       DIMENSIONES
       ========================================= */
    public function insertDimension() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->insertarDimension(
                $_GET['anchoDimension'],
                $_GET['largoDimension'],
                $_GET['tiempoExtraDimension'],
                $_GET['costoExtraDimension']
            );
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    public function updateDimension() {
   
        if (isset($_GET['submit'])) {
            $this->daoEspe->actualizarDimension(
                $_GET['idDimension'],
                $_GET['anchoDimension'] ?? 0,
                $_GET['largoDimension'] ?? 0,
                $_GET['tiempoExtraDimension'] ?? 0,
                $_GET['costoExtraDimension'] ?? 0
            );
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    public function deleteDimension() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->eliminarDimension($_GET['idDimension']);
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    /* =========================================
       MODELOS
       ========================================= */
    public function insertModelo() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->insertarModelo(
                $_GET['descripcionModelo'],
                $_GET['tiempoExtraModelo'],
                $_GET['costoExtraModelo']
            );
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    public function updateModelo() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->actualizarModelo(
                $_GET['idModelo'],
                $_GET['descripcionModelo'] ?? '',
                $_GET['tiempoExtraModelo'] ?? 0,
                $_GET['costoExtraModelo'] ?? 0
            );
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    public function deleteModelo() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->eliminarModelo($_GET['idModelo']);
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    /* =========================================
       TIPO IMPRESIÓN
       ========================================= */
    public function insertTipoImpresion() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->insertarTipoImpresion(
                $_GET['descripcionTipoImpresion'],
                $_GET['tiempoExtraTipoImpresion'],
                $_GET['costoExtraTipoImpresion']
            );
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    public function updateTipoImpresion() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->actualizarTipoImpresion(
                $_GET['idTipoImpresion'],
                $_GET['descripcionTipoImpresion'] ?? '',
                $_GET['tiempoExtraTipoImpresion'] ?? 0,
                $_GET['costoExtraTipoImpresion'] ?? 0
            );
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    public function deleteTipoImpresion() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->eliminarTipoImpresion($_GET['idTipoImpresion']);
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    /* =========================================
       CANTIDAD DE PIEZAS
       ========================================= */
    public function insertCantidadPiezas() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->insertarCantidadPiezas(
                $_GET['cantidadCantidadPiezas'],
                $_GET['tiempoXpiezaCantidadPiezas'],
                $_GET['costoXpiezaCantidadPiezas'],
                $_GET['edadRecomendadaCantidadPiezas']
            );
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    public function updateCantidadPiezas() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->actualizarCantidadPiezas(
                $_GET['idCantidadPiezas'],
                $_GET['cantidadCantidadPiezas'] ?? 0,
                $_GET['tiempoXpiezaCantidadPiezas'] ?? 0,
                $_GET['costoXpiezaCantidadPiezas'] ?? 0,
                $_GET['edadRecomendadaCantidadPiezas'] ?? 0
            );
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }

    public function deleteCantidadPiezas() {

        if (isset($_GET['submit'])) {
            $this->daoEspe->eliminarCantidadPiezas($_GET['idCantidadPiezas']);
        }

        header('Location: /ventaPedido/inicio/registerAndEditEspecificaciones');
        exit;
    }


}

?>