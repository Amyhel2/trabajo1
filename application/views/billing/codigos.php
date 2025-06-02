<?php $this->load->view('partial/header', $datos_usuario);?>

<?php $this->load->view('partial/header_facturacion', $datos_usuario);?>

<div class="container-fluid mt-4">
  <h4 class="mb-3">
    <i class="fa fa-qrcode text-primary"></i> Códigos SIAT
  </h4>

  <?php if ($msg = $this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $msg ?></div>
  <?php elseif ($msg = $this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $msg ?></div>
  <?php endif; ?>

  <div class="row">
    <!-- Menú lateral -->
    <div class="col-md-3">
      <ul class="nav nav-pills nav-stacked custom-pills config-nav" role="tablist">
        <li role="presentation" class="active">
          <a href="#codigosCufd" data-toggle="tab"><i class="fa fa-key"></i> CUFD</a>
        </li>
        <li role="presentation">
          <a href="#codigosCuis" data-toggle="tab"><i class="fa fa-cog"></i> CUIS</a>
        </li>
      </ul>
    </div>

    <!-- Panel derecho -->
    <div class="col-md-9">
      <div class="tab-content p-3 card shadow-sm bg-white rounded">

        <!-- CUFD -->
        <div class="tab-pane fade in active" id="codigosCufd">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-key text-primary"></i> Listado de CUFD</h4>
            </div>
            <div class="col-md-4 text-right">
              <a href="<?= site_url('billing/sincronizar_cufd'); ?>" class="btn btn-warning btn-lg" title="Obtener nuevo CUFD">
                <span class="ion-loop"></span> Obtener nuevo CUFD
              </a>
            </div>
          </div>
          <br>
          <div class="card mt-3 shadow-sm">
            <div class="card-header bg-primary text-white">
              <strong><i class="fa fa-list"></i> Resultados</strong>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
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
                            <?= strtotime($c['fecha_vigencia']) > time()
                              ? '<span class="badge badge-success">Vigente</span>'
                              : '<span class="badge badge-danger">Expirado</span>' ?>
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
          </div>
        </div>

        <!-- CUIS -->
        <div class="tab-pane fade" id="codigosCuis">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-cog text-primary"></i> Listado de CUIS</h4>
            </div>
            <div class="col-md-4 text-right">
              <a href="<?= site_url('billing/sincronizar_cuis'); ?>" class="btn btn-warning btn-lg" title="Obtener nuevo CUIS">
                <span class="ion-loop"></span> Obtener nuevo CUIS
              </a>
            </div>
          </div>
          <br>
          <div class="card mt-3 shadow-sm">
            <div class="card-header bg-primary text-white">
              <strong><i class="fa fa-list"></i> Resultados</strong>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Registro</th>
                      <th>Vigencia</th>
                      <th>Sucursal</th>
                      <th>Pto. Venta</th>
                      <th>CUIS</th>
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
                            <?= !empty($u['fechaVigencia']) && strtotime($u['fechaVigencia']) > time()
                              ? '<span class="badge badge-success">Vigente</span>'
                              : '<span class="badge badge-secondary">--</span>' ?>
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

      </div> <!-- tab-content -->
    </div> <!-- col-md-9 -->
  </div> <!-- row -->
</div>

<!-- Estilos -->
<style>
  .config-nav .nav-link,
  .config-nav li a {
    display: block;
    padding: 12px 15px;
    margin-bottom: 5px;
    background: #f8f9fa;
    color: #333;
    font-weight: 500;
    text-decoration: none;
  }

  .config-nav li.active a,
  .config-nav .nav-link.active {
    background: rgb(62, 133, 209);
    color: #fff;
  }
</style>

<!-- Script para tabs -->
<script type="text/javascript">
  $(function() {
    $('.config-nav a').on('click', function(e) {
      e.preventDefault();
      $('.config-nav li').removeClass('active');
      $(this).parent().addClass('active');
      $('.tab-pane').removeClass('in active show');
      $($(this).attr('href')).addClass('in active show');
    });
  });
</script>

<?php $this->load->view("partial/footer"); ?>
