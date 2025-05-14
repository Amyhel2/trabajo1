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
            <!-- Agregar Producto -->
            <div class="col-md-4 mb-3">
              <label>Adicionar (Item):</label>
              <select class="form-control" id="producto_select">
                <option value="">Seleccione un producto del inventario</option>
              </select>
            </div>
            <!-- Código de Barras -->
            <div class="col-md-4 mb-3">
              <label for="codbar">Código (Barras):</label>
              <ul class="list-inline">
                <li>
                  <input type="text"
                         class="form-control"
                         name="search"
                         id="search"
                         value="<?= htmlspecialchars($nit) ?>"
                         placeholder="Ingrese código o NIT">
                </li>
                <li>
                  <button type="submit" class="btn btn-primary btn-lg">
                    <span class="ion-ios-search-strong"></span>
                  </button>
                </li>
              </ul>
            </div>
            <!-- Tipo Documento -->
            <div class="col-md-4 mb-3">
              <label>Tipo Documento:</label>
              <select class="form-control" name="tipo_documento">
                <option value="1">CI - CÉDULA DE IDENTIDAD</option>
              </select>
            </div>
          </div>

          <div class="row">
            <!-- NIT / CI -->
            <div class="col-md-4 mb-3">
              <label>NIT/CI:</label>
              <input type="text"
                     class="form-control"
                     value="<?= htmlspecialchars($nit) ?>"
                     readonly>
            </div>
            <!-- Complemento -->
            <div class="col-md-2 mb-3">
              <label>Complemento (CI):</label>
              <input type="text"
                     id="complemento_ci"
                     class="form-control"
                     placeholder="">
            </div>
            <!-- Razón Social -->
            <div class="col-md-3 mb-3">
              <label>Nombres (Razón Social):</label>
              <input type="text"
                     id="razon_social"
                     class="form-control"
                     value="<?= htmlspecialchars($razon_social) ?>">
            </div>
            <!-- Correo -->
            <div class="col-md-3 mb-3">
              <label>Correo (electrónico):</label>
              <input type="email"
                     id="email_cliente"
                     class="form-control"
                     value="<?= htmlspecialchars($email) ?>">
            </div>
          </div>
        </div>
      </div>
      <br>
      <!-- Tabla Detalle Productos -->
      <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
          <strong><i class="fa fa-list"></i> Ventas (Detalle)</strong>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Código</th>
                  <th>Cantidad</th>
                  <th>Descripción</th>
                  <th>Precio Unitario</th>
                  <th>Descuento (%)</th>
                  <th>Subtotal</th>
                  <th>O</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($facturas)) : ?>
                  <?php $i = 1; foreach ($facturas as $factura) : ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td><?= htmlspecialchars($factura['codigo']) ?></td>
                      <td><?= $factura['cantidad'] ?></td>
                      <td><?= htmlspecialchars($factura['descripcion']) ?></td>
                      <td><?= number_format($factura['preciounitario'], 2) ?></td>
                      <td><?= number_format($factura['descuento'], 2) ?>%</td>
                      <td><?= number_format($factura['subtotal'], 2) ?></td>
                      <td>
                        <button class="btn btn-sm btn-danger">
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else : ?>
                  <tr>
                    <td colspan="8" class="text-center text-muted p-3">
                      <i class="fa fa-info-circle"></i> Ningún dato disponible en esta tabla
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Totales y Facturación -->
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-header bg-light">
          <h4><strong>Facturar Venta</strong></h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Sub-Total (Bs):</label>
            <input type="text"
                   id="subtotal"
                   class="form-control"
                   value="<?= number_format($subtotal, 2) ?>"
                   readonly>
          </div>
          <div class="form-group">
            <label>Descuento Total (Bs):</label>
            <input type="text"
                   id="descuento_total"
                   class="form-control"
                   value="<?= number_format($descuento, 2) ?>"
                   readonly>
          </div>
          <div class="form-group">
            <label>Total (Bs):</label>
            <input type="text"
                   id="total"
                   class="form-control"
                   value="<?= number_format($total, 2) ?>"
                   readonly>
          </div>
          <div class="form-group">
            <label>Total Base Crédito Fiscal (Bs):</label>
            <input type="text"
                   id="base_credito"
                   class="form-control"
                   readonly>
          </div>
          <div class="form-group">
            <label>Crédito Fiscal (Bs):</label>
            <input type="text"
                   id="credito_fiscal"
                   class="form-control"
                   readonly>
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

<?php $this->load->view("partial/footer"); ?>
