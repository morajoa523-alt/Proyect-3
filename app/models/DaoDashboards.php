<?php
class DaoDashboards {

    private $pdo;

    public function __construct(){
        $this->pdo = (new conexionbd())->conectar();
    }

    /* ==========================================
       TOTAL VENTAS POR MES (AÑO ACTUAL)
    ========================================== */
    public function obtenerVentasMensuales()
    {
        $sql = "
            SELECT 
                MONTH(p.fechaPedido) AS mes,
                SUM(p.total) AS total_mes
            FROM pedidos p
            WHERE YEAR(p.fechaPedido) = YEAR(CURDATE())
              AND p.estado = 'CANCELADO'
            GROUP BY MONTH(p.fechaPedido)
            ORDER BY mes
        ";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ==========================================
       PRODUCTO MÁS VENDIDO POR MES
    ========================================== */
    public function obtenerProductoMasVendidoPorMes()
{
    $sql = "
        SELECT t.mes, pr.nombre, t.total_vendido
        FROM (
            SELECT 
                MONTH(p.fechaPedido) AS mes,
                dp.idProducto,
                SUM(dp.cantidad) AS total_vendido,
                ROW_NUMBER() OVER (
                    PARTITION BY MONTH(p.fechaPedido)
                    ORDER BY SUM(dp.cantidad) DESC
                ) AS ranking
            FROM pedidos p
            JOIN detallesPedidos dp ON dp.idPedido = p.idPedido
            WHERE YEAR(p.fechaPedido) = YEAR(CURDATE())
              AND p.estado = 'CANCELADO'
            GROUP BY MONTH(p.fechaPedido), dp.idProducto
        ) t
        JOIN productos pr ON pr.idProducto = t.idProducto
        WHERE t.ranking = 1
        ORDER BY t.mes
    ";

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

}
?>