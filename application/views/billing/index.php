<?php $this->load->view("partial/header"); ?>
<?php $this->load->view("partial/header_facturacion"); ?>

<div class="container-fluid">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0"><i class="fa fa-file-invoice text-primary"></i> Facturas Emitidas</h4>
  </div>

  <!-- Formulario de Búsqueda -->
  <div class="card mb-4 shadow-sm">
    <div class="card-body">
      <form method="post" action="<?= site_url('billing/index') ?>">
        <div class="row">
          <div class="col-md-3">
            <label>Fecha Inicio:</label>
            <input type="date" class="form-control" name="fecha_inicio" value="<?= $fechainicio ?? date('Y-m-01') ?>">
          </div>
          <div class="col-md-3">
            <label>Fecha Fin:</label>
            <input type="date" class="form-control" name="fecha_fin" value="<?= $fechafin ?? date('Y-m-d') ?>">
          </div>
          <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-info btn-lg"><span class="ion-search"></span> Buscar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <br>
  <!-- Tabla de Resultados -->
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
              <th>Razón Social</th>
              <th>Total (Bs)</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($facturas)) : ?>
              <?php foreach ($facturas as $i => $factura): ?>
                <tr>
                  <td><?= $i+1 ?></td>
                  <td><?= $factura['fecha'] ?></td>
                  <td><?= $factura['hora'] ?></td>
                  <td><?= $factura['numeroFactura'] ?></td>
                  <td><?= $factura['numeroDocumento'] ?></td>
                  <td><?= $factura['nombreRazonSocial'] ?></td>
                  <td><?= number_format($factura['montoTotalSujetoIva'], 2) ?></td>
                  <td>
                    <span class="badge <?= $factura['estado'] == 'VALIDO' ? 'bg-success' : 'bg-danger' ?>">
                      <?= $factura['estado'] ?>
                    </span>
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="<?= site_url('billing/ver_pdf/' . $factura['id']) ?>" 
                         class="btn btn-sm btn-success" title="Ver PDF">
                        <i class="fa fa-file-pdf"> ver pdf</i>
                      </a>
                      <a href="<?= site_url('billing/enviar_email/' . $factura['id']) ?>" 
                         class="btn btn-sm btn-primary" title="Enviar Email">
                        <i class="fa fa-envelope"> email</i>
                      </a>
                      <button onclick="confirmarAnulacion(<?= $factura['id'] ?>)" 
                         class="btn btn-sm btn-danger" title="Anular">
                        <i class="fa fa-ban"> anular</i>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="9" class="text-center text-muted p-3">
                  <i class="fa fa-info-circle"></i> No se encontraron facturas.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
// Confirmación para anular
function confirmarAnulacion(id) {
    if (confirm('¿Está seguro de anular esta factura?')) {
        window.location.href = '<?= site_url('billing/anular_factura/') ?>' + id;
    }
}
</script>

<?php $this->load->view("partial/footer"); ?>