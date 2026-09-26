<?php



class PedidosController extends Controller{

    private $daoPedidos;

    public function __construct() {
        $this->daoPedidos = new DaoPedidos();
    }

    /* =========================================
       PANEL DE GESTIÓN DE PEDIDOS (ADMIN)
    ========================================== */
    public function updatePedidos() {
        // Cambiar estado del pedido
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idPedido'], $_POST['estado'])) {
            $idPedido = intval($_POST['idPedido']);
            $estado   = $_POST['estado'];

            $this->daoPedidos->cambiarEstadoPedido($idPedido, $estado);
        }

        // Obtener pedidos
        $pedidos = $this->daoPedidos->listarPedidos();

        $datos = [
            'pedidos' => $pedidos
        ];

        // Cargar vista
        $this->render('Admin/pedidos', $datos);
    }
}

?>