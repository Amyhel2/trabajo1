<?php $this->load->view("partial/header"); ?>

<div class="container-fluid mt-4">
  <h4 class="mb-3">
    <i class="fa fa-file-invoice text-primary"></i> Informe de ventas facturadas
  </h4>

  <?php if ($msg = $this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $msg ?></div>
  <?php elseif ($msg = $this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $msg ?></div>
  <?php endif; ?>

  <div class="row mb-3">
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
<br>
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
              <th>CI/NIT</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($sales)): ?>
              <?php $i = 1; foreach ($sales as $row): ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $row['sale_time'] ?></td>
                  <td><?= htmlspecialchars($row['full_name']) ?></td>
                  <td><?= htmlspecialchars($row['account_number']) ?></td>
                  <td><?= to_currency($row['total']) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center text-muted py-3">
                  <i class="fa fa-info-circle"></i> No hay ventas facturadas en este rango de fechas.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view("partial/footer"); ?>
