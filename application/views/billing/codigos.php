<?php
$this->load->view("partial/header");
$this->load->view("partial/header_facturacion");
?>

<div class="container-fluid mt-4">
  <h4 class="mb-3"><i class="fa fa-qrcode text-primary"></i> Códigos SIAT</h4>

  <!-- Flash messages -->
  <?php if ($msg = $this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $msg ?></div>
  <?php elseif ($msg = $this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $msg ?></div>
  <?php endif; ?>

  <div class="row">
    <!-- Menú lateral -->
    <div class="col-md-3">
      <ul class="nav flex-column nav-pills config-nav" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#codigosCufd">CUFD</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#codigosCuis">CUIS</a>
        </li>
      </ul>
    </div>

    <!-- Contenido -->
    <div class="col-md-9">
      <div class="tab-content card shadow-sm bg-white rounded p-3">

        <!-- CUFD -->
        <div id="codigosCufd" class="tab-pane fade show active">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Listado de CUFD</h5>
            <a href="<?= site_url('billing/sincronizar_cufd') ?>" class="btn btn-warning btn-sm">
              <i class="ion-loop"></i> Obtener nuevo CUFD
            </a>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Registro</th>
                  <th>Vigencia</th>
                  <th>Sucursal</th>
                  <th>Pto. Venta</th>
                  <th>CUFD</th>
                  <th>Código Control</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($cufds)): ?>
                  <?php $i = 1; foreach ($cufds as $c): ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td><?= $c['fecha_registro'] ?></td>
                      <td><?= $c['fecha_vigencia'] ?></td>
                      <td><?= $c['nro_sucursal'] ?></td>
                      <td><?= $c['nro_punto_venta'] ?></td>
                      <td><?= $c['codigo_cufd'] ?></td>
                      <td><?= $c['codigo_control'] ?></td>
                      <td>
                        <?php
                          $vigente = strtotime($c['fecha_vigencia']) > time();
                          echo $vigente
                            ? '<span class="badge badge-success">Vigente</span>'
                            : '<span class="badge badge-danger">Expirado</span>';
                        ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="8" class="text-center text-muted py-3">
                      <i class="fa fa-info-circle"></i> No hay registros de CUFD.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- CUIS -->
        <div id="codigosCuis" class="tab-pane fade">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Listado de CUIS</h5>
            <a href="<?= site_url('billing/sincronizar_cuis') ?>" class="btn btn-warning btn-sm">
              <i class="ion-loop"></i> Obtener nuevo CUIS
            </a>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Registro</th>
                  <th>Vigencia</th>
                  <th>Sucursal</th>
                  <th>Pto. Venta</th>
                  <th>Código CUIS</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($cuis)): ?>
                  <?php $j = 1; foreach ($cuis as $u): ?>
                    <tr>
                      <td><?= $j++ ?></td>
                      <td><?= $u['fechaRegistro'] ?? '-' ?></td>
                      <td><?= $u['fechaVigencia'] ?? '-' ?></td>
                      <td><?= $u['nroSucursal'] ?? '-' ?></td>
                      <td><?= $u['nroPuntoVenta'] ?? '-' ?></td>
                      <td><?= $u['codigoCuis'] ?? '-' ?></td>
                      <td>
                        <?php
                          $v = !empty($u['fechaVigencia']) && strtotime($u['fechaVigencia']) > time();
                          echo $v
                            ? '<span class="badge badge-success">Vigente</span>'
                            : '<span class="badge badge-secondary">--</span>';
                        ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7" class="text-center text-muted py-3">
                      <i class="fa fa-info-circle"></i> No hay registros de CUIS.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<style>
.config-nav .nav-link {
  padding: 10px 15px;
  margin-bottom: 5px;
  background: #f8f9fa;
  font-weight: 500;
  color: #333;
}
.config-nav .nav-link.active {
  background: #007bff;
  color: #fff;
}
</style>

<script>
  // Inicializa pestañas con Bootstrap
  $('#codigos .nav-pills a').on('click', function (e) {
    e.preventDefault();
    $(this).tab('show');
  });
</script>

<?php $this->load->view("partial/footer"); ?>
