<?php $this->load->view("partial/header"); ?>
<?php $this->load->view("partial/header_facturacion"); ?>

<div class="container-fluid">
     <!-- Mensajes de éxito / error (Bootstrap 3) -->
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
      </button>
      <i class="fa fa-check-circle"></i>
      <?= $this->session->flashdata('success') ?>
    </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
      </button>
      <i class="fa fa-exclamation-circle"></i>
      <?= $this->session->flashdata('error') ?>
    </div>
  <?php endif; ?>
  <!-- Formulario de Búsqueda -->
  <div class="card mb-4 shadow-sm">
    <div class="card-body">

      <form method="post" action="<?= site_url('billing/index') ?>" class="row g-3">
        <div class="col-md-3">
          <label>Fecha Inicio:</label>
          <input type="date" class="form-control" name="fecha_inicio" value="<?= $fechainicio ?>"> 
        </div>
        <div class="col-md-3">
          <label>Fecha Fin:</label>
          <input type="date" class="form-control" name="fecha_fin" value="<?= $fechafin ?>">
        </div>
        <div class="col-md-3 align-self-end">
          <button type="submit" class="btn btn-info w-100">
            <i class="fa fa-search"></i> Buscar
          </button>
        </div>
      </form>
    </div>
  </div>

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
              <th>Fecha / Hora</th>
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
              <?php foreach ($facturas as $i => $f): ?>
                <tr>
                  <td><?= $i + 1 ?></td>
                  <td><?= "{$f['fecha']} {$f['hora']}" ?></td>
                  <td><?= $f['numeroFactura'] ?></td>
                  <td><?= $f['numeroDocumento'] ?></td>
                  <td><?= $f['nombreRazonSocial'] ?></td>
                  <td><?= number_format($f['montoTotalSujetoIva'], 2, ',', '.') ?></td>
                  <td>
                    <span class="badge bg-<?= $f['estado'] === 'VALIDO' ? 'success' : 'dangerbb' ?>">
                      <?= $f['estado'] ?>
                    </span>
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <!-- Ver PDF -->
                      <a href="<?= site_url("billing/ver_pdf/{$f['id']}") ?>"
                         class="btn btn-sm btn-success" title="Ver PDF">
                        <i class="fa fa-file-pdf"></i> PDF
                      </a>
                      <!-- Enviar Email -->
                      <?php if (!empty($f['email'])): ?>
                        <a href="<?= site_url("billing/enviar_email/{$f['id']}") ?>"
                           class="btn btn-sm btn-primary" title="Enviar Email">
                          <i class="fa fa-envelope"></i> Email
                        </a>
                      <?php else: ?>
                        <button class="btn btn-sm btn-primary disabled" title="No hay correo">
                          <i class="fa fa-envelope"></i>
                        </button>
                      <?php endif; ?>
                      <!-- Anular -->
                      <button type="button"
                              onclick="confirmarAnulacion(<?= $f['id'] ?>)"
                              class="btn btn-sm btn-danger" title="Anular">
                        <i class="fa fa-ban"></i> Anular
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="8" class="text-center text-muted p-3">
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
    window.location.href = '<?= site_url('billing/anular_factura') ?>/' + id;
  }
}
</script>

<?php $this->load->view("partial/footer"); ?>
