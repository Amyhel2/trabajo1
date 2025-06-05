

<div class="container-fluid">
  <form method="post" action="<?= site_url('billing/guardarConfiguracion') ?>">
    <div class="row mt-3">
      <div class="col-md-8">
        <h4 class="mb-0">
          <i class="fa fa-cogs text-primary"></i> Editar Configuración SIAT
        </h4>
      </div>
      <div class="col-md-4 text-end">
        <button type="submit" class="btn btn-success btn-lg">
          <i class="fa fa-save"></i> Guardar
        </button>
      </div>
    </div>

    <div class="card shadow-sm mt-3">
      <div class="card-body">

        <!-- Primera fila: Nombre Sistema | Código Sistema | NIT -->
        <div class="row">
          <div class="col-md-4">
            <label>Nombre Sistema:</label>
            <input type="text" class="form-control" name="nombre_sistema"
                   value="<?= $config['nombreSistema'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>Código Sistema:</label>
            <input type="text" class="form-control" name="codigo_sistema"
                   value="<?= $config['codigoSistema'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>NIT:</label>
            <input type="text" class="form-control" name="nit"
                   value="<?= $config['nitCi'] ?? '' ?>">
          </div>
        </div>

        <!-- Segunda fila: Razón Social | Modalidad | Ambiente -->
        <div class="row mt-3">
          <div class="col-md-4">
            <label>Razón Social:</label>
            <input type="text" class="form-control" name="razon_social"
                   value="<?= $config['razonSocial'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>Modalidad:</label>
            <select class="form-control" name="modalidad">
              <option value="1" <?= (isset($config['modalidad']) && $config['modalidad'] == 1) ? 'selected' : '' ?>>
                Electrónica en línea
              </option>
              <option value="2" <?= (isset($config['modalidad']) && $config['modalidad'] == 2) ? 'selected' : '' ?>>
                Computarizada en línea
              </option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Ambiente:</label>
            <select class="form-control" name="ambiente">
              <option value="1" <?= (isset($config['ambiente']) && $config['ambiente'] == 1) ? 'selected' : '' ?>>
                Producción
              </option>
              <option value="2" <?= (isset($config['ambiente']) && $config['ambiente'] == 2) ? 'selected' : '' ?>>
                Pruebas
              </option>
            </select>
          </div>
        </div>

        <!-- Tercera fila: Tipo Factura | Tipo Documento Sector | Tipo Moneda -->
        <div class="row mt-3">
          <div class="col-md-4">
            <label>Tipo Factura:</label>
            <select class="form-control" name="tipo_factura">
              <option value="1" <?= (isset($config['tipoFactura']) && $config['tipoFactura'] == 1) ? 'selected' : '' ?>>
                Con crédito fiscal
              </option>
              <option value="2" <?= (isset($config['tipoFactura']) && $config['tipoFactura'] == 2) ? 'selected' : '' ?>>
                Sin crédito fiscal
              </option>
              <option value="3" <?= (isset($config['tipoFactura']) && $config['tipoFactura'] == 3) ? 'selected' : '' ?>>
                Documento de ajuste
              </option>
              <option value="4" <?= (isset($config['tipoFactura']) && $config['tipoFactura'] == 4) ? 'selected' : '' ?>>
                Documento equivalente
              </option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Tipo Documento Sector:</label>
            <select class="form-control" name="documento_sector">
              <option value="1" <?= (isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 1) ? 'selected' : '' ?>>
                Factura Compra-Venta
              </option>
              <option value="2" <?= (isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 2) ? 'selected' : '' ?>>
                Alquiler bienes inmuebles
              </option>
              <option value="3" <?= (isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 3) ? 'selected' : '' ?>>
                Hospitales/Clínicas
              </option>
              <option value="4" <?= (isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 4) ? 'selected' : '' ?>>
                Servicios básicos
              </option>
              <option value="5" <?= (isset($config['tipoDocumentoSector']) && $config['tipoDocumentoSector'] == 5) ? 'selected' : '' ?>>
                Sector educativo
              </option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Tipo Moneda:</label>
            <select class="form-control" name="tipo_moneda">
              <option value="1" <?= (isset($config['tipoMoneda']) && $config['tipoMoneda'] == 1) ? 'selected' : '' ?>>
                Boliviano (Bs)
              </option>
              <option value="2" <?= (isset($config['tipoMoneda']) && $config['tipoMoneda'] == 2) ? 'selected' : '' ?>>
                Dólar ($)
              </option>
            </select>
          </div>
        </div>

        <!-- Cuarta fila: Token -->
        <div class="row mt-3">
          <div class="col-md-12">
            <label>Token:</label>
            <input type="text" class="form-control" name="token"
                   value="<?= $config['token'] ?? '' ?>">
          </div>
        </div>

        <!-- Quinta fila: Ciudad | Teléfono | Tipo Impresión -->
        <div class="row mt-3">
          <div class="col-md-4">
            <label>Ciudad:</label>
            <input type="text" class="form-control" name="ciudad"
                   value="<?= $config['ciudad'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>Teléfono:</label>
            <input type="text" class="form-control" name="telefono"
                   value="<?= $config['telefono'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>Tipo Impresión:</label>
            <select class="form-control" name="tipo_impresion">
              <option value="1" <?= (isset($config['tipoImpresion']) && $config['tipoImpresion'] == 1) ? 'selected' : '' ?>>
                Media Página
              </option>
              <option value="2" <?= (isset($config['tipoImpresion']) && $config['tipoImpresion'] == 2) ? 'selected' : '' ?>>
                Ticket/Rollo
              </option>
            </select>
          </div>
        </div>

        <!-- Sexta fila: CAFC | Inicio CAFC | Fin CAFC -->
        <div class="row mt-3">
          <div class="col-md-4">
            <label>CAFC:</label>
            <input type="text" class="form-control" name="cafc"
                   value="<?= $config['cafc'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>Inicio CAFC:</label>
            <input type="text" class="form-control" name="inicio_cafc"
                   value="<?= $config['inicioNroCafc'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>Fin CAFC:</label>
            <input type="text" class="form-control" name="fin_cafc"
                   value="<?= $config['finNroCafc'] ?? '' ?>">
          </div>
        </div>

        <!-- Séptima fila: Email Envío | Contraseña Email | SMTP Email -->
        <div class="row mt-3">
          <div class="col-md-4">
            <label>Email Envío:</label>
            <input type="email" class="form-control" name="email_envio"
                   value="<?= $config['email'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>Contraseña Email:</label>
            <input type="password" class="form-control" name="pass_email"
                   value="<?= $config['pwd_email'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>SMTP Email:</label>
            <input type="text" class="form-control" name="smtp_email"
                   value="<?= $config['smtp_email'] ?? '' ?>">
          </div>
        </div>

        <!-- Octava fila: Llave Pública | Llave Privada | Método de Pago -->
        <div class="row mt-3 mb-4">
          <div class="col-md-4">
            <label>Llave Pública:</label>
            <input type="text" class="form-control" name="llave_publica"
                   value="<?= $config['pubCert'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>Llave Privada:</label>
            <input type="text" class="form-control" name="llave_privada"
                   value="<?= $config['privCert'] ?? '' ?>">
          </div>
          <div class="col-md-4">
            <label>Método de Pago:</label>
            <select class="form-control" name="metodo_pago">
              <option value="1" <?= (isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 1) ? 'selected' : '' ?>>
                Efectivo
              </option>
              <option value="2" <?= (isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 2) ? 'selected' : '' ?>>
                Tarjeta
              </option>
              <option value="3" <?= (isset($config['tipoMetodoPago']) && $config['tipoMetodoPago'] == 3) ? 'selected' : '' ?>>
                Transferencia
              </option>
            </select>
          </div>
        </div>

      </div>
    </div>
  </form>
</div>

