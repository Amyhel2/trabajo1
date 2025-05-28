<?php
$this->load->view("partial/header");
$this->load->view("partial/header_facturacion");
?>

<div class="container-fluid">
  <form method="post" action="<?php echo site_url('billing/editarConfiguracion'); ?>">
    <div class="row mt-3">
      <div class="col-md-8">
        <h4 class="mb-0">
          <i class="fa fa-qrcode text-primary"></i> Dosificacion
        </h4>
      </div>

      <div class="col-md-4" style="text-align: right;">

        <button type="submit" class="btn btn-success btn-lg hidden-sm hidden-xs" title="Editar">
          <span class="ion-edit"></span> Editar
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
            <input type="text" class="form-control" name="razon_social" value="<?php echo $company_name ?? ''; ?>">
          </div>

          <div class="col-md-4">
            <label>Modalidad:</label>
            <select class="form-control" name="modalidad" id="">
              <option value="1">Electronica en linea</option>
              <option value="2">Computarizada en linea</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Ambiente:</label>
            <select class="form-control" name="ambiente">
              <option value="1">Producción</option>
              <option value="2">Pruebas y piloto</option>
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Tipo Factura:</label>

            <select class="form-control" name="tipo_factura" id="">
              <option value="1">Factura con derecho a credito fiscal</option>
              <option value="2">Factura sin derecho a credito fiscal</option>
              <option value="3">Documento de ajuste</option>
              <option value="4">Documento equivalente</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Tipo Documento Sector:</label>
            <select class="form-control" name="tipo_documento_sector" id="">
              <option value="1">Factura Compra-Venta</option>
              <option value="2">Factura de alquiler de bienes inmuebles</option>
              <option value="3">Factura de hospitales/clínicas </option>
              <option value="4">Servicios básicos</option>
              <option value="5">Sector educativo</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Tipo Moneda:</label>
            <select class="form-control" name="tipo_moneda">
              <option value="1">Boliviano (Bs)</option>
              <option value="2">Dolar ($)</option>
            </select>
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
            <select class="form-control" name="tipo_impresion">
              <option value="1">Media Página</option>
              <option value="2">Ticket/Rollo</option>
            </select>
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

          <div class="col-md-4 mb-3">
            <label for="codbar">Llave Pública:</label>
            <ul class="list-inline">
              <li>
                <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                <input type="text" class="form-control ui-autocomplete-input" name="search" id="search" value="" placeholder="" autocomplete="off">
              </li>

              <li>
                <button type="submit" class="btn btn cobn btn-primary btn-lg"><span class="ion-ios-search-strong"></span><span class="hidden-xs hidden-sm"></span></button>
              </li>

            </ul>
          </div>

          <div class="col-md-4 mb-3">
            <label for="codbar">Llave Privada:</label>
            <ul class="list-inline">
              <li>
                <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                <input type="text" class="form-control ui-autocomplete-input" name="search" id="search" value="" placeholder="" autocomplete="off">
              </li>

              <li>
                <button type="submit" class="btn btn-primary btn-lg"><span class="ion-ios-search-strong"></span><span class="hidden-xs hidden-sm"></span></button>
              </li>
            </ul>
          </div>

          <div class="col-md-4">
            <label>Método de Pago:</label>
            <select class="form-control" name="metodo_pago">
              <option value="1">Efectivo</option>
              <option value="2">Tarjeta</option>
              <option value="3">Cheque</option>
              <option value="3">Vales</option>
              <option value="3">Otros</option>
            </select>
          </div>
        </div>
  </form>
</div>
</div>
</div>

<?php $this->load->view("partial/footer"); ?>