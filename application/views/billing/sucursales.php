

<div class="container-fluid mt-4">
  <h4 class="mb-3">
    <i class="fa fa-qrcode text-primary"></i> Sucursales - Puntos de Venta
  </h4>

  <div class="row">
    <!-- Menú lateral -->
    <div class="col-md-3">
      <ul class="nav nav-pills nav-stacked custom-pills config-nav" role="tablist">
        <li role="presentation" class="active">
          <a href="#sucursales" data-toggle="tab"><i class="fa fa-briefcase"></i> Sucursales</a>
        </li>
        <li role="presentation">
          <a href="#puntosDeVenta" data-toggle="tab"><i class="fa fa-boxes"></i> Puntos de Venta</a>
        </li>
      </ul>
    </div>

    <!-- Paneles de contenido -->
    <div class="col-md-9">
      <div class="tab-content p-3 card shadow-sm bg-white rounded">

        <!-- SUCURSALES -->
        <div class="tab-pane fade in active" id="sucursales">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-briefcase text-primary"></i> Listado de Sucursales</h4>
            </div>
            <div class="col-md-4 text-right">
              <a href="<?= site_url('billing/nuevaSucursal'); ?>" class="btn btn-success btn-lg">
                <span class="ion-plus"></span> Nuevo
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
                      <th>Sucursal</th>
                      <th>Responsable</th>
                      <th>Teléfono</th>
                      <th>Celular</th>
                      <th>Dirección</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($sucursales)) : ?>
                      <?php $i = 1;
                      foreach ($sucursales as $s) : ?>
                        <tr>
                          <td><?= $i++; ?></td>
                          <td><?= htmlspecialchars($s->nombre) ?></td>
                          <td><?= htmlspecialchars($s->responsable) ?></td>
                          <td><?= htmlspecialchars($s->telefono) ?></td>
                          <td><?= htmlspecialchars($s->celular) ?></td>
                          <td><?= htmlspecialchars($s->direccion) ?></td>
                          <td>
                            <a href="<?= site_url('billing/editarSucursal/' . $s->id) ?>" class="btn btn-info btn-sm" title="Editar">
                              <span class="ion-edit"></span>
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="7" class="text-center text-muted py-3">
                          <i class="fa fa-info-circle"></i> No hay sucursales a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- PUNTOS DE VENTA -->
        <div class="tab-pane fade" id="puntosDeVenta">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-boxes text-primary"></i> Listado de Puntos de Venta</h4>
            </div>
            <div class="col-md-4 text-right">
              <a href="<?= site_url('billing/crearPuntoVenta'); ?>" class="btn btn-success btn-lg">
                <span class="ion-plus"></span> Nuevo
              </a>
              <a href="<?= site_url('billing/sincronizar_puntos'); ?>#puntosDeVenta" class="btn btn-warning btn-lg" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
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
                      <th>Sucursal ID</th>
                      <th>Pto. Venta</th>
                      <th>Nombre PV</th>
                      <th>Tipo PV</th>
                      <th>Emisión</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($puntosVenta)) : ?>
                      <?php $j = 1;
                      foreach ($puntosVenta as $pv) : ?>
                        <tr>
                          <td><?= $j++; ?></td>
                          <td><?= htmlspecialchars($pv->id_sucursal) ?></td>
                          <td><?= htmlspecialchars($pv->nro_punto_venta) ?></td>
                          <td><?= htmlspecialchars($pv->nombre) ?></td>
                          <td><?= htmlspecialchars($pv->tipo_punto_venta) ?></td>
                          <td><?= htmlspecialchars($pv->tipo_emision) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="6" class="text-center text-muted py-3">
                          <i class="fa fa-info-circle"></i> No hay puntos de venta a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div> <!-- /.tab-content -->
    </div> <!-- /.col-md-9 -->
  </div> <!-- /.row -->
</div>

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




