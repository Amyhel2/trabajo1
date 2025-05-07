<?php
$this->load->view("partial/header");
$this->load->view("partial/header_facturacion");
?>

<div class="container-fluid mt-4">
    <h4 class="mb-3">
        <i class="fa fa-qrcode text-primary"></i> Códigos SIAT
    </h4>

<div class="row">
    <!-- Menú lateral -->
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked custom-pills config-nav" role="tablist">
            <li role="presentation" class="active">
                <a href="#codigosCufd" data-toggle="tab"><i class="fa fa-briefcase"></i> CUFD</a>
            </li>
            <li role="presentation">
                <a href="#codigosCuis" data-toggle="tab"><i class="fa fa-boxes"></i> CUIS</a>
            </li>
        </ul>
    </div>

    <!-- Paneles de contenido -->
    <div class="col-md-9">
        <div class="tab-content p-3 card shadow-sm bg-white rounded">

            <!-- CUFD -->
            <div class="tab-pane fade in active" id="codigosCufd">
                <div class="row mt-3">
                    <div class="col-md-8">
                        <h4><i class="fa fa-qrcode text-primary"></i> Listado CUFD</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="<?php echo site_url('billing/obtener_cufd'); ?>" class="btn btn-warning btn-lg" title="Sincronizar CUFD">
                            <span class="ion-loop"></span> Sincronizar
                        </a>
                    </div>
                </div>
                <br>

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <strong><i class="fa fa-list"></i> Resultados CUFD</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>                                      
                                        <th>Fecha Registro</th>
                                        <th>Fecha Vigencia</th>
                                        <th>Sucursal</th>
                                        <th>Punto Venta</th>
                                        <th>CUFD</th>
                                        <th>Código Control</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($cufds)): ?>
                                        <?php $i = 1; foreach ($cufds as $cufd): ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $cufd['fechaRegistro'] ?? '-'; ?></td>
                                                <td><?php echo $cufd['fechaVigencia'] ?? '-'; ?></td>
                                                <td><?php echo $cufd['nroSucursal'] ?? '-'; ?></td>
                                                <td><?php echo $cufd['nroPuntoVenta'] ?? '-'; ?></td>
                                                <td><?php echo $cufd['codigoCufd'] ?? '-'; ?></td>
                                                <td><?php echo $cufd['codigoControl'] ?? '-'; ?></td>
                                                <td><?php echo $cufd['estado'] ?? '-'; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center text-muted p-3">
                                                <i class="fa fa-info-circle"></i> No hay registros CUFD.
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
                        <h4><i class="fa fa-qrcode text-primary"></i> Listado CUIS</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="<?php echo site_url('billing/obtener_cuis'); ?>" class="btn btn-warning btn-lg" title="Sincronizar CUIS">
                            <span class="ion-loop"></span> Sincronizar
                        </a>
                    </div>
                </div>
                <br>

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <strong><i class="fa fa-list"></i> Resultados CUIS</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>                                 
                                        <th>Fecha Registro</th>
                                        <th>Fecha Vigencia</th>
                                        <th>Sucursal</th>
                                        <th>Punto Venta</th>
                                        <th>Codigo CUIS</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($cuis)): ?>
                                        <?php $j = 1; foreach ($cuis as $cuis_item): ?>
                                            <tr>
                                                <td><?php echo $j++; ?></td>
                                                <td><?php echo $cuis_item['fechaRegistro'] ?? '-'; ?></td>
                                                <td><?php echo $cuis_item['fechaVigencia'] ?? '-'; ?></td>
                                                <td><?php echo $cuis_item['nroSucursal'] ?? '-'; ?></td>
                                                <td><?php echo $cuis_item['nroPuntoVenta'] ?? '-'; ?></td>
                                                <td><?php echo $cuis_item['codigoCuis'] ?? '-'; ?></td>
                                                <td><?php echo $cuis_item['estado'] ?? '-'; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted p-3">
                                                <i class="fa fa-info-circle"></i> No hay registros CUIS.
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
  $(function() {
    $('.config-nav a').on('click', function (e) {
      e.preventDefault();
      $('.config-nav li').removeClass('active');
      $(this).parent().addClass('active');
      $('.tab-pane').removeClass('in active show');
      $($(this).attr('href')).addClass('in active show');
    });
  });
</script>

<?php $this->load->view("partial/footer"); ?>
