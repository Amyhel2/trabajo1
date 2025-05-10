<?php $this->load->view("partial/header"); ?>

<div class="container mt-4">
  <h4><i class="fa fa-file-invoice"></i> Elaborar Factura</h4>

  <form>
    <div class="form-group">
      <label>Razón Social:</label>
      <input type="text" class="form-control" id="razon_social" value="<?= htmlspecialchars($razon_social) ?>">
    </div>

    <div class="form-group">
      <label>NIT / CI:</label>
      <input type="text" class="form-control" id="nit" value="<?= htmlspecialchars($nit) ?>">
    </div>

    <div class="form-group">
      <label>Correo electrónico:</label>
      <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($email) ?>">
    </div>

    <h5 class="mt-4">Detalle de productos</h5>
    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Descuento (%)</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($productos as $p): ?>
        <tr>
          <td><?= htmlspecialchars($p['nombre']) ?></td>
          <td><?= $p['cantidad'] ?></td>
          <td><?= number_format($p['precio_unitario'], 2) ?></td>
          <td><?= number_format($p['descuento'], 2) ?></td>
          <td><?= number_format($p['subtotal'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="form-group mt-3">
      <label>Total:</label>
      <input type="text" class="form-control" id="total" value="<?= number_format($total, 2) ?>" readonly>
    </div>

    <button type="button" class="btn btn-primary" id="btn_generar_factura">
      Generar Factura (con API)
    </button>
  </form>
</div>

<?php $this->load->view("partial/footer"); ?>

