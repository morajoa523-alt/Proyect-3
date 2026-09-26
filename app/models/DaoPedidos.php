<?php

class DaoPedidos {

    private $cn;

    public function __construct() {
        $this->cn = (new conexionbd())->conectar();
    }

    /* =====================================================
       CREAR PEDIDO
       ===================================================== */
    public function crearPedido($idUsuario, $estado, $total, $tiempoTotal) {

    $sql = "INSERT INTO pedidos (
                idUsuario,
                estado,
                total,
                tiempoTotal,
                fechaPedido
            ) VALUES (?, ?, ?, ?, NOW())";

    $stmt = $this->cn->prepare($sql);
    $stmt->execute([
        $idUsuario,
        $estado,
        $total,
        $tiempoTotal
    ]);

    return $this->cn->lastInsertId();
}

    /* =====================================================
       ACTUALIZAR TOTALES DEL PEDIDO
       ===================================================== */
    public function actualizarTotalesPedido($idPedido) {

        $sql = "UPDATE pedidos
                SET
                    total = (
                        SELECT IFNULL(SUM(subTotal),0)
                        FROM detallesPedidos
                        WHERE idPedido = ?
                    ),
                    tiempoTotal = (
                        SELECT IFNULL(SUM(tiempoUnitario * cantidad),0)
                        FROM detallesPedidos
                        WHERE idPedido = ?
                    )
                WHERE idPedido = ?";

        $stmt = $this->cn->prepare($sql);
        return $stmt->execute([$idPedido, $idPedido, $idPedido]);
    }

    /* =====================================================
       LISTAR PEDIDOS POR USUARIO
       ===================================================== */
    public function listarPedidosPorUsuario($idUsuario) {

        $sql = "SELECT
                    p.idPedido,
                    p.estado,
                    p.total,
                    p.tiempoTotal,
                    p.fechaPedido,
                    u.nombre AS usuario
                FROM pedidos p
                INNER JOIN usuarios u ON p.idUsuario = u.idUsuario
                WHERE p.idUsuario = ?
                ORDER BY p.fechaPedido DESC";

        $stmt = $this->cn->prepare($sql);
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       LISTAR TODOS LOS PEDIDOS (ADMIN)
       ===================================================== */
    public function listarPedidos() {

        $sql = "SELECT
                    p.idPedido,
                    p.estado,
                    p.total,
                    p.tiempoTotal,
                    p.fechaPedido,
                    u.nombre AS usuario
                FROM pedidos p
                INNER JOIN usuarios u ON p.idUsuario = u.idUsuario
                ORDER BY p.fechaPedido DESC";

        $stmt = $this->cn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       OBTENER UN PEDIDO
       ===================================================== */
    public function obtenerPedido($idPedido) {

        $sql = "SELECT
                    idPedido,
                    idUsuario,
                    estado,
                    total,
                    tiempoTotal,
                    fechaPedido
                FROM pedidos
                WHERE idPedido = ?";

        $stmt = $this->cn->prepare($sql);
        $stmt->execute([$idPedido]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =====================================================
       OBTENER DETALLES DE UN PEDIDO
       ===================================================== */
    public function obtenerDetallesPedido($idPedido) {

        $sql = "SELECT
                    dp.idDetalle,
                    pr.nombre AS producto,
                    d.ancho,
                    d.largo,
                    m.descripcion AS modelo,
                    t.descripcion AS tematica,
                    ti.descripcion AS tipoImpresion,
                    cp.cantidad AS piezas,
                    dp.cantidad,
                    dp.costoUnitario,
                    dp.tiempoUnitario,
                    dp.subTotal
                FROM detallesPedidos dp
                INNER JOIN productos pr ON dp.idProducto = pr.idProducto
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
       CAMBIAR ESTADO DEL PEDIDO
       ===================================================== */
    public function cambiarEstadoPedido($idPedido, $estado) {

        $sql = "UPDATE pedidos
                SET estado = ?
                WHERE idPedido = ?";

        $stmt = $this->cn->prepare($sql);
        $stmt->execute([$estado, $idPedido]);
        return;
    }

    /* =====================================================
       ELIMINAR PEDIDO (CON TRANSACCIÓN)
       ===================================================== */
    public function eliminarPedido($idPedido) {

        $this->cn->beginTransaction();

        try {

            $stmt = $this->cn->prepare(
                "DELETE FROM detallesPedidos WHERE idPedido = ?"
            );
            $stmt->execute([$idPedido]);

            $stmt = $this->cn->prepare(
                "DELETE FROM pedidos WHERE idPedido = ?"
            );
            $stmt->execute([$idPedido]);

            $this->cn->commit();
            return true;

        } catch (Exception $e) {

            $this->cn->rollBack();
            return false;
        }
    }
}
