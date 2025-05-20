<?php
$this->load->view("partial/header");
$this->load->view("partial/header_facturacion");
?>

<div class="container-fluid">
  <h4 class="mb-0">
    <i class="fa fa-qrcode text-primary"></i> Sucursales - Puntos de Venta
  </h4>
  <div class="row">
    <!-- Menú lateral -->
    <div class="col-md-3">
      <ul class="nav nav-pills nav-stacked custom-pills config-nav" role="tablist">
        <li role="presentation" class="active">
          <a href="#sucursales" data-toggle="tab"><i class="fa fa-briefcase"></i> Sucursales</a>
        </li>
        <li role="presentation"><a href="#puntosDeVenta" data-toggle="tab"><i class="fa fa-boxes"></i> Punto de Venta</a></li>
      </ul>
    </div>

    <!-- Paneles de contenido -->
    <div class="col-md-9">
      <div class="tab-content p-3 card shadow-sm bg-white rounded">

        <div class="tab-pane fade in active" id="sucursales">

          <div class="row mt-3">
            <div class="col-md-8">

              <h4><i class="fa fa-qrcode text-primary"></i> Listado de Sucursales</h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="<?php echo site_url('billing/nuevaSucursal'); ?>" class="btn btn-success btn-lg hidden-sm hidden-xs">
                <span class="ion-plus"></span> Nuevo
              </a>
            </div>
          </div>
          <br>
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
                      <th>Sucursal</th>
                      <th>Responsable</th>
                      <th>Telefono</th>
                      <th>Celular</th>
                      <th>Direccion</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
  <?php if (!empty($sucursales)) : ?>
    <?php $i = 1; foreach ($sucursales as $sucursal) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><?= htmlspecialchars($sucursal->nombre) ?></td>
        <td><?= htmlspecialchars($sucursal->responsable) ?></td>
        <td><?= htmlspecialchars($sucursal->telefono) ?></td>
        <td><?= htmlspecialchars($sucursal->celular) ?></td>
        <td><?= htmlspecialchars($sucursal->direccion) ?></td>
        <td>
          <a href="<?= site_url('billing/editarSucursal/' . $sucursal->id) ?>"
             class="btn btn-info btn-lg hidden-sm hidden-xs"
             title="Editar sucursal">
            <span class="ion-edit">Editar</span>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else : ?>
    <tr>
      <td colspan="7" class="text-center text-muted p-3">
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

        <div class="tab-pane fade" id="puntosDeVenta">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-qrcode text-primary"></i> Listado Puntos de Venta </h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="<?php echo site_url('billing/crearPuntoVenta'); ?>" class="btn btn-success btn-lg hidden-sm hidden-xs">
                <span class="ion-plus"></span> Nuevo
              </a>
              <!-- Sincronizar puntos de venta -->

              <a href="<?php echo site_url('billing/sincronizar_puntos'); ?>" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>
            </div>
          </div>
          <br>
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
                      <th>N° Sucursal</th>
                      <th>N° Punto de Venta</th>
                      <th>Nombre PV</th>
                      <th>Tipo PV</th>
                      <th>Emision</th>
                    </tr>
                  </thead>
                  <tbody>
  <?php if (!empty($puntos)) : ?>
    <?php $j = 1; foreach ($puntos as $pv) : ?>
      <tr>
        <td><?= $j++; ?></td>
        <td><?= $pv->id_sucursal ?></td>
        <td><?= $pv->nro_punto_venta ?></td>
        <td><?= $pv->nombre ?></td>
        <td><?= $pv->tipo_punto_venta ?></td>
        <td><?= $pv->tipo_emision ?></td>
      </tr>
    <?php endforeach; ?>
  <?php else : ?>
    <tr>
      <td colspan="6" class="text-center text-muted p-3">
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
      </div>

    </div>
  </div>
</div>
</div>

<style>
  .config-nav .nav-link {
    padding: 12px 15px;
    margin-bottom: 5px;
    background: #f8f9fa;
    border-radius: 0;
    font-weight: 500;
    color: #333;
  }

  .config-nav .nav-link.active {
    background: #007bff;
    color: #fff;
  }
</style>

<script type="text/javascript">
  $("#employee_id").select2();
  date_time_picker_field($("#expire_date"), JS_DATE_FORMAT);
</script>

<?php $this->load->view("partial/footer"); ?>


