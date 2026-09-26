<?php
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
class formaPagoController extends Controller{

 


    private $daoTarjeta;
    private $tarjetaHelper;
    private $correo;
    private $daoPedidos;
    private $daoDetallePedidos;
    private $daoUser;
    public function __construct(){

     $this->daoTarjeta = new DaoTarjeta();
     $this->tarjetaHelper = new tarjetaHelper();
     $this->daoPedidos = new DaoPedidos();
     $this->daoDetallePedidos = new DaoDetallesPedidos();
     $this->daoUser = new DaoUsuarios();
        
    }


 public function confirmarDatosPago()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    try {

        /* =========================
           DATOS BÁSICOS
        ========================= */
        $metodoPago = $_POST['metodoPago'] ?? null;
        $totalCosto = floatval($_POST['totalCosto'] ?? 0);

        if (!$metodoPago) {
            throw new Exception('Debe seleccionar un método de pago.');
        }

        if ($totalCosto <= 0) {
            throw new Exception('Total inválido.');
        }

        /* =========================
           CLIENTE
        ========================= */
        $correo = $_POST['cliente']['email'] ?? null;
        $nombre = $_POST['cliente']['nombre'] ?? '';
        $this->correo = $correo;
        if (!$correo) {
            throw new Exception('Email del cliente no válido.');
        }

        /* =========================
           DATOS DEL PEDIDO
        ========================= */
        if (!isset($_POST['datosFact'])) {
            throw new Exception('No se encontraron datos del pedido.');
        }

        $datosFact = json_decode($_POST['datosFact'], true);

        if (!$datosFact || !is_array($datosFact)) {
            throw new Exception('Datos del pedido inválidos.');
        }

        /* =========================
           VALIDACIÓN DE PAGO
        ========================= */
        if ($metodoPago === 'tarjeta') {

            $numero = str_replace(' ', '', $_POST['tarjeta']['numero'] ?? '');

            if (
                !$this->tarjetaHelper->validarNumerica($numero) ||
                !$this->tarjetaHelper->validarLuhn($numero)
            ) {
                throw new Exception('Número de tarjeta inválido.');
            }

            $tarjeta = $this->daoTarjeta->obtenerTarjeta($numero);

            if (!$tarjeta || $tarjeta['saldo'] < $totalCosto) {
                throw new Exception('Saldo insuficiente.');
            }

            $this->daoTarjeta->descontarSaldo($tarjeta['id'], $totalCosto);
        }

        if ($metodoPago === 'transferencia') {

            if (
                !isset($_FILES['transferencia']) ||
                !isset($_FILES['transferencia']['name']['comprobante']) ||
                $_FILES['transferencia']['error']['comprobante'] !== UPLOAD_ERR_OK
            ) {
                throw new Exception('Debe adjuntar el comprobante de transferencia.');
            }
        }

        /* =========================
           ESTADO DEL PEDIDO
        ========================= */
        $estadoPedido = ($metodoPago === 'tarjeta') ? 'CANCELADO' : 'PENDIENTE';

        /* =========================
           OBTENER USUARIO
        ========================= */
        $usuario = $this->daoUser->selectUsuarioPorEmail($correo);

        if (!$usuario) {
            throw new Exception('Usuario no encontrado.');
        }

        $idUsuario = $usuario['idUsuario'];

        /* =========================
           REGISTRO EN BD
        ========================= */
        $idPedido = $this->daoPedidos->crearPedido(
            $idUsuario,
            $estadoPedido,
            $totalCosto,
            0
        );

        if (!$idPedido) {
            throw new Exception('No se pudo crear el pedido.');
        }
        /* =========================
           SESIÓN + VISTA FINAL
        ========================= */
        $_SESSION['pedido'] = [
            'idPedido'       => $idPedido,
            'estado'         => $estadoPedido,
            'nombreCliente'  => $nombre,
            'datosProductos' => $datosFact,
            'totalCosto'     => $totalCosto
        ];

        $this->render('Comercial/compraRealizada', $_SESSION['pedido']);

        // 📧 Enviar correo (sin tiempo)
        $this->enviarCorreo(
            $nombre,
            $totalCosto,
            $datosFact
        );

    } catch (Exception $e) {

        $_SESSION['errorPago'] = $e->getMessage();

        $this->render('Comercial/prepararPago', [
            'totalCosto' => $totalCosto ?? 0
        ]);
    }
}




    public function enviarCorreo(
    $nombreCliente,
    $totalCosto,
    $datosProductos
) {
    require_once __DIR__ . '/../../vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        /* =========================
           CONFIGURACIÓN SMTP
        ========================= */
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = ''; //Correo emisor
        $mail->Password   = ''; // clave de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        /* =========================
           REMITENTE Y DESTINO
        ========================= */
        $mail->setFrom('correo@gmail.com', 'Sistema Ventas');
        $mail->addAddress($this->correo);

        /* =========================
           CONTENIDO
        ========================= */
        $mail->isHTML(true);
        $mail->Subject = 'Pedido confirmado - Detalles de su compra';

        $body = '
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:10px;">
<tr>
<td align="center">

    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:700px; background:#ffffff; border:1px solid #dddddd;">
        
        <tr>
            <td style="padding:20px;">
                <h2 style="margin:0 0 10px 0; color:#333;">¡Gracias por su compra!</h2>

                <p style="margin:0 0 10px 0; font-size:15px;">
                    Hola <strong>' . htmlspecialchars($nombreCliente) . '</strong>,
                </p>

                <p style="margin:0 0 15px 0; font-size:14px; line-height:1.5;">
                    Su pedido fue realizado con éxito. A continuación encontrará un resumen de su compra:
                </p>

                <hr style="border:none; border-top:1px solid #ddd; margin:15px 0;">

                <h3 style="margin:0 0 10px 0;">🛒 Detalle del pedido</h3>
            </td>
        </tr>

        <tr>
            <td style="padding:0 20px 20px 20px;">
                <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse:collapse; font-size:13px;">
                    <thead>
                        <tr style="background:#f0f0f0;">
                            <th align="left" style="border:1px solid #ccc;">Producto</th>
                            <th align="left" style="border:1px solid #ccc;">Descripción</th>
                            <th align="center" style="border:1px solid #ccc;">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($datosProductos as $prod) {
            $body .= '
                        <tr>
                            <td style="border:1px solid #ccc;">' . htmlspecialchars($prod['nombreProd']) . '</td>
                            <td style="border:1px solid #ccc;">' . htmlspecialchars($prod['descripcion']) . '</td>
                            <td align="center" style="border:1px solid #ccc;">' . htmlspecialchars($prod['cantidad']) . '</td>
                        </tr>';
        }

        $body .= '
                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding:20px; font-size:14px;">
                <p style="margin:10px 0; font-size:18px;">
                    <strong>Total pagado:</strong> $' . number_format((float)$totalCosto, 2, ',', '.') . '
                </p>

                <hr style="border:none; border-top:1px solid #ddd; margin:15px 0;">

                <p style="margin:0 0 10px 0; line-height:1.5;">
                    Su pedido será procesado y notificado cuando esté listo.
                </p>

                <p style="margin:0;">
                    Gracias por confiar en nosotros.<br>
                    <strong>Sistema de Ventas</strong>
                </p>
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>
';

        $mail->Body = $body;
        $mail->send();

    } catch (Exception $e) {
        error_log('Error al enviar correo: ' . $mail->ErrorInfo);
    }
}

}
?>