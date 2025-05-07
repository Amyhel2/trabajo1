<?php $this->load->view("partial/header"); ?>
<?php $this->load->view("partial/header_facturacion"); ?>

<div class="container-fluid mt-4">
  <!-- Título principal -->
  <div class="row mb-3">
    <div class="col-md-8">
      <h4>
        <i class="fa fa-file-invoice text-primary"></i> Editar Sucursal
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
        <div class="row">
          

          <div class="col-md-6 mb-3">
            <label for="numero_sucursal">Número de Sucursal:</label>
            <input type="text" id="numero_sucursal" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label for="codigo_sucursal">Codigo Sucursal:</label>
            <input type="text" id="codigo_sucursal" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="sucursal">Sucursal:</label>
            <input type="text" id="sucursal" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label for="responsable">Responsable:</label>
            <input type="text" id="responsable" class="form-control">
          </div>
          </div>

          <div class="row">
          <div class="col-md-4 mb-3">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" class="form-control">
          </div>
          <div class="col-md-4 mb-3">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" class="form-control">
          </div>
          <div class="col-md-4 mb-3">
            <label for="celular">Celular:</label>
            <input type="text" id="celular" class="form-control">  
          </div>
          </div>
        <br>
        <div class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-success">
              <i class="ion-ios-save"></i> Guardar
            </button>
          </div>
          
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view("partial/footer"); ?>