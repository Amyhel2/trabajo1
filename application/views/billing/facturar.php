<?php
$this->load->view("partial/header");
$this->load->view("partial/header_facturacion");
?>

<div class="container-fluid">
  <h4 class="mb-0">
    <i class="fa fa-qrcode text-primary"></i> Elaborar Factura
  </h4>
  <form id="facturacion_form">
    <div class="row">
      <!-- Detalle de Venta -->
      <div class="col-md-8">
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <div class="row">
              <!-- Agregar Producto -->
              <div class="col-md-4 mb-3">
                <label>Adicionar Item:</label>
                <select name="producto_id" id="producto_select" class="form-control">
                  <option value="">Seleccione un producto</option>
                  <?php foreach ($productos as $prod): ?>
                    <option value="<?= $prod->item_id ?>"
                            data-price="<?= $prod->unit_price ?>">
                      <?= htmlspecialchars($prod->name) ?> (<?= number_format($prod->unit_price,2) ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <!-- NIT / CI -->
              <div class="col-md-4 mb-3">
                <label>NIT/CI:</label>
                <input type="text"
                       name="nit"
                       id="nit"
                       class="form-control"
                       value="<?= htmlspecialchars($nit) ?>"
                       <?= $nit===''?'':'readonly' ?>>
              </div>
              <!-- Razón Social -->
              <div class="col-md-4 mb-3">
                <label>Razón Social:</label>
                <input type="text"
                       name="razon_social"
                       id="razon_social"
                       class="form-control"
                       value="<?= htmlspecialchars($razon_social) ?>">
              </div>
            </div>

            <div class="row">
              <!-- Correo -->
              <div class="col-md-6 mb-3">
                <label>Correo electrónico:</label>
                <input type="email"
                       name="email_cliente"
                       id="email_cliente"
                       class="form-control"
                       value="<?= htmlspecialchars($email) ?>">
              </div>
              <!-- Tipo Documento -->
              <div class="col-md-6 mb-3">
                
                <label>Tipo Documento:</label>
                <select name="tipo_documento" class="form-control">
                  <option value="1">CI - CÉDULA DE IDENTIDAD</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <br>
        <!-- Tabla Detalle Productos -->
        <div class="card shadow-sm mb-4">
          <div class="card-header bg-primary text-white">
            <strong><i class="fa fa-list"></i> Detalle de Venta</strong>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped mb-0" id="detalle_table">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Precio Unit.</th>
                    <th>Desc. (%)</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Se llenará con JS -->
                  <?php if (!empty($facturas)): ?>
                    <?php foreach ($facturas as $i => $f): ?>
                      <tr data-index="<?= $i ?>">
                        <td><?= $i+1 ?></td>
                        <td><?= htmlspecialchars($f['codigo']) ?></td>
                        <td><input type="number" class="form-control qty" value="<?= $f['cantidad'] ?>" min="1"></td>
                        <td><?= htmlspecialchars($f['descripcion']) ?></td>
                        <td><?= number_format($f['preciounitario'],2) ?></td>
                        <td><input type="number" class="form-control disc" value="<?= $f['descuento'] ?>" min="0" max="100"></td>
                        <td class="sub"><?= number_format($f['subtotal'],2) ?></td>
                        <td><button type="button" class="btn btn-sm btn-danger btn-remove"><i class="fa fa-trash"></i></button></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Totales y Facturar -->
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-header bg-light">
            <h4><strong>Facturar Venta</strong></h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Sub-Total (Bs):</label>
              <input type="text" id="subtotal" class="form-control" value="<?= number_format($subtotal,2) ?>" readonly>
            </div>
            <div class="form-group">
              <label>Descuento Total (Bs):</label>
              <input type="text" id="descuento_total" class="form-control" value="<?= number_format($descuento,2) ?>" readonly>
            </div>
            <div class="form-group">
              <label>Total (Bs):</label>
              <input type="text" id="total" class="form-control" value="<?= number_format($total,2) ?>" readonly>
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
              <select name="metodo_pago" id="metodo_pago" class="form-control">
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
$(function(){
  let detalles = [];
  // Inicializa con facturas pasadas desde PHP
  <?php if (!empty($facturas)): ?>
    detalles = <?= json_encode($facturas) ?>;
  <?php endif; ?>

  function renderTabla(){
    const \$tbody = $('#detalle_table tbody').empty();
    detalles.forEach((d,i)=>{
      const sub = (d.cantidad*d.preciounitario)*(1-d.descuento/100);
      \$tbody.append(\`
        <tr data-index="\${i}">
          <td>\${i+1}</td>
          <td>\${d.codigo}</td>
          <td><input type="number" class="form-control qty" value="\${d.cantidad}" min="1"></td>
          <td>\${d.descripcion}</td>
          <td>\${d.preciounitario.toFixed(2)}</td>
          <td><input type="number" class="form-control disc" value="\${d.descuento}" min="0" max="100"></td>
          <td class="sub">\${sub.toFixed(2)}</td>
          <td><button type="button" class="btn btn-sm btn-danger btn-remove"><i class="fa fa-trash"></i></button></td>
        </tr>\`);
    });
  }

  function calcTotales(){
    let sub=0, desc=0;
    detalles.forEach(d=>{
      sub += d.cantidad*d.preciounitario;
      desc += d.cantidad*d.preciounitario*(d.descuento/100);
    });
    const tot = sub-desc;
    const base = tot/1.13;
    const cred = tot-base;
    $('#subtotal').val(sub.toFixed(2));
    $('#descuento_total').val(desc.toFixed(2));
    $('#total').val(tot.toFixed(2));
    $('#base_credito').val(base.toFixed(2));
    $('#credito_fiscal').val(cred.toFixed(2));
  }

  // Agregar producto
  $('#producto_select').change(function(){
    const sel = $(this).find(':selected');
    const code = sel.val();
    if (!code) return;
    detalles.push({
      codigo: code,
      cantidad: 1,
      descripcion: sel.text(),
      preciounitario: parseFloat(sel.data('price')),
      descuento: 0
    });
    renderTabla(); calcTotales();
  });

  // Eventos tabla
  $('#detalle_table')
    .on('input','.qty, .disc', function(){
      const row = $(this).closest('tr'), idx = row.data('index');
      detalles[idx].cantidad = parseInt(row.find('.qty').val());
      detalles[idx].descuento = parseFloat(row.find('.disc').val());
      renderTabla(); calcTotales();
    })
    .on('click','.btn-remove', function(){
      detalles.splice($(this).closest('tr').data('index'),1);
      renderTabla(); calcTotales();
    });

  // Facturar
  $('#btn-facturar').click(function(){
    if (detalles.length===0){ alert('Agrega al menos un producto'); return; }
    const maestro = {
      nit: $('#nit').val(),
      razon_social: $('#razon_social').val(),
      email: $('#email_cliente').val(),
      tipo_documento: $('select[name="tipo_documento"]').val(),
      metodo_pago: $('#metodo_pago').val()
    };
    $.post('<?= site_url("billing/submit_factura") ?>',{
      maestro: JSON.stringify(maestro),
      detalle: JSON.stringify(detalles)
    }, resp=>{
      if (resp.success) {
        window.location.href = '<?= site_url("billing/ver_pdf") ?>/'+resp.idfac;
      } else {
        alert('Error: '+ JSON.stringify(resp.error));
      }
    },'json');
  });

  // al cargar, si había facturas iniciales, renderiza
  renderTabla(); calcTotales();
});
</script>
