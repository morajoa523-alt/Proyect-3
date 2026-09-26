<?php require_once APP . '/views/inc/header.php' ?>

<style>
    .tabla-centros {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: Arial, sans-serif;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .tabla-centros th,
    .tabla-centros td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .tabla-centros thead {
        background-color: #2c3e50;
        color: white;
    }

    .tabla-centros tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .tabla-centros tbody tr:hover {
        background-color: #ecf0f1;
    }

    h3 {
        margin-top: 20px;
        color: #2c3e50;
    }
</style>

<h3>Listado de Centros de Salud</h3>

<table class="tabla-centros">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
        </tr>
    </thead>
    <tbody>

    <?php if (!empty($datos)): ?>
        <?php foreach ($datos as $dt): ?>
            <tr>
                <td><?= htmlspecialchars($dt['id_centro']) ?></td>
                <td><?= htmlspecialchars($dt['nombre']) ?></td>
                <td><?= htmlspecialchars($dt['direccion']) ?></td>
                <td><?= htmlspecialchars($dt['telefono']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" style="text-align:center;">
                No existen registros
            </td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>

<?php require_once APP . '/views/inc/footer.php' ?>
