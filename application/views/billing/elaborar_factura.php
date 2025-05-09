<?php
$this->load->view("partial/header");
$this->load->view("partial/header_facturacion");
?>

<div class="container-fluid">
  <h4 class="mb-0">
    <i class="fa fa-qrcode text-primary"></i> Elaborar Factura
  </h4>
  <div class="row">
    <!-- Detalle de Venta -->
    <div class="col-md-8">
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="row">
            <!-- Tipo de Documento -->
            <div class="col-md-4 mb-3">
              <label>Tipo Documento:</label>
              <select class="form-control" name="tipo_documento" id="tipo_documento">
                <option value="1" <?= ($tipo_documento == "1") ? 'selected' : '' ?>>CI - CÉDULA DE IDENTIDAD</option>
              </select>
            </div>

            <!-- NIT / CI -->
            <div class="col-md-4 mb-3">
              <label>NIT/CI:</label>
              <input type="text" class="form-control" id="search" value="<?= $nit ?>" placeholder="NIT o CI">
            </div>

            <!-- Nombre / Razón Social -->
            <div class="col-md-4 mb-3">
              <label>Razón Social:</label>
              <input type="text" id="razon_social" class="form-control" value="<?= $razon_social ?>" placeholder="">
            </div>

            <!-- Correo Electrónico -->
            <div class="col-md-6 mb-3">
              <label>Correo:</label>
              <input type="email" id="email_cliente" class="form-control" value="<?= $email ?>" placeholder="">
            </div>
          </div>
        </div>
      </div>

      <!-- Tabla de productos -->
      <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
          <strong><i class="fa fa-list"></i> Detalle de Productos</strong>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio Unitario</th>
                  <th>Descuento</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($productos as $i => $producto): ?>
                <tr>
                  <td><?= $i + 1 ?></td>
                  <td><?= $producto['producto'] ?></td>
                  <td><?= $producto['cantidad'] ?></td>
                  <td><?= number_format($producto['preciounitario'], 2) ?></td>
                  <td><?= number_format($producto['descuento'], 2) ?></td>
                  <td><?= number_format($producto['preciobs'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Resumen y botón de facturación -->
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-header bg-light">
          <h4><strong>Resumen</strong></h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Sub-Total (Bs):</label>
            <input type="text" id="subtotal" class="form-control" value="<?= $subtotal ?>" readonly>
          </div>
          <div class="form-group">
            <label>Descuento (Bs):</label>
            <input type="text" id="descuento_total" class="form-control" value="<?= $descuento_total ?>">
          </div>
          <div class="form-group">
            <label>Total (Bs):</label>
            <input type="text" id="total" class="form-control" value="<?= $total ?>" readonly>
          </div>
          <div class="form-group">
            <label>Método Pago:</label>
            <select id="metodo_pago" class="form-control">
              <option value="1">Efectivo</option>
              <option value="2">Tarjeta</option>
              <option value="3">Transferencia</option>
            </select>
          </div>
          <div class="text-right">
            <button id="btn-facturar" class="btn btn-primary">
              <i class="fa fa-file-invoice-dollar"></i> Generar Factura
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script para enviar la factura -->
<script>
document.getElementById("btn-facturar").addEventListener("click", function() {
  const productos = <?= json_encode($productos); ?>;

  const data = {
    subtotal: document.getElementById("subtotal").value,
    descuento_total: document.getElementById("descuento_total").value,
    total: document.getElementById("total").value,
    metodo_pago: document.getElementById("metodo_pago").value,
    tipo_documento: document.getElementById("tipo_documento").value,
    nit: document.getElementById("search").value,
    razon_social: document.getElementById("razon_social").value,
    email: document.getElementById("email_cliente").value,
    productos: productos
  };

  fetch("<?= site_url('facturacion/generar_factura') ?>", {
    method: "POST",
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(response => {
    console.log(response);
    alert("Factura generada correctamente");
  })
  .catch(error => {
    console.error(error);
    alert("Error al generar factura");
  });
});
</script>

<?php $this->load->view("partial/footer"); ?>
