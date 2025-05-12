<?php 
$this->load->view("partial/header"); 
$this->load->view("partial/header_facturacion");
?>

<div class="container mt-4">
  <h4><i class="fa fa-file-invoice"></i> Detalle de Venta</h4>
  <hr>

  <!-- Información de la venta -->
  <ul class="list-group mb-4">
    <li class="list-group-item"><strong>ID de Venta:</strong> <?= $venta->sale_id ?></li>
    <li class="list-group-item"><strong>Fecha:</strong> <?= $venta->sale_time ?></li>
    <li class="list-group-item"><strong>ID de Empleado:</strong> <?= $venta->employee_id ?></li>
    <li class="list-group-item"><strong>Comentario:</strong> <?= $venta->comment ?: 'Sin comentarios' ?></li>
    <li class="list-group-item"><strong>Subtotal:</strong> <?= number_format($venta->subtotal, 2) ?> Bs</li>
    <li class="list-group-item"><strong>Total:</strong> <?= number_format($venta->total, 2) ?> Bs</li>
    <li class="list-group-item"><strong>Tipo de Pago:</strong> <?= $venta->payment_type ?></li>
  </ul>

  <!-- Información del cliente -->
  <h5 class="mt-3">Cliente</h5>
  <?php if (!empty($cliente->razon_social) || !empty($cliente->nombre)): ?>
    <ul class="list-group mb-4">
      <li class="list-group-item"><strong>Nombre:</strong> <?= htmlspecialchars($cliente->nombre) ?></li>
      <li class="list-group-item"><strong>Razón Social:</strong> <?= htmlspecialchars($cliente->razon_social ?: 'No especificada') ?></li>
      <li class="list-group-item"><strong>NIT / CI:</strong> <?= htmlspecialchars($cliente->nit ?: 'Sin NIT') ?></li>
      <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($cliente->email ?: 'Sin correo') ?></li>
    </ul>
  <?php else: ?>
    <p class="text-muted">Cliente no registrado.</p>
  <?php endif; ?>

  <!-- Productos vendidos -->
  <h5 class="mt-3">Productos Comprados</h5>
  <?php if (!empty($productos)): ?>
    <ul class="list-group">
      <?php foreach ($productos as $p): ?>
        <li class="list-group-item">
          <strong><?= htmlspecialchars($p['nombre']) ?></strong><br>
          Cantidad: <?= $p['cantidad'] ?> |
          Precio Unitario: <?= number_format($p['precio'], 2) ?> Bs |
          Descuento: <?= number_format($p['descuento'], 2) ?>% |
          Subtotal: <?= number_format($p['subtotal'], 2) ?> Bs
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p class="text-muted">No se encontraron productos para esta venta.</p>
  <?php endif; ?>
</div>

<?php $this->load->view("partial/footer"); ?>

