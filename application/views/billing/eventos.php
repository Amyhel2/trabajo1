<?php $this->load->view('partial/header', $datos_usuario);?>

<?php $this->load->view('partial/header_facturacion', $datos_usuario);?>

<div class="container-fluid mt-4">
  <!-- Mensajes de éxito/error -->
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
  <?php elseif ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
  <?php endif; ?>

  <!-- Título y botón -->
  <div class="row mb-3">
    <div class="col-md-8">
      <h4><i class="fa fa-clock text-primary"></i> Historial de Eventos de Facturación</h4>
    </div>
    <div class="col-md-4 text-right">
      <a href="<?php echo site_url('billing/nuevoEvento'); ?>" class="btn btn-success btn-lg">
        <span class="ion-plus"></span> Nuevo
      </a>
    </div>
  </div>
  <br>
  <!-- Tabla de resultados -->
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <strong><i class="fa fa-clock"></i> Eventos Registrados</strong>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table id="eventosTable" class="table table-hover table-striped mb-0">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Inicio</th>
              <th>Fin</th>
              <th>Descripción</th>
              <th>Sucursal</th>
              <th>Punto Venta</th>
              <th>Código Recepción</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($eventos)): ?>
              <?php $i = 1;
              foreach ($eventos as $e): ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $e['fechaInicioEvento']  ?? '-'; ?></td>
                  <td><?= $e['fechaFinEvento']     ?? '-'; ?></td>
                  <td><?= $e['descripcion']      ?? '-'; ?></td>
                  <td><?= $e['nroSucursal']      ?? '-'; ?></td>
                  <td><?= $e['nroPuntoVenta']    ?? '-'; ?></td>
                  <td class="text-success"><strong><?= $e['codigoRecepcion'] ?? '-'; ?></strong></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center text-muted py-3">
                  <i class="fa fa-info-circle"></i> No hay eventos registrados.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view("partial/footer"); ?>