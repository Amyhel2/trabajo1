<?php $this->load->view("partial/header"); ?>
<?php $this->load->view("partial/header_facturacion"); ?>

<div class="container-fluid mt-4">
  <!-- Título principal -->
  <div class="row mb-3">
    <div class="col-md-8">
      <h4>
        <i class="fa fa-file-invoice text-primary"></i> Nuevo Sucursal
      </h4>
    </div>
    <div class="col-md-4 text-right">
      <a href="<?php echo site_url('billing/sucursales'); ?>" class="btn btn-info">
        <i class="ion-arrow-return-left"></i> Volver a Sucursales
      </a>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">

      <form method="post" action="<?php echo site_url('billing/crearSucursal'); ?>">
      <?php if ($msg = $this->session->flashdata('success')): ?>
  <div class="alert alert-success">
    <i class="fa fa-check-circle"></i> <?php echo $msg; ?>
  </div>
<?php endif; ?>

<?php if ($msg = $this->session->flashdata('error')): ?>
  <div class="alert alert-danger">
    <i class="fa fa-exclamation-circle"></i> <?php echo $msg; ?>
  </div>
<?php endif; ?>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="numero_sucursal">Número de Sucursal:</label>
            <input type="text" name="nroSucursal" id="numero_sucursal" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="codigo_sucursal">Código Sucursal:</label>
            <input type="text" name="codigoSucursal" id="codigo_sucursal" class="form-control" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="sucursal">Nombre Sucursal:</label>
            <input type="text" name="sucursal" id="sucursal" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="responsable">Responsable:</label>
            <input type="text" name="responsable" id="responsable" class="form-control" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" class="form-control">
          </div>
          <div class="col-md-4 mb-3">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control">
          </div>
          <div class="col-md-4 mb-3">
            <label for="celular">Celular:</label>
            <input type="text" name="celular" id="celular" class="form-control">
          </div>
        </div>
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
