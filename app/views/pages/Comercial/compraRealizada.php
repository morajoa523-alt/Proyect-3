<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura - Pedido</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .factura {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border: 1px solid #ddd;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            color: #333;
        }

        .datos-cliente,
        .datos-pedido {
            margin-bottom: 20px;
        }

        .datos-cliente p,
        .datos-pedido p {
            margin: 4px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 14px;
            text-align: center;
        }

        table th {
            background: #f0f0f0;
        }

        .totales {
            margin-top: 20px;
            text-align: right;
        }

        .totales p {
            font-size: 16px;
            margin: 6px 0;
        }

        .total-final {
            font-size: 20px;
            font-weight: bold;
        }

        .acciones {
            margin-top: 30px;
            text-align: center;
        }

        .acciones button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .acciones {
                display: none;
            }

            .factura {
                border: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>

<div class="factura">

    <!-- ENCABEZADO -->
    <div class="header">
        <div>
            <h1>Factura</h1>
            <p>Fecha: <?= date('d/m/Y') ?></p>
        </div>
        <div>
            <strong>Mi Empresa</strong><br>
            ventas@miempresa.com<br>
            Tel: 123-456789
        </div>
    </div>

    <!-- DATOS CLIENTE -->
    <div class="datos-cliente">
        <h3>Datos del cliente</h3>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($nombreCliente ?? '') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($correo ?? '') ?></p>
    </div>

    <!-- DATOS PEDIDO -->
    <div class="datos-pedido">
        <h3>Detalle del pedido</h3>
        <p><strong>Estado:</strong> Pedido confirmado</p>
    </div>

    <!-- TABLA PRODUCTOS -->
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($datosProductos as $producto): ?>
            <tr>
                <td><?= htmlspecialchars($producto['nombreProd']) ?></td>
                <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                <td><?= htmlspecialchars($producto['cantidad']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- TOTALES -->
    <div class="totales">
        <p class="total-final">
            Total a pagar: $<?= number_format((float)$totalCosto, 2, ',', '.') ?>
        </p>
    </div>

    <!-- ACCIONES -->
    <div class="acciones">
        <button>
            <a href="/ventaPedido/inicio/inicio" style="text-decoration:none; color:#000;">
                Volver al inicio
            </a>
        </button>
        <button onclick="window.print()">🖨 Imprimir factura</button>
    </div>

</div>

</body>
</html>
