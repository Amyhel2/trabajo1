<?php $this->load->view('partial/header', $datos_usuario);?>

<?php $this->load->view('partial/header_facturacion', $datos_usuario);?>

<div class="container-fluid mt-4">
  <div class="row mb-3">
    <div class="col-md-8">
      <h4><i class="fa fa-edit text-primary"></i> Editar Sucursal</h4>
    </div>
    <div class="col-md-4 text-right">
      <a href="<?= site_url('billing/sucursales'); ?>" class="btn btn-info">
        <i class="ion-arrow-return-left"></i> Volver
      </a>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="<?= site_url('billing/actualizarSucursal'); ?>">
        <input type="hidden" name="id" value="<?= $sucursal->id ?>">

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nroSucursal">Nº Sucursal</label>
            <input type="text" class="form-control" id="nroSucursal" value="<?= $sucursal->nroSucursal ?>" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="codigoSucursal">Código Sucursal</label>
            <input type="text" class="form-control" id="codigoSucursal" value="<?= $sucursal->codigoSucursal ?>" disabled>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="sucursal">Nombre</label>
            <input type="text" class="form-control" name="sucursal" id="sucursal" value="<?= $sucursal->nombre ?>" required>
          </div>
          <div class="form-group col-md-6">
            <label for="responsable">Responsable</label>
            <input type="text" class="form-control" name="responsable" id="responsable" value="<?= $sucursal->responsable ?>">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion" value="<?= $sucursal->direccion ?>">
          </div>
          <div class="form-group col-md-4">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" value="<?= $sucursal->telefono ?>">
          </div>
          <div class="form-group col-md-4">
            <label for="celular">Celular</label>
            <input type="text" class="form-control" name="celular" id="celular" value="<?= $sucursal->celular ?>">
          </div>
        </div>

        <div class="text-right mt-4">
          <button type="submit" class="btn btn-success">
            <i class="ion-checkmark"></i> Guardar Cambios
          </button>
          <a href="<?= site_url('billing/sucursales'); ?>" class="btn btn-danger">
            Cancelar
          </a>
        </div>

      </form>
    </div>
  </div>
</div>

<?php $this->load->view("partial/footer"); ?>
