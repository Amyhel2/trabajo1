
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
        <input type="date" name="fecha_inicio" class="form-control mr-3" value="<?= $fechainicio ?>">
        <label class="mr-2">Fecha Fin:</label>
        <input type="date" name="fecha_fin" class="form-control mr-3" value="<?= $fechafin ?>">
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
              ?>
              <tr>
                <td><?= $i+1 ?></td>
                <td><?= "{$f['fecha']} {$f['hora']}" ?></td>
                <td><?= $nro ?></td>
                <td><?= $f['numeroDocumento'] ?></td>
                <td><?= $rzs ?></td>
                <td><?= number_format($f['montoTotalSujetoIva'],2,',','.') ?></td>
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
                      <!-- Imprimir ticket/página -->
                      <button class="btn btn-default" title="Imprimir ticket"
                              onclick="window.location='<?= site_url("billing/imprimir_ticket/$idf") ?>'">
                        <i class="fa fa-print"></i>
                      </button>
                      <button class="btn btn-info" title="Imprimir media página"
                              onclick="window.location='<?= site_url("billing/imprimir_pagina/$idf") ?>'">
                        <i class="fa fa-print"></i>
                      </button>
                      <!-- Ver XML -->
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
           '<?= $cuf ?>'
        )"
        title="Reenviar Email">
  <i class="fa fa-envelope"></i>
</button>

                      <?php else: ?>
                        <button class="btn btn-warning disabled" title="No hay correo">
                          <i class="fa fa-envelope"></i>
                        </button>
                      <?php endif; ?>
                      <!-- Anular -->
                      <button class="btn btn-danger"
                              onclick="if(confirm('¿Anular factura?')) window.location='<?= site_url("billing/anular_factura/$idf") ?>';"
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

<script>
  // 1) Confirmación: “¿Desea reenviar correo de esta factura?”
  function reEnviarMailFactura(mail, rzs, nit, cuf) {
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
        enviarMailFactura(mail, rzs, nit, cuf);
      }
    });
  }

  // 2) Llamada directa a la API (igual que en tu sistema original)
  function enviarMailFactura(mail, rzs, nit, cuf) {
    var body = {
      funcion: "enviarMailFactura",
      mail: mail,
      rzs: rzs,
      nit: nit,
      cuf: cuf
    };

    Empresa.showSpinner();
    Empresa.rest({
      verbo: 'POST',
      url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
      data: body,
      funcionExito: function(respuesta) {
        Empresa.hideSpinner();
        if (respuesta.correo) {
          swal("¡Éxito!", "Factura reenviada correctamente a: " + mail, "success");
        } else {
          swal("Error", respuesta.error || "No se pudo reenviar la factura", "error");
        }
      },
      funcionError: function(e) {
        Empresa.hideSpinner();
        swal("Error", "Falla en la petición de reenvío", "error");
      }
    });
  }
</script>





