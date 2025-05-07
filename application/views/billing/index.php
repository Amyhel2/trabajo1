<?php $this->load->view("partial/header"); ?>
<?php $this->load->view("partial/header_facturacion"); ?>

<div class="container-fluid">
  <!-- Título principal -->
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0">
      <i class="fa fa-file-invoice text-primary"></i> Facturas Emitidas
    </h4>
  </div>

  <!-- Formulario de búsqueda -->
  <div class="card mb-4 shadow-sm">
    <div class="card-body">
      <form method="post" action="<?php echo site_url('billing/index'); ?>">
        <div class="row">
          <div class="col-md-3">
            <label>Fecha Inicio:</label>
            <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $fechainicio ?? date('Y-m-01'); ?>">
          </div>
          <div class="col-md-3">
            <label>Fecha Fin:</label>
            <input type="date" class="form-control" name="fecha_fin" value="<?php echo $fechafin ?? date('Y-m-d'); ?>">
          </div>

          <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-info btn-lg hidden-sm hidden-xs" title="Guardar">
              <span class="ion-search"></span> Buscar
          </div>
        </div>
      </form>
    </div>
  </div>

  <hr>

  <!-- Tabla de resultados -->
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <strong><i class="fa fa-list"></i> Resultados</strong>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>N° Factura</th>
              <th>NIT</th>
              <th>Razon Social</th>
              <th>SubTotal</th>
              <th>Descuento</th>
              <th>Total Sujeto a Iva</th>
              <th>Emision</th>
              <th>Estado</th>
              <th>--</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($facturas)) : ?>
              <?php $i = 1;
              foreach ($facturas as $factura) : ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $factura['fecha']; ?></td>
                  <td><?php echo $factura['hora']; ?></td>
                  <td><?php echo $factura['numeroFactura']; ?></td>
                  <td><?php echo $factura['numeroDocumento']; ?></td>
                  <td><?php echo $factura['nombreRazonSocial']; ?></td>
                  <td><?php echo $factura['montoTotalSujetoIva']; ?></td>
                  <td><?php echo $factura['descuentoAdicional']; ?></td>
                  <td><?php echo $factura['montoTotalSujetoIva']; ?></td>
                  <td><?php echo $factura['fechaEmision']; ?></td>
                  <td><?php echo $factura['estado']; ?></td>
                  <td><?php echo $factura['iconos']; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="12" class="text-center text-muted p-3">
                  <i class="fa fa-info-circle"></i> No hay facturas encontradas en el rango seleccionado.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $("#employee_id").select2();
  date_time_picker_field($("#expire_date"), JS_DATE_FORMAT);
</script>

<?php $this->load->view("partial/footer"); ?>