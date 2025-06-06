<?php
$this->load->view('partial/header');
         $this->load->view('partial/header_facturacion');
?>
 
<div class="container-fluid">
  <form method="post" action="<?= site_url('billing/guardarConfiguracion') ?>">
    <div class="row mt-3">
      <div class="col-md-8">
        <h4 class="mb-0">
          <i class="fa fa-cogs text-primary"></i> Editar Configuración SIAT
        </h4>
      </div>
      <div class="col-md-4 text-end text-right">
        <button type="submit" class="btn btn-success btn-lg">
          <i class="fa fa-save"></i><span class="ion-checkmark"> </span> Guardar
        </button>
      </div>
      
    </div>

    <div class="card shadow-sm mt-3">
      <div class="card-body">

        
        <div class="row">
          <div class="col-md-4">
            <label>Nombre Sistema:</label>
            <input
              type="text"
              class="form-control"
              name="nomsistema"
              value="<?= $config['nombreSistema'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>Código Sistema:</label>
            <input
              type="text"
              class="form-control"
              name="codsistema"
              value="<?= $config['codigoSistema'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>NIT:</label>
            <input
              type="text"
              class="form-control"
              name="nitsistema"
              value="<?= $config['nitCi'] ?? '' ?>"
              
            >
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Razón Social:</label>
            <input
              type="text"
              class="form-control"
              name="rzssistema"
              value="<?= $config['razonSocial'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>Modalidad:</label>
            <select
              id="modsistema"
              name="modsistema"
              class="form-control"
              
            >
              <option
                value="1"
                <?= (isset($config['modalidad']) && $config['modalidad'] == 1) ? 'selected' : '' ?>
              >
                Electrónica en línea
              </option>
              <option
                value="2"
                <?= (isset($config['modalidad']) && $config['modalidad'] == 2) ? 'selected' : '' ?>
              >
                Computarizada en línea
              </option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Ambiente:</label>
            <select
              id="ambsistema"
              name="ambsistema"
              class="form-control"
              
            >
              <option
                value="1"
                <?= (isset($config['ambiente']) && $config['ambiente'] == 1) ? 'selected' : '' ?>
              >
                Producción
              </option>
              <option
                value="2"
                <?= (isset($config['ambiente']) && $config['ambiente'] == 2) ? 'selected' : '' ?>
              >
                Pruebas
              </option>
            </select>
          </div>
        </div>

        <!-- 3ª fila: Tipo Factura | Tipo Documento Sector | Tipo Moneda -->
        <div class="row mt-3">
          <div class="col-md-4">
            <label>Tipo Factura:</label>
            <select
              id="facsistema"
              name="facsistema"
              class="form-control"
              
            >
              <option
                value="1"
                <?= (isset($config['tipoFactura']) && $config['tipoFactura'] == 1) ? 'selected' : '' ?>
              >
                Factura con Derecho a Crédito Fiscal
              </option>
              <option
                value="2"
                <?= (isset($config['tipoFactura']) && $config['tipoFactura'] == 2) ? 'selected' : '' ?>
              >
                Factura sin Derecho a Crédito Fiscal
              </option>
              <option
                value="3"
                <?= (isset($config['tipoFactura']) && $config['tipoFactura'] == 3) ? 'selected' : '' ?>
              >
                Documento de ajuste
              </option>
              <option
                value="4"
                <?= (isset($config['tipoFactura']) && $config['tipoFactura'] == 4) ? 'selected' : '' ?>
              >
                Documento equivalente
              </option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Tipo Documento Sector:</label>
            <select
              id="docsectorsistema"
              name="docsectorsistema"
              class="form-control"
              
            >
              <option
                value="1"
                <?= (isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 1) ? 'selected' : '' ?>
              >
                Factura Compra-Venta
              </option>
              <option
                value="2"
                <?= (isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 2) ? 'selected' : '' ?>
              >
                Factura de Alquiler bienes inmuebles
              </option>
              <option
                value="3"
                <?= (isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 3) ? 'selected' : '' ?>
              >
                Factura de Hospitales/Clínicas
              </option>
              <option
                value="4"
                <?= (isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 4) ? 'selected' : '' ?>
              >
                Servicios básicos
              </option>
              <option
                value="5"
                <?= (isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 5) ? 'selected' : '' ?>
              >
                Sector educativo
              </option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Tipo Moneda:</label>
            <select
              id="monsistema"
              name="monsistema"
              class="form-control"
              
            >
              <option
                value="1"
                <?= (isset($config['tipoMoneda']) && $config['tipoMoneda'] == 1) ? 'selected' : '' ?>
              >
                Boliviano (Bs)
              </option>
              <option
                value="2"
                <?= (isset($config['tipoMoneda']) && $config['tipoMoneda'] == 2) ? 'selected' : '' ?>
              >
                Dólar ($)
              </option>
            </select>
          </div>
        </div>

        <!-- 4ª fila: Token -->
        <div class="row mt-3">
          <div class="col-md-12">
            <label>Token:</label>
            <input
              type="text"
              class="form-control"
              name="toksistema"
              value="<?= $config['token'] ?? '' ?>"
              
            >
          </div>
        </div>

        <!-- 5ª fila: Ciudad | Teléfono | Tipo Impresión -->
        <div class="row mt-3">
          <div class="col-md-4">
            <label>Ciudad:</label>
            <input
              type="text"
              class="form-control"
              name="ciusistema"
              value="<?= $config['ciudad'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>Teléfono:</label>
            <input
              type="text"
              class="form-control"
              name="telsistema"
              value="<?= $config['telefono'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>Tipo Impresión:</label>
            <select
              id="impsistema"
              name="impsistema"
              class="form-control"
              
            >
              <option
                value="1"
                <?= (isset($config['tipoImpresion']) && $config['tipoImpresion'] == 1) ? 'selected' : '' ?>
              >
                Media Página
              </option>
              <option
                value="2"
                <?= (isset($config['tipoImpresion']) && $config['tipoImpresion'] == 2) ? 'selected' : '' ?>
              >
                Ticket/Rollo
              </option>
            </select>
          </div>
        </div>

        <!-- 6ª fila: CAFC | Inicio CAFC | Fin CAFC -->
        <div class="row mt-3">
          <div class="col-md-4">
            <label>CAFC:</label>
            <input
              type="text"
              class="form-control"
              name="cafcsistema"
              value="<?= $config['cafc'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>Inicio CAFC:</label>
            <input
              type="text"
              class="form-control"
              name="inicafcsistema"
              value="<?= $config['inicioNroCafc'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>Fin CAFC:</label>
            <input
              type="text"
              class="form-control"
              name="fincafcsistema"
              value="<?= $config['finNroCafc'] ?? '' ?>"
              
            >
          </div>
        </div>

        <!-- 7ª fila: Email Envío | Contraseña Email | SMTP Email -->
        <div class="row mt-3">
          <div class="col-md-4">
            <label>Email Envío:</label>
            <input
              type="email"
              class="form-control"
              name="emailsistema"
              value="<?= $config['email'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>Contraseña Email:</label>
            <input
              type="password"
              class="form-control"
              name="pwdemailsistema"
              value="<?= $config['pwd_email'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>SMTP Email:</label>
            <input
              type="text"
              class="form-control"
              name="smtpemailsistema"
              value="<?= $config['smtp_email'] ?? '' ?>"
              
            >
          </div>
        </div>

        <!-- 8ª fila: Llave Pública | Llave Privada | Método de Pago -->
        <div class="row mt-3 mb-4">
          <div class="col-md-4">
            <label>Llave Pública:</label>
            <input
              type="text"
              class="form-control"
              name="pubsistema"
              value="<?= $config['pubCert'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>Llave Privada:</label>
            <input
              type="text"
              class="form-control"
              name="privsistema"
              value="<?= $config['privCert'] ?? '' ?>"
              
            >
          </div>
          <div class="col-md-4">
            <label>Método de Pago:</label>
            <select
              id="metsistema"
              name="metsistema"
              class="form-control"
              
            >
              <option
                value="1"
                <?= (isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 1) ? 'selected' : '' ?>
              >
                Efectivo
              </option>
              <option
                value="2"
                <?= (isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 2) ? 'selected' : '' ?>
              >
                Tarjeta
              </option>
              <option
                value="3"
                <?= (isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 3) ? 'selected' : '' ?>
              >
                Transferencia
              </option>
            </select>
          </div>
        </div>
        <!-- FIN del formulario -->
      </div>
    </div>
  </form>
</div>

<?php
$this->load->view('partial/footer');?>
