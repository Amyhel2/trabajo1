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
            <?php if (!empty($facturas)): ?>
              <?php foreach ($facturas as $i => $f): ?>
                <?php
                  $idf       = $f['id'];
                  $estado    = $f['estado'];
                  $cuf       = $f['cuf']               ?? '';
                  $email     = $f['email']             ?? '';
                  $nitEmisor = $f['nitEmisor']         ?? '';
                  $rzs       = $f['nombreRazonSocial'] ?? '';
                  $nro       = $f['numeroFactura']     ?? '';
                ?>
                <tr>
                  <td><?= $i + 1 ?></td>
                  <td><?= "{$f['fecha']} {$f['hora']}" ?></td>
                  <td><?= $nro ?></td>
                  <td><?= $f['numeroDocumento'] ?></td>
                  <td><?= $rzs ?></td>
                  <td><?= number_format($f['montoTotalSujetoIva'], 2, ',', '.') ?></td>
                  <td>
                    <span class="badge badge-<?= $estado === 'VALIDO'
                      ? 'success'
                      : ($estado === 'ANULADO' ? 'danger' : 'secondary') ?>">
                      <?= $estado ?>
                    </span>
                  </td>
                  <td>
                    <div class="btn-group" role="group">

                      <?php if ($estado === 'VALIDO'): ?>
                        <!-- Ver en SIAT -->
                        <a href="https://pilotosiat.impuestos.gob.bo/consulta/QR?<?= http_build_query([
                              'nit'    => $nitEmisor,
                              'cuf'    => $cuf,
                              'numero' => $nro,
                              't'      => 1
                            ]) ?>"
                           target="_blank"
                           class="btn btn-info btn-sm"
                           title="Ver Factura en Impuestos">
                          <i class="fa fa-external-link-alt"></i>
                        </a>

                        <!-- Imprimir Rollo/Ticket -->
                        <button type="button"
                                class="btn btn-default btn-sm"
                                title="Imprimir Rollo/Ticket"
                                onclick="window.location='<?= site_url("billing/imprimir_ticket/{$idf}") ?>';">
                          <i class="fa fa-print"></i>
                        </button>

                        <!-- Imprimir Media Página -->
                        <button type="button"
                                class="btn btn-info btn-sm"
                                title="Imprimir Media Página"
                                onclick="window.location='<?= site_url("billing/imprimir_pagina/{$idf}") ?>';">
                          <i class="fa fa-print"></i>
                        </button>

                        <!-- Ver XML -->
                        <a href="https://pilotosiat.impuestos.gob.bo/api/Siat/temp/factura-<?= $cuf ?>.xml"
                           target="_blank"
                           class="btn btn-success btn-sm"
                           title="Ver XML">
                          <i class="fa fa-file-code"></i>
                        </a>

                        <!-- Enviar Email -->
                        <?php if ($email): ?>
                          <button type="button"
                                  class="btn btn-warning btn-sm"
                                  title="Enviar Email"
                                  onclick="if(confirm('¿Enviar factura al correo <?= $email ?>?')) window.location='<?= site_url("billing/enviar_email/{$idf}") ?>';">
                            <i class="fa fa-envelope"></i>
                          </button>
                        <?php else: ?>
                          <button class="btn btn-warning btn-sm disabled" title="No hay correo">
                            <i class="fa fa-envelope"></i>
                          </button>
                        <?php endif; ?>

                        <!-- Anular Factura -->
                        <button type="button"
                                class="btn btn-danger btn-sm"
                                title="Anular Factura"
                                onclick="if(confirm('¿Seguro que deseas anular esta factura?')) window.location='<?= site_url("billing/anular_factura/{$idf}") ?>';">
                          <i class="fa fa-ban"></i>
                        </button>

                      <?php elseif ($estado === 'ANULADO'): ?>
                        <!-- Ver en SIAT -->
                        <a href="https://pilotosiat.impuestos.gob.bo/consulta/QR?<?= http_build_query([
                              'nit'    => $nitEmisor,
                              'cuf'    => $cuf,
                              'numero' => $nro,
                              't'      => 1
                            ]) ?>"
                           target="_blank"
                           class="btn btn-default btn-sm"
                           title="Ver Factura en Impuestos">
                          <i class="fa fa-external-link-alt"></i>
                        </a>

                        <!-- Revertir Anulación -->
                        <button type="button"
                                class="btn btn-danger btn-sm"
                                title="Revertir Anulación"
                                onclick="if(confirm('¿Seguro que deseas revertir la anulación?')) window.location='<?= site_url("billing/revertir_factura/{$idf}") ?>';">
                          <i class="fa fa-undo"></i>
                        </button>

                      <?php elseif ($estado === 'REVERTIDO'): ?>
                        <!-- Ver en SIAT -->
                        <a href="https://pilotosiat.impuestos.gob.bo/consulta/QR?<?= http_build_query([
                              'nit'    => $nitEmisor,
                              'cuf'    => $cuf,
                              'numero' => $nro,
                              't'      => 1
                            ]) ?>"
                           target="_blank"
                           class="btn btn-info btn-sm"
                           title="Ver Factura en Impuestos">
                          <i class="fa fa-external-link-alt"></i>
                        </a>

                        <!-- Imprimir Rollo/Ticket -->
                        <button type="button"
                                class="btn btn-default btn-sm"
                                title="Imprimir Rollo/Ticket"
                                onclick="window.location='<?= site_url("billing/imprimir_ticket/{$idf}") ?>';">
                          <i class="fa fa-print"></i>
                        </button>

                        <!-- Imprimir Media Página -->
                        <button type="button"
                                class="btn btn-info btn-sm"
                                title="Imprimir Media Página"
                                onclick="window.location='<?= site_url("billing/imprimir_pagina/{$idf}") ?>';">
                          <i class="fa fa-print"></i>
                        </button>

                        <!-- Ver XML -->
                        <a href="https://pilotosiat.impuestos.gob.bo/api/Siat/temp/factura-<?= $cuf ?>.xml"
                           target="_blank"
                           class="btn btn-success btn-sm"
                           title="Ver XML">
                          <i class="fa fa-file-code"></i>
                        </a>

                      <?php else: ?>
                        <!-- OTROS ESTADOS: solo Ver SIAT -->
                        <a href="https://pilotosiat.impuestos.gob.bo/consulta/QR?<?= http_build_query([
                              'nit'    => $nitEmisor,
                              'cuf'    => $cuf,
                              'numero' => $nro,
                              't'      => 1
                            ]) ?>"
                           target="_blank"
                           class="btn btn-secondary btn-sm"
                           title="Ver Factura en Impuestos">
                          <i class="fa fa-external-link-alt"></i>
                        </a>
                      <?php endif; ?>

                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8" class="text-center">No se encontraron facturas.</td>
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