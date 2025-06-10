<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid">
  <!-- Mensajes de éxito / error -->
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <i class="fa fa-check-circle"></i>
      <?= $this->session->flashdata('success') ?>
    </div>
  <?php endif; ?>
  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <i class="fa fa-exclamation-circle"></i>
      <?= $this->session->flashdata('error') ?>
    </div>
  <?php endif; ?>

  <!-- Filtro de fechas -->
  <div class="card mb-3">
    <div class="card-body">
      <form method="post" action="<?= site_url('billing/index') ?>" class="form-inline">
        <label class="mr-2">Fecha Inicio:</label>
        <input type="date" name="fecha_inicio" class="form-control mr-3"
               value="<?= isset($fechainicio) ? $fechainicio : '' ?>">
        <label class="mr-2">Fecha Fin:</label>
        <input type="date" name="fecha_fin" class="form-control mr-3"
               value="<?= isset($fechafin) ? $fechafin : '' ?>">
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
      </form>
    </div>
  </div>

  <!-- Tabla de facturas -->
  <div class="card">
    <div class="card-header bg-primary text-white">
      <i class="fa fa-list"></i> Resultados
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped mb-0">
          <thead>
            <tr>
              <th>#</th><th>Fecha / Hora</th><th>N° Factura</th>
              <th>NIT</th><th>Razón Social</th><th>Total (Bs)</th>
              <th>Estado</th><th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($facturas)): ?>
              <?php foreach ($facturas as $i => $f):
                $idf       = $f['id'];
                $estado    = $f['estado'];
                $cuf       = $f['cuf']               ?? '';
                $email     = $f['email']             ?? '';
                $nitEmisor = $f['nitEmisor']         ?? '';
                $rzs       = $f['nombreRazonSocial'] ?? '';
                $nro       = $f['numeroFactura']     ?? '';
                // Calcular monto total como antes
                $montoTotal = 0;
                if (isset($f['montoTotalSujetoIva'])) {
                    $montoTotal += floatval($f['montoTotalSujetoIva']);
                }
                if (isset($f['descuentoAdicional'])) {
                    $montoTotal += floatval($f['descuentoAdicional']);
                }
                if (isset($f['montoGiftCard'])) {
                    $montoTotal += floatval($f['montoGiftCard']);
                }
                $montoFmt = number_format($montoTotal, 2, ',', '.');
              ?>
              <tr>
                <td><?= $i+1 ?></td>
                <td><?= "{$f['fecha']} {$f['hora']}" ?></td>
                <td><?= $nro ?></td>
                <td><?= $f['numeroDocumento'] ?></td>
                <td><?= $rzs ?></td>
                <td><?= $montoFmt ?></td>
                <td>
                  <span class="badge badge-<?= $estado==='VALIDO'?'success':($estado==='ANULADO'?'danger':'secondary') ?>">
                    <?= $estado ?>
                  </span>
                </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <?php if ($estado === 'VALIDO'): ?>
                      <!-- Ver en SIAT -->
                      <a target="_blank"
                         href="https://pilotosiat.impuestos.gob.bo/consulta/QR?<?= http_build_query([
                             'nit'    => $nitEmisor,
                             'cuf'    => $cuf,
                             'numero' => $nro,
                             't'      => 1
                          ]) ?>"
                         class="btn btn-info" title="Ver en SIAT">
                        <i class="fa fa-external-link-alt"></i>
                      </a>
                      <!-- Imprimir ticket -->
                      <button class="btn btn-default" title="Imprimir ticket"
                              onclick="window.location='<?= site_url("billing/imprimir_ticket/$idf") ?>'">
                        <i class="fa fa-print"></i>
                      </button>
                      <!-- Imprimir media página -->
                      <button class="btn btn-info" title="Imprimir media página"
                              onclick="window.location='<?= site_url("billing/imprimir_pagina/$idf") ?>'">
                        <i class="fa fa-print"></i>
                      </button>
                      <!-- Ver XML: si mantienes ruta local -->
                      <a target="_blank"
                         href="<?= base_url("Siat/temp/factura-$cuf.xml") ?>"
                         class="btn btn-success" title="Ver XML">
                        <i class="fa fa-file-code"></i>
                      </a>
                      <!-- Enviar Email -->
                      <?php if ($email): ?>
                        <button class="btn btn-warning"
                                onclick="reEnviarMailFactura(
                                   '<?= $email ?>',
                                   '<?= htmlspecialchars($rzs, ENT_QUOTES) ?>',
                                   '<?= $f['numeroDocumento'] ?>',
                                   '<?= $cuf ?>',
                                   '<?= $idf ?>'
                                )"
                                title="Reenviar Email">
                          <i class="fa fa-envelope"></i>
                        </button>
                      <?php else: ?>
                        <button class="btn btn-warning disabled" title="No hay correo">
                          <i class="fa fa-envelope"></i>
                        </button>
                      <?php endif; ?>
                      <!-- Anular: abre modal -->
                      <button class="btn btn-danger"
                              onclick="modalAnularFactura('<?= $idf ?>')"
                              title="Anular">
                        <i class="fa fa-ban"></i>
                      </button>

                    <?php elseif ($estado==='ANULADO'): ?>
                      <!-- Ver en SIAT -->
                      <a target="_blank"
                         href="https://pilotosiat.impuestos.gob.bo/consulta/QR?<?= http_build_query([
                             'nit'=>$nitEmisor,'cuf'=>$cuf,'numero'=>$nro,'t'=>1
                          ]) ?>"
                         class="btn btn-default" title="Ver en SIAT">
                        <i class="fa fa-external-link-alt"></i>
                      </a>
                      <!-- Revertir -->
                      <button class="btn btn-danger"
                              onclick="if(confirm('¿Revertir anulación?')) window.location='<?= site_url("billing/revertir_factura/$idf") ?>';"
                              title="Revertir factura">
                        <i class="fa fa-undo"></i>
                      </button>

                    <?php else: ?>
                      <!-- Otros estados: solo Ver SIAT -->
                      <a target="_blank"
                         href="https://pilotosiat.impuestos.gob.bo/consulta/QR?<?= http_build_query([
                             'nit'=>$nitEmisor,'cuf'=>$cuf,'numero'=>$nro,'t'=>1
                          ]) ?>"
                         class="btn btn-secondary" title="Ver en SIAT">
                        <i class="fa fa-external-link-alt"></i>
                      </a>
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8" class="text-center p-3">No se encontraron facturas.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Anular Factura -->
<div id="modalAnular" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Anular Factura</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="modalAnular_idf" value="">
        <div class="form-group">
          <label for="selectMotivo">Motivo de Anulación:</label>
          <select id="selectMotivo" class="form-control">
            <option value="">-- Seleccionar motivo --</option>
            <option value="ERROR_DATOS">Error en datos</option>
            <option value="CLIENTE_SOLICITA">Cliente solicita</option>
            <option value="OTRO">Otro</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="btnConfirmarAnular" type="button" class="btn btn-danger">Anular Factura</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Función para abrir modal de anulación
  function modalAnularFactura(idf) {
    $('#modalAnular_idf').val(idf);
    $('#selectMotivo').val('');
    $('#modalAnular').modal('show');
  }
  // Confirmar anulación vía AJAX
  function anularFacturaConfirm() {
    var idf = $('#modalAnular_idf').val();
    var motivo = $('#selectMotivo').val();
    if (!idf || !motivo) {
      alert('Seleccione un motivo y asegúrese de tener ID de factura.');
      return;
    }
    // Enviar AJAX POST a billing/anular_factura
    $.ajax({
      url: '<?= site_url("billing/anular_factura") ?>',
      type: 'POST',
      dataType: 'json',
      data: {
        idf: idf,
        motivo: motivo,
        // CSRF token de CI3 si está habilitado
        <?= $this->config->item('csrf_protection') ? "'" . $this->security->get_csrf_token_name() . "': '" . $this->security->get_csrf_hash() . "',": '' ?>
      },
      success: function(resp) {
        if (resp.success) {
          swal("¡Éxito!", "Factura anulada correctamente.", "success");
          // Recargar la página o recargar listado: aquí recargamos con submit del filtro
          // Para simplificar:
          location.reload();
        } else {
          swal("Error", resp.message || 'No se pudo anular factura', "error");
        }
      },
      error: function(xhr, status, error) {
        swal("Error", "Error en la petición de anulación: " + error, "error");
      }
    });
    $('#modalAnular').modal('hide');
  }
  // Asociar botón Confirmar Anular
  $('#btnConfirmarAnular').on('click', anularFacturaConfirm);

  // Reenviar email: swal confirm + AJAX a billing/enviar_email
  function reEnviarMailFactura(mail, rzs, nit, cuf, idf) {
    swal({
      title: "Reenviar Factura",
      text: "¿Desea reenviar correo de esta factura?",
      icon: "warning",
      buttons: {
        cancel: "Cancelar",
        confirm: {
          text: "Enviar",
          value: true,
          visible: true,
          className: "btn-warning"
        }
      },
      dangerMode: true,
    })
    .then((isConfirm) => {
      if (isConfirm) {
        enviarMailFactura(mail, rzs, nit, cuf, idf);
      }
    });
  }
  function enviarMailFactura(mail, rzs, nit, cuf, idf) {
    $.ajax({
      url: '<?= site_url("billing/enviar_email") ?>',
      type: 'POST',
      dataType: 'json',
      data: {
        idf: idf,
        email: mail,
        rzs: rzs,
        nit: nit,
        cuf: cuf,
        <?= $this->config->item('csrf_protection') ? "'" . $this->security->get_csrf_token_name() . "': '" . $this->security->get_csrf_hash() . "',": '' ?>
      },
      success: function(resp) {
        if (resp.success) {
          swal("¡Éxito!", "Factura reenviada correctamente a: " + mail, "success");
        } else {
          swal("Error", 'No se pudo reenviar la factura: ' + JSON.stringify(resp.data||resp.message), "error");
        }
      },
      error: function(xhr, status, error) {
        swal("Error", "Error en la petición de reenvío: " + error, "error");
      }
    });
  }

  function enviarMailFactura(mail, rzs, nit, cuf, idf) {
  $.ajax({
    url: '<?= site_url("billing/enviar_email") ?>',
    type: 'POST',
    dataType: 'json',
    data: {
      idf: idf,
      email: mail,
      rzs: rzs,
      nit: nit,
      cuf: cuf,
      <?= $this->config->item('csrf_protection') ? "'" . $this->security->get_csrf_token_name() . "': '" . $this->security->get_csrf_hash() . "',": '' ?>
    },
    success: function(resp) {
      // Independientemente de swal, recargamos para que flashdata se muestre:
      if (resp.success) {
        // Puedes opcionalmente mostrar swal antes de recargar:
        swal("¡Éxito!", "El correo se reenviará; recargando...", "success")
          .then(() => { location.reload(); });
      } else {
        swal("Error", "No se pudo reenviar el correo; recargando para ver detalles.", "error")
          .then(() => { location.reload(); });
      }
    },
    error: function(xhr, status, error) {
      swal("Error", "Error en la petición: " + error + ". Recargando...", "error")
        .then(() => { location.reload(); });
    }
  });
}

</script>
