<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Facturas</title>
</head>
<body>

<h1>Facturas Emitidas</h1>

<!-- Formulario para elegir fechas -->
<form method="post" action="<?php echo site_url('sales/list_invoices'); ?>">
    <label>Fecha Inicio:</label>
    <input type="date" name="fechainicio" value="<?php echo $fechainicio; ?>" required>

    <label>Fecha Fin:</label>
    <input type="date" name="fechafin" value="<?php echo $fechafin; ?>" required>

    <button type="submit">Buscar Facturas</button>
</form>

<br>

<?php if (!empty($facturas)) { ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID Factura</th>
                <th>Número Documento</th>
                <th>Cliente</th>
                <th>Importe Total</th>
                <th>Fecha Emisión</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $factura) { ?>
                <tr>
                    <td><?php echo $factura['id']; ?></td>
                    <td><?php echo $factura['numeroDocumento']; ?></td>
                    <td><?php echo $factura['nombreRazonSocial']; ?></td>
                    <td><?php echo $factura['importeTotal']; ?></td>
                    <td><?php echo $factura['fechaEmision']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>No hay facturas emitidas en el rango de fechas seleccionado.</p>
<?php } ?>

</body>
</html>
