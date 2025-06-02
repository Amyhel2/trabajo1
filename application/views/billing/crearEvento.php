<?php $this->load->view('partial/header', $datos_usuario);?>

<?php $this->load->view('partial/header_facturacion', $datos_usuario);?>

<div class="container-fluid mt-4">
  <!-- Título principal -->
  <div class="row mb-3">
    <div class="col-md-8">
      <h4>
        <i class="fa fa-file-invoice text-primary"></i> Nuevo Evento
      </h4>
    </div>
    <div class="col-md-4 text-right">
      <a href="<?php echo site_url('billing/eventos'); ?>" class="btn btn-info">
        <i class="ion-arrow-return-left"></i> Volver a Eventos
      </a>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      
      <form method="post" action="<?php echo site_url('billing/crearEvento'); ?>">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="punto_de_venta">Punto de Venta:</label>
            <select class="form-control" name="punto_de_venta" id="punto_de_venta" required>
              <option value="">-- Seleccionar --</option>
              <?php foreach ($pos as $p): ?>
                <option value="<?= $p['nroPuntoVenta'] ?>">
                  <?= $p['nombrePuntoVenta'] ?> (Sucursal <?= $p['nroSucursal'] ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label for="tipo_evento">Tipo de Evento:</label>
            <select class="form-control" name="tipo_evento" id="tipo_evento" required>
              <option value="">-- Seleccionar --</option>
              <option value="1">Evento Significativo CAF-C</option>
              <option value="2">Otro Evento Significativo</option>
            </select>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-success">
              <i class="ion-plus"></i> Crear
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view("partial/footer"); ?>