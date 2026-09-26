<?php

class dashboardsController extends Controller
{

private $daoDash;
public function __construct(){

$this->daoDash = new DaoDashboards();

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