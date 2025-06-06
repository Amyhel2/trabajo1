<div class="container-fluid">
  <form method="post" action="<?= site_url('billing/editarConfiguracion') ?>">
    <div class="row mt-3">
      <div class="col-md-8">
        <h4 class="mb-0">
          <i class="fa fa-cogs text-primary"></i> Configuración SIAT
        </h4>
      </div>
      <div class="col-md-4 text-end text-right">
        <button type="submit" class="btn btn-success btn-lg">
          <i class="fa fa-save"></i> 
          <span class="ion-edit"> </span> Editar
        </button>
      </div>
    </div>

    <div class="card shadow-sm mt-3">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <label>Nombre Sistema:</label>
            <input type="text" class="form-control" name="nombreSistema" value="<?= $config['nombreSistema'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>Código Sistema:</label>
            <input type="text" class="form-control" name="codigoSistema" value="<?= $config['codigoSistema'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>NIT:</label>
            <input type="text" class="form-control" name="nitCi" value="<?= $config['nitCi'] ?? '' ?>" readonly>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Razón Social:</label>
            <input type="text" class="form-control" name="razonSocial" value="<?= $config['razonSocial'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>Modalidad:</label>
            <select class="form-control" name="modalidad" disabled>
              <option value="1" <?= isset($config['modalidad']) && $config['modalidad'] == 1 ? 'selected' : '' ?>>Electrónica en línea</option>
              <option value="2" <?= isset($config['modalidad']) && $config['modalidad'] == 2 ? 'selected' : '' ?>>Computarizada en línea</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Ambiente:</label>
            <select class="form-control" name="ambiente" disabled>
              <option value="1" <?= isset($config['ambiente']) && $config['ambiente'] == 1 ? 'selected' : '' ?>>Producción</option>
              <option value="2" <?= isset($config['ambiente']) && $config['ambiente'] == 2 ? 'selected' : '' ?>>Pruebas</option>
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Tipo Factura:</label>
            <select class="form-control" name="tipoFactura" disabled>
              <option value="1" <?= isset($config['tipoFactura']) && $config['tipoFactura'] == 1 ? 'selected' : '' ?>>Factura con derecho a crédito fiscal</option>
              <option value="2" <?= isset($config['tipoFactura']) && $config['tipoFactura'] == 2 ? 'selected' : '' ?>>Factura sin derecho a crédito fiscal</option>
              <option value="3" <?= isset($config['tipoFactura']) && $config['tipoFactura'] == 3 ? 'selected' : '' ?>>Documento de ajuste</option>
              <option value="4" <?= isset($config['tipoFactura']) && $config['tipoFactura'] == 4 ? 'selected' : '' ?>>Documento equivalente</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Tipo Documento Sector:</label>
            <select class="form-control" name="tipoDocumentoSector" disabled>
              <option value="1" <?= isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 1 ? 'selected' : '' ?>>Factura Compra-Venta</option>
              <option value="2" <?= isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 2 ? 'selected' : '' ?>>Factura de Alquiler de Bienes Inmuebles</option>
              <option value="3" <?= isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 3 ? 'selected' : '' ?>>Factura de Hospitales/Clínicas</option>
              <option value="4" <?= isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 4 ? 'selected' : '' ?>>Servicios básicos</option>
              <option value="5" <?= isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 5 ? 'selected' : '' ?>>Sector Educativo </option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Tipo Moneda:</label>
            <select class="form-control" name="tipoMoneda" disabled>
              <option value="1" <?= isset($config['tipoMoneda']) && $config['tipoMoneda'] == 1 ? 'selected' : '' ?>>Boliviano (Bs)</option>
              <option value="2" <?= isset($config['tipoMoneda']) && $config['tipoMoneda'] == 2 ? 'selected' : '' ?>>Dólar ($)</option>
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12">
            <label>Token:</label>
            <input type="text" class="form-control" name="token" value="<?= $config['token'] ?? '' ?>" readonly>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Ciudad:</label>
            <input type="text" class="form-control" name="ciudad" value="<?= $config['ciudad'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>Teléfono:</label>
            <input type="text" class="form-control" name="telefono" value="<?= $config['telefono'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>Tipo Impresión:</label>
            <select class="form-control" name="tipoImpresion" disabled>
              <option value="1" <?= isset($config['tipoImpresion']) && $config['tipoImpresion'] == 1 ? 'selected' : '' ?>>Media Página</option>
              <option value="2" <?= isset($config['tipoImpresion']) && $config['tipoImpresion'] == 2 ? 'selected' : '' ?>>Ticket/Rollo</option>
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>CAFC:</label>
            <input type="text" class="form-control" name="cafc" value="<?= $config['cafc'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>Inicio CAFC:</label>
            <input type="text" class="form-control" name="inicioNroCafc" value="<?= $config['inicioNroCafc'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>Fin CAFC:</label>
            <input type="text" class="form-control" name="finNroCafc" value="<?= $config['finNroCafc'] ?? '' ?>" readonly>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Email Envío:</label>
            <input type="email" class="form-control" name="email" value="<?= $config['email'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>Contraseña Email:</label>
            <input type="password" class="form-control" name="pwd_email" value="<?= $config['pwd_email'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>SMTP Email:</label>
            <input type="text" class="form-control" name="smtp_email" value="<?= $config['smtp_email'] ?? '' ?>" readonly>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>Llave Pública:</label>
            <input type="text" class="form-control" name="pubCert" value="<?= $config['pubCert'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>Llave Privada:</label>
            <input type="text" class="form-control" name="privCert" value="<?= $config['privCert'] ?? '' ?>" readonly>
          </div>
          <div class="col-md-4">
            <label>Método de Pago:</label>
            <select class="form-control" name="tipoMetodoPago" disabled>
              <option value="1" <?= isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 1 ? 'selected' : '' ?>>Efectivo</option>
              <option value="2" <?= isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 2 ? 'selected' : '' ?>>Tarjeta</option>
              <option value="3" <?= isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 3 ? 'selected' : '' ?>>Cheque</option>
              <option value="4" <?= isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 4 ? 'selected' : '' ?>>Vales</option>
              <option value="5" <?= isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 5 ? 'selected' : '' ?>>Otros</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>