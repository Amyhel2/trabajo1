<?php
$this->load->view("partial/header");
$this->load->view("partial/header_facturacion");
?>

<div class="container-fluid mt-4">
  <div class="row mb-3">
    <div class="col-md-8">
      <h4>
        <i class="fa fa-briefcase text-primary"></i> Nueva Sucursal
      </h4>
    </div>
    <div class="col-md-4 text-right">
      <a href="<?= site_url('billing/sucursales'); ?>" class="btn btn-info btn-sm">
        <i class="ion-arrow-return-left"></i> Volver
      </a>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="<?= site_url('billing/crearSucursal'); ?>">

        <!-- Flash messages -->
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
            <label for="nroSucursal">Número Sucursal</label>
            <input type="text" name="nroSucursal" id="nroSucursal" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <label for="codigoSucursal">Código Sucursal</label>
            <input type="text" name="codigoSucursal" id="codigoSucursal" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="sucursal">Nombre Sucursal</label>
            <input type="text" name="sucursal" id="sucursal" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <label for="responsable">Responsable</label>
            <input type="text" name="responsable" id="responsable" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control">
          </div>
          <div class="form-group col-md-4">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control">
          </div>
          <div class="form-group col-md-4">
            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular" class="form-control">
          </div>
        </div>

        <div class="form-row">
          <div class="col text-right">
            <button type="submit" class="btn btn-success">
              <i class="ion-plus"></i> Crear Sucursal
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view("partial/footer"); ?>