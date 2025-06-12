<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Factura <?= esc($factura['numeroFactura']) ?></title>
  <style>
    body { font-family: monospace; font-size: 12px; margin:0; padding:0; }
    .ticket { width: 280px; margin: auto; }
    .center { text-align: center; }
    .bold { font-weight: bold; }
    hr { border: none; border-top: 1px dashed #000; margin: 5px 0; }
    table { width: 100%; border-collapse: collapse; }
    td { padding: 2px 0; vertical-align: top; }
    .right { text-align: right; }
    .small { font-size: 10px; word-break: break-word; }
    @page { size: auto; margin: 0; }
    @media print { body { margin: 0; } }
  </style>
</head>
<body onload="window.print();">

<div class="ticket">
  <!-- Encabezado -->
  <div class="center bold">
    <?= esc($empresa['nombre']) ?><br>
    <?= esc($sucursal['nombre']) ?><br>
    <?= esc($sucursal['direccion']) ?>
  </div>
  <hr>

  <!-- Info Factura -->
  <table>
    <tr><td>Factura:</td><td class="right"><?= esc($factura['numeroFactura']) ?></td></tr>
    <tr><td>Fecha:</td><td class="right"><?= esc($venta['fecha']) ?> <?= esc($venta['hora']) ?></td></tr>
    <tr><td>CUF:</td><td class="right small"><?= esc($factura['cuf']) ?></td></tr>
    <tr><td>Estado:</td><td class="right"><?= esc($factura['estado']) ?></td></tr>
  </table>
  <hr>

  <!-- Info Cliente -->
  <div>
    <strong>Cliente:</strong><br>
    <?= esc($cliente['nombre']) ?><br>
    NIT/CI: <?= esc($cliente['nit']) ?><br>
    <?= esc($cliente['direccion']) ?>
  </div>
  <hr>

  <!-- Detalle Items -->
  <table>
    <thead>
      <tr>
        <td class="bold">Cant</td>
        <td class="bold">Descripción</td>
        <td class="bold right">Total</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($venta['items'] as $it): ?>
      <tr>
        <td><?= esc($it['cantidad']) ?></td>
        <td><?= esc($it['descripcion']) ?></td>
        <td class="right"><?= number_format($it['subtotal'], 2) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <hr>

  <!-- Totales -->
  <table>
    <tr><td>Subtotal</td><td class="right"><?= number_format($venta['subtotal'], 2) ?></td></tr>
    <?php if($venta['descuento'] > 0): ?>
    <tr><td>Descuento</td><td class="right">- <?= number_format($venta['descuento'], 2) ?></td></tr>
    <?php endif; ?>
    <tr><td class="bold">Total</td><td class="right bold"><?= number_format($venta['total'], 2) ?></td></tr>
  </table>
  <hr>

  <!-- QR -->
  <?php if(! empty($factura['qr'])): ?>
  <div class="center">
    <img src="data:image/png;base64,<?= $factura['qr'] ?>" alt="QR SIAT" width="120">
  </div>
  <?php endif; ?>

  <!-- Pie -->
  <div class="center">
    ¡GRACIAS POR SU COMPRA!<br>
    <?= date('Y-m-d H:i:s') ?>
  </div>
</div>

</body>
</html>
