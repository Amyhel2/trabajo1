<?php $this->load->view('partial/header', $datos_usuario);?>

<?php $this->load->view('partial/header_facturacion', $datos_usuario);?>

<div class="container-fluid mt-4">
  <div class="row mb-3">
    <div class="col-md-8">
      <h4><i class="fa fa-boxes text-primary"></i> Nuevo Punto de Venta</h4>
    </div>
    <div class="col-md-4 text-right">
      <a href="<?= site_url('billing/sucursales#puntosDeVenta'); ?>" class="btn btn-info btn-sm">
        <i class="ion-arrow-return-left"></i> Volver
      </a>
    </div>
  </div>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="<?= site_url('billing/guardarPuntoVenta'); ?>">
        <?php if ($msg = $this->session->flashdata('success')): ?>
          <div class="alert alert-success">
            <i class="fa fa-check-circle"></i> <?= $msg; ?>
          </div>
        <?php endif; ?>
        <?php if ($msg = $this->session->flashdata('error')): ?>
          <div class="alert alert-danger">
            <i class="fa fa-exclamation-circle"></i> <?= $msg; ?>
          </div>
        <?php endif; ?>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nroSucursal">Código Sucursal</label>
            <input type="text" name="nroSucursal" id="nroSucursal" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <label for="nroPuntoVenta">Nro. Punto de Venta</label>
            <input type="text" name="nroPuntoVenta" id="nroPuntoVenta" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nombre">Nombre Punto</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
          </div>
          <div class="form-group col-md-3">
            <label for="tipo_punto_venta">Tipo PV</label>
            <input type="text" name="tipo_punto_venta" id="tipo_punto_venta" class="form-control" required>
          </div>
          <div class="form-group col-md-3">
            <label for="tipo_emision">Emisión</label>
            <input type="text" name="tipo_emision" id="tipo_emision" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="col text-right">
            <button type="submit" class="btn btn-success">
              <i class="ion-plus"></i> Crear Punto
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view("partial/footer"); ?>
