<?php

class DaoDetallesPedidos {

    private $cn;

    public function __construct() {
        $this->cn = (new conexionbd())->conectar();
    }

    /* =====================================================
       INSERTAR DETALLE DE PEDIDO
       ===================================================== */
    public function insertarDetalle($data) {

        $sql = "INSERT INTO detallesPedidos (
                    idPedido,
                    idProducto,
                    idDimension,
                    idModelo,
                    idTematica,
                    idTipoImpresion,
                    idCantidadPiezas,
                    cantidad,
                    costoUnitario,
                    tiempoUnitario,
                    subTotal
                ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->cn->prepare($sql);

        return $stmt->execute([
            $data['idPedido'],
            $data['idProducto'],
            $data['idDimension'],
            $data['idModelo'],
            $data['idTematica'],
            $data['idTipoImpresion'],
            $data['idCantidadPiezas'],
            $data['cantidad'],
            $data['costoUnitario'],
            $data['tiempoUnitario'],
            $data['subTotal']
        ]);
    }

    /* =====================================================
       LISTAR DETALLES POR PEDIDO (INFORMACIÓN COMPLETA)
       ===================================================== */
    public function listarPorPedido($idPedido) {

        $sql = "SELECT
                    dp.idDetalle,
                    dp.cantidad,
                    dp.costoUnitario,
                    dp.tiempoUnitario,
                    dp.subTotal,

                    p.nombre AS producto,
                    p.tiempoBaseProduccion,
                    p.costoBaseProduccion,

                    d.ancho,
                    d.largo,
                    d.tiempoExtra AS tiempoDimension,
                    d.costoExtra AS costoDimension,

                    m.descripcion AS modelo,
                    m.tiempoExtra AS tiempoModelo,
                    m.costoExtra AS costoModelo,

                    t.descripcion AS tematica,

                    ti.descripcion AS tipoImpresion,
                    ti.tiempoExtra AS tiempoImpresion,
                    ti.costoExtra AS costoImpresion,

                    cp.cantidad AS piezas,
                    cp.tiempoPorPieza,
                    cp.costoPorPieza

                FROM detallesPedidos dp
                INNER JOIN productos p ON dp.idProducto = p.idProducto
                INNER JOIN dimensiones d ON dp.idDimension = d.idDimension
                INNER JOIN modelosProductos m ON dp.idModelo = m.idModelo
                INNER JOIN tematicasProductos t ON dp.idTematica = t.idTematica
                INNER JOIN tipoImpresionProductos ti ON dp.idTipoImpresion = ti.idTipoImpresion
                INNER JOIN cantidadPiezasProductos cp ON dp.idCantidadPiezas = cp.idCantidadPiezas
                WHERE dp.idPedido = ?";

        $stmt = $this->cn->prepare($sql);
        $stmt->execute([$idPedido]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       OBTENER UN DETALLE ESPECÍFICO
       ===================================================== */
    public function obtenerDetalle($idDetalle) {

        $sql = "SELECT * FROM detallesPedidos WHERE idDetalle = ?";
        $stmt = $this->cn->prepare($sql);
        $stmt->execute([$idDetalle]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       ACTUALIZAR DETALLE
       ===================================================== */
    public function actualizarDetalle($data) {

        $sql = "UPDATE detallesPedidos SET
                    idDimension = ?,
                    idModelo = ?,
                    idTematica = ?,
                    idTipoImpresion = ?,
                    idCantidadPiezas = ?,
                    cantidad = ?,
                    costoUnitario = ?,
                    tiempoUnitario = ?,
                    subTotal = ?
                WHERE idDetalle = ?";

        $stmt = $this->cn->prepare($sql);

        return $stmt->execute([
            $data['idDimension'],
            $data['idModelo'],
            $data['idTematica'],
            $data['idTipoImpresion'],
            $data['idCantidadPiezas'],
            $data['cantidad'],
            $data['costoUnitario'],
            $data['tiempoUnitario'],
            $data['subTotal'],
            $data['idDetalle']
        ]);
    }

    /* =====================================================
       ELIMINAR DETALLE
       ===================================================== */
    public function eliminarDetalle($idDetalle) {

        $sql = "DELETE FROM detallesPedidos WHERE idDetalle = ?";
        $stmt = $this->cn->prepare($sql);
        return $stmt->execute([$idDetalle]);
    }

    /* =====================================================
       CALCULAR TOTALES DEL PEDIDO
       ===================================================== */
    public function calcularTotalesPedido($idPedido) {

        $sql = "SELECT
                    SUM(subTotal) AS totalPedido,
                    SUM(tiempoUnitario * cantidad) AS tiempoTotalPedido
                FROM detallesPedidos
                WHERE idPedido = ?";

        $stmt = $this->cn->prepare($sql);
        $stmt->execute([$idPedido]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       ACTUALIZAR TOTALES EN PEDIDOS
       ===================================================== */
    public function actualizarTotalesPedido($idPedido) {

        $totales = $this->calcularTotalesPedido($idPedido);

        $sql = "UPDATE pedidos SET
                    total = ?,
                    tiempoTotal = ?
                WHERE idPedido = ?";

        $stmt = $this->cn->prepare($sql);
        return $stmt->execute([
            $totales['totalPedido'] ?? 0,
            $totales['tiempoTotalPedido'] ?? 0,
            $idPedido
        ]);
    }
}
