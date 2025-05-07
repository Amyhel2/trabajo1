<?php
$this->load->view("partial/header");
$this->load->view("partial/header_facturacion");
?>

<div class="container-fluid">
<form method="post" action="<?php echo site_url('billing/guardarConfiguracion'); ?>">
  <div class="row mt-3">
    <div class="col-md-8">
      <h4 class="mb-0">
        <i class="fa fa-qrcode text-primary"></i> Editar Configuracion
      </h4>
    </div>

    <div class="col-md-4" style="text-align: right;">
    <button type="submit" class="btn btn-success btn-lg hidden-sm hidden-xs" title="Guardar">
  <span class="ion-checkmark"></span> Guardar
</button>

    </div>
  </div>

  <div class="card shadow-sm">

    <div class="card-body">
      

        <div class="row">
          <div class="col-md-4">
            <label>Nombre Sistema:</label>
            <input type="text" class="form-control" name="nombre_sistema" value="<?php echo $config['cuis'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Código Sistema:</label>
            <input type="text" class="form-control" name="codigo_sistema" value="<?php echo $config['cufd'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>NIT:</label>
            <input type="text" class="form-control" name="nit" value="<?php echo $config['nit'] ?? ''; ?>">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Razón Social:</label>
            <input type="text" class="form-control" name="razon_social" value="<?php echo $config['codigoPuntoVenta'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Modalidad:</label>
            <input type="text" class="form-control" name="modalidad" value="<?php echo $config['codigoSucursal'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Ambiente:</label>
            <input type="text" class="form-control" name="ambiente" value="<?php echo $config['nit_emisor'] ?? ''; ?>">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Tipo Factura:</label>
            <input type="text" class="form-control" name="tipo_factura" value="<?php echo $config['cuis'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Tipo Documento Sector:</label>
            <input type="text" class="form-control" name="documento_sector" value="<?php echo $config['cufd'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Tipo Moneda:</label>
            <input type="text" class="form-control" name="tipo_moneda" value="<?php echo $config['token'] ?? ''; ?>">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12">
            <label>Token:</label>
            <input type="text" class="form-control" name="token" value="<?php echo $config['token'] ?? ''; ?>">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Ciudad:</label>
            <input type="text" class="form-control" name="ciudad" value="<?php echo $config['cuis'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Teléfono:</label>
            <input type="text" class="form-control" name="telefono" value="<?php echo $config['cufd'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Tipo Impresión:</label>
            <input type="text" class="form-control" name="tipo_impresion" value="<?php echo $config['token'] ?? ''; ?>">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>CAFC:</label>
            <input type="text" class="form-control" name="cafc" value="<?php echo $config['cuis'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Inicio CAFC:</label>
            <input type="text" class="form-control" name="inicio_cafc" value="<?php echo $config['inicio_cafc'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Fin CAFC:</label>
            <input type="text" class="form-control" name="fin_cafc" value="<?php echo $config['fin_cafc'] ?? ''; ?>">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Email Envío:</label>
            <input type="text" class="form-control" name="email_envio" value="<?php echo $config['email_envio'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Contraseña Email:</label>
            <input type="text" class="form-control" name="pass_email" value="<?php echo $config['cufd'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>SMTP Email:</label>
            <input type="text" class="form-control" name="smtp_email" value="<?php echo $config['token'] ?? ''; ?>">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Llave Pública:</label>
            <input type="text" class="form-control" name="llave_publica" value="<?php echo $config['cuis'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Llave Privada:</label>
            <input type="text" class="form-control" name="llave_privada" value="<?php echo $config['cufd'] ?? ''; ?>">
          </div>
          <div class="col-md-4">
            <label>Método de Pago:</label>
            <select class="form-control" name="metodo_pago">
              <option value="1">Efectivo</option>
              <option value="2">Tarjeta</option>
              <option value="3">Transferencia</option>
            </select>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<?php $this->load->view("partial/footer"); ?>