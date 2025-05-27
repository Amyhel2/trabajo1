<?php
$this->load->view("partial/header");

?>
<div class="container-fluid mt-4">
  <h4 class="mb-3">
    <i class="fa fa-file-invoice text-primary"></i> Informe de ventas sin factura
  </h4>
  <br>
  <?php if ($msg = $this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $msg ?></div>
  <?php elseif ($msg = $this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $msg ?></div>
  <?php endif; ?>

  <div class="row">

    <div class="col-md-12 mb-3">
      <form method="get" class="form-inline">
        <label for="start_date" class="mr-2">Desde:</label>
        <input type="date" name="start_date" id="start_date" class="form-control mr-3"
          value="<?= substr($start_date, 0, 10) ?>" required>

        <label for="end_date" class="mr-2">Hasta:</label>
        <input type="date" name="end_date" id="end_date" class="form-control mr-3"
          value="<?= substr($end_date, 0, 10) ?>" required>

        <button type="submit" class="btn btn-primary">
          <i class="fa fa-search"></i> Filtrar
        </button>
      </form>
    </div>

    <hr>
    <hr>
    <!-- Tabla de resultados -->
    <div class="col-md-12">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <strong><i class="fa fa-list"></i> Resultados</strong>

        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Cliente</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($ventas)): ?>
                  <?php $i = 1;
                  foreach ($ventas as $v): ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td><?= $v['sale_time'] ?></td>
                      <td><?= $v['customer_id'] ?></td>
                      <td><?= to_currency($v['total']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="4" class="text-center text-muted py-3">
                      <i class="fa fa-info-circle"></i> No hay ventas sin factura en ese rango de fechas.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> <!-- col-md-12 -->
  </div> <!-- row -->
</div>

<?php $this->load->view("partial/footer"); ?>