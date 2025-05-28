<?php
$this->load->view("partial/header");
$this->load->view("partial/header_facturacion");
?>

<div class="container-fluid">
  <h4 class="mb-0">
    <i class="fa fa-qrcode text-primary"></i> Elaborar Factura
  </h4>
  <form id="facturacion_form" onsubmit="return false;">
    <div class="row">
      <div class="col-md-8">
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <div class="row">

              <div class="col-md-4 mb-3">
                <label for="codbar">Codigo (Barras):</label>
                <ul class="list-inline">
                  <li>
                    <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                    <input type="text" id="search" class="form-control ui-autocomplete-input" name="search" id="search" placeholder="Ingrese código del producto" autocomplete="off">
                  </li>
                  <li>
                    <button type="button" id="btn-search" class="btn btn-primary">
                      <span class="ion-ios-search-strong"></span>
                    </button>
                  </li>
                </ul>
              </div>

              <div class="col-md-4 mb-3">
                <label>Tipo Documento:</label>
                <select id="tipo_documento" class="form-control" required>
                  <option value="1">CI - CÉDULA DE IDENTIDAD</option>
                </select>
              </div>

              <div class="col-md-4 mb-3">
                <label for="codbar">NIT/CI:</label>
                <ul class="list-inline">
                  <li>
                    <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                    <input type="text" id="nit" class="form-control" value="<?= htmlspecialchars($nit) ?>" required name="search" id="search" placeholder="Introdusca nit o razon social" autocomplete="off">

                  </li>
                  <li>
                    <button type="button" id="btn-search" class="btn btn-primary">
                      <span class="ion-ios-search-strong"></span>
                    </button>
                  </li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label>Complemento:</label>
                <input type="text" id="complemento_ci" class="form-control">
              </div>
              <div class="col-md-4 mb-3">
                <label>Razón Social:</label>
                <input type="text" id="razon_social" class="form-control" value="<?= htmlspecialchars($razon_social) ?>" required>
              </div>
              <div class="col-md-4 mb-3">
                <label>Correo electrónico:</label>
                <input type="email" id="email_cliente" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="card shadow-sm mb-4">
          <div class="card-header bg-primary text-white">
            <strong><i class="fa fa-list"></i> Detalle de la Venta</strong>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-hover mb-0" id="detalle_table">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>Descuento (%)</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-header bg-light">
            <h4><strong>Facturar Venta</strong></h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Sub-Total (Bs):</label>
              <input type="text" id="subtotal" class="form-control" value="0.00" readonly>
            </div>
            <div class="form-group">
              <label>Descuento Total (Bs):</label>
              <input type="text" id="descuento_total" class="form-control" value="0.00" readonly>
            </div>
            <div class="form-group">
              <label>Total (Bs):</label>
              <input type="text" id="total" class="form-control" value="0.00" readonly>
            </div>
            <div class="form-group">
              <label>Total Base Crédito Fiscal (Bs):</label>
              <input type="text" id="base_credito" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Crédito Fiscal (Bs):</label>
              <input type="text" id="credito_fiscal" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Método de Pago:</label>
              <select id="metodo_pago" class="form-control" required>
                <option value="1">Efectivo</option>
                <option value="2">Tarjeta</option>
                <option value="3">Transferencia</option>
              </select>
            </div>
            <div class="text-right">
              <button type="button" id="btn-facturar" class="btn btn-primary">
                <i class="fa fa-file-invoice-dollar"></i> Generar Factura
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<?php $this->load->view("partial/footer"); ?>

<script>
  $(function() {
    let detalles = <?= json_encode($facturas) ?> || [];

    function renderTabla() {
      const tbody = $('#detalle_table tbody').empty();
      detalles.forEach((d, i) => {
        const linSub = d.cantidad * d.preciounitario;
        const subtotal = linSub - (linSub * d.descuento / 100);
        tbody.append(`
        <tr data-index="${i}">
          <td>${i+1}</td>
          <td>${d.codigo}</td>
          <td>${d.cantidad}</td>
          <td>${d.descripcion}</td>
          <td>${d.preciounitario.toFixed(2)}</td>
          <td>${d.descuento}</td>
          <td class="sub">${subtotal.toFixed(2)}</td>
          <td><button class="btn btn-sm btn-danger btn-remove"><i class="fa fa-trash"></i></button></td>
        </tr>
      `);
      });
    }

    function calcularTotales() {
      let sub = 0,
        desc = 0;
      detalles.forEach(d => {
        const lin = d.cantidad * d.preciounitario;
        sub += lin;
        desc += lin * d.descuento / 100;
      });
      const tot = sub - desc;
      const base = tot / 1.13;
      $('#subtotal').val(sub.toFixed(2));
      $('#descuento_total').val(desc.toFixed(2));
      $('#total').val(tot.toFixed(2));
      $('#base_credito').val(base.toFixed(2));
      $('#credito_fiscal').val((tot - base).toFixed(2));
    }

    renderTabla();
    calcularTotales();

    $('#producto_select').change(function() {
      const sel = $(this).find(':selected');
      const id = sel.val();
      if (!id) return;
      detalles.push({
        codigo: id,
        descripcion: sel.text(),
        cantidad: 1,
        preciounitario: parseFloat(sel.data('price')),
        descuento: 0
      });
      renderTabla();
      calcularTotales();
    });

    $('#detalle_table').on('input', '.qty, .disc', function() {
      const row = $(this).closest('tr');
      const i = row.data('index');
      detalles[i].cantidad = +row.find('.qty').val();
      detalles[i].descuento = +row.find('.disc').val();
      renderTabla();
      calcularTotales();
    });

    $('#detalle_table').on('click', '.btn-remove', function() {
      detalles.splice($(this).closest('tr').data('index'), 1);
      renderTabla();
      calcularTotales();
    });

    $('#btn-facturar').click(function() {
      if (!detalles.length) {
        alert('Agrega al menos un producto');
        return;
      }
      const maestro = {
        nit: $('#nit').val(),
        razon_social: $('#razon_social').val(),
        email: $('#email_cliente').val(),
        tipo_documento: $('#tipo_documento').val(),
        metodo_pago: $('#metodo_pago').val()
      };
      $.post('<?= site_url("billing/submit_factura") ?>', {
        maestro: JSON.stringify(maestro),
        detalle: JSON.stringify(detalles)
      }, function(resp) {
        if (resp.success) {
          window.location = '<?= site_url("billing/ver_pdf") ?>/' + resp.idfac;
        } else {
          alert('Error: ' + JSON.stringify(resp.error));
        }
      }, 'json').fail(() => alert('Error en petición de AJAX'));
    });
  });
</script>
