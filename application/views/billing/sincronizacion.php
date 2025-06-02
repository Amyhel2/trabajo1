<?php $this->load->view('partial/header', $datos_usuario);?>

<?php $this->load->view('partial/header_facturacion', $datos_usuario);?>

<div class="container-fluid">
  <div class="row mt-3">
    <div class="col-md-8">
      <h4 class="mb-0">
        <i class="fa fa-qrcode text-primary"></i> Sincronizacion SIAT
      </h4>
    </div>

    <div class="col-md-4" style="text-align: right;">
      
      <!-- Dentro de tu archivo sincronizacion.php -->
<form method="post" action="<?php echo site_url('billing/sincronizarsi porfaas dame el cotrolador '); ?>">
    <button type="submit" class="btn btn-info">Sincronizar con API</button>
</form>

    </div>
  </div>
  <br>
  <div class="row">

    <!-- Menú lateral -->
    <div class="col-md-3">
      <ul class="nav nav-pills nav-stacked custom-pills config-nav" role="tablist">
        <li role="presentation" class="active">
          <a href="#actividades" data-toggle="tab"><i class="fa fa-briefcase"></i> Actividades</a>
        </li>
        <li role="presentation"><a href="#actividadesDocumentoSector" data-toggle="tab"><i class="fa fa-balance-scale"></i> Actividades Documento Sector</a></li>
        <li role="presentation"><a href="#leyendaFactura" data-toggle="tab"><i class="fa fa-balance-scale"></i> Leyendas Factura</a></li>
        <li role="presentation"><a href="#productosServicio" data-toggle="tab"><i class="fa fa-boxes"></i> Productos / Servicios</a></li>
        <li role="presentation"><a href="#eventosSignificativos" data-toggle="tab"><i class="fa fa-calendar-alt"></i> Eventos Significativos</a></li>
        <li role="presentation"><a href="#motivosAnulacion" data-toggle="tab"><i class="fa fa-ban"></i> Motivos Anulación</a></li>
        <li role="presentation"><a href="#tiposDocumentoIdentidad" data-toggle="tab"><i class="fa fa-id-card"></i> Tipos Documento Identidad</a></li>
        <li role="presentation"><a href="#tiposDocumentoSector" data-toggle="tab"><i class="fa fa-file-alt"></i> Tipos Documento Sector</a></li>
        <li role="presentation"><a href="#tiposEmision" data-toggle="tab"><i class="fa fa-credit-card"></i> Tipos de Emision</a></li>
        <li role="presentation"><a href="#tiposMetodosDePago" data-toggle="tab"><i class="fa fa-credit-card"></i> Tipos Métodos de Pago</a></li>
        <li role="presentation"><a href="#tiposMoneda" data-toggle="tab"><i class="fa fa-coins"></i> Tipos Moneda</a></li>
        <li role="presentation"><a href="#tiposPuntoVenta" data-toggle="tab"><i class="fa fa-store"></i> Tipos Punto de Venta</a></li>
        <li role="presentation"><a href="#tipoDeFactura" data-toggle="tab"><i class="fa fa-file-invoice"></i> Tipos de Factura</a></li>
        <li role="presentation"><a href="#unidadesDeMedida" data-toggle="tab"><i class="fa fa-ruler-combined"></i> Unidades de Medida</a></li>
      </ul>
    </div>

    <!-- Paneles de contenido -->
    <div class="col-md-9">
      <div class="tab-content p-3 card shadow-sm bg-white rounded">

        <div class="tab-pane fade in active" id="actividades">

          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-balance-scale text-primary"></i> Actividades </h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>

            </div>
          </div>

          <p class="text-muted">Listado de las actividades.</p>

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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Tipo</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($facturas)) : ?>
                      <?php $i = 1;
                      foreach ($facturas as $factura) : ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $factura['codigo']; ?></td>
                          <td><?php echo $factura['hora']; ?></td>
                          <td><?php echo $factura['hora']; ?></td>
                          <td><?php echo $factura['numeroFactura']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="5" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="actividadesDocumentoSector">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-balance-scale text-primary"></i> Actividades Documento Sector</h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>

          <p class="text-muted">Listado de las actividades documentos del sector.</p>

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
                      <th>Codigo Actividad</th>
                      <th>Codigo Documento Sector</th>
                      <th>Tipo Documento Sector</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($facturas)) : ?>
                      <?php $i = 1;
                      foreach ($facturas as $factura) : ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $factura['codigo']; ?></td>
                          <td><?php echo $factura['hora']; ?></td>
                          <td><?php echo $factura['numeroFactura']; ?></td>
                          <td><?php echo $factura['hora']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="5" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="leyendaFactura">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-balance-scale text-primary"></i> Leyendas Factura</h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>

          <p class="text-muted">Listado de leyendas habilitadas por el SIN para impresión en factura.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="productosServicio">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-boxes text-primary"></i> Productos / Servicios</h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>
          <p class="text-muted">Listado de productos/servicios autorizados para facturar.</p>
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
                      <th>Codigo Actividad</th>
                      <th>Codigo Producto</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="5" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="eventosSignificativos">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-calendar-alt text-primary"></i> Eventos Significativos</h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>

          <p class="text-muted">Eventos como corte de internet, falta de energía, etc.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                          <td><?php echo $factura['numeroDocumento']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="motivosAnulacion">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-ban text-primary"></i> Motivos de Anulación</h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>

          <p class="text-muted">Razones por las cuales una factura puede ser anulada.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                          <td><?php echo $factura['numeroDocumento']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="tiposDocumentoIdentidad">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-id-card text-primary"></i> Tipos Documento Identidad</h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>

          <p class="text-muted">Carnet, pasaporte, NIT, etc.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                          <td><?php echo $factura['numeroDocumento']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="tiposDocumentoSector">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-file-alt text-primary"></i> Tipos Documento Sector</h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>

          <p class="text-muted">Documentos como factura venta, nota crédito, etc.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                          <td><?php echo $factura['numeroDocumento']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="tiposEmision">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-file-alt text-primary"></i> Tipos Emision </h4>
            </div>

            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>

          <p class="text-muted">Tipos de emision.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                          <td><?php echo $factura['numeroDocumento']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="tiposMetodosDePago">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-credit-card text-primary"></i> Tipos Métodos de Pago</h4>
            </div>
            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>

          <p class="text-muted">Efectivo, tarjeta, transferencia, etc.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                          <td><?php echo $factura['numeroDocumento']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="tiposMoneda">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-coins text-primary"></i> Tipos Moneda</h4>
            </div>
            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>

          <p class="text-muted">Bolivianos, dólares, euros, etc.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                          <td><?php echo $factura['numeroDocumento']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="tiposPuntoVenta">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-store text-primary"></i> Tipos Punto de Venta</h4>
            </div>
            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>
          <p class="text-muted">Mostrador, móvil, electrónico, etc.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                          <td><?php echo $factura['numeroDocumento']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="tipoDeFactura">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-file-invoice text-primary"></i> Tipos de Factura</h4>
            </div>
            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>
          <p class="text-muted">Factura de venta, exportación, servicios básicos, etc.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                          <td><?php echo $factura['numeroDocumento']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- Fin Tabla de resultados -->
        </div>

        <div class="tab-pane fade" id="unidadesDeMedida">
          <div class="row mt-3">
            <div class="col-md-8">
              <h4><i class="fa fa-ruler-combined text-primary"></i> Unidades de Medida</h4>
            </div>
            <div class="col-md-4" style="text-align: right;">
              <a href="#" class="btn btn-warning btn-lg hidden-sm hidden-xs" title="Sincronizar">
                <span class="ion-loop"></span> Sincronizar
              </a>

              <a href="#" class="btn btn-danger btn-lg hidden-sm hidden-xs" title="Eliminar">
                <span class="ion-trash-a"></span> Eliminar
              </a>
            </div>
          </div>
          <p class="text-muted">Litros, kilos, metros, unidades, etc.</p>
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
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
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
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                          <i class="fa fa-info-circle"></i> No hay datos a mostrar.
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
    background:rgb(248, 250, 250);
    border-radius: 0;
    font-weight: 500;
    color: #333;
  }

  .config-nav .nav-link.active {
    background:rgb(97, 216, 186);
    color: #fff;
  }
</style>

<script type="text/javascript">
  $("#employee_id").select2();
  date_time_picker_field($("#expire_date"), JS_DATE_FORMAT);
</script>

<?php $this->load->view("partial/footer"); ?>