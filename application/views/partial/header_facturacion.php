<style>
.nav-facturacion {
  margin-bottom: 20px;
}
.nav-facturacion .nav-link {
  border-radius: 0px;
  margin-right: 8px;
  font-weight: 500;
  padding: 10px 20px;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
}
.nav-facturacion .nav-link i {
  margin-right: 8px;
}
.nav-facturacion .nav-link.active,
.nav-facturacion .nav-link:hover {
  background-color:rgb(93, 160, 231);
  color: #fff !important;
}
</style>

<!-- Barra de navegacion del modulo de facturacion-->

<ul class="nav nav-pills nav-facturacion">
  <li class="nav-item">
    <a class="nav-link <?php echo uri_string() == 'billing/index' ? 'active' : ''; ?>" href="<?php echo site_url('billing/index'); ?>">
      <i class="fa fa-list"></i> Facturas Emitidas
   </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo uri_string() == 'billing/facturar' ? 'active' : ''; ?>" href="<?php echo site_url('billing/facturar'); ?>">
      <i class="fa fa-file-invoice-dollar"></i> Facturar
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo uri_string() == 'billing/sincronizacion' ? 'active' : ''; ?>" href="<?php echo site_url('billing/sincronizacion'); ?>">
      <i class="fa fa-sync-alt"></i> Sincronización
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo uri_string() == 'billing/eventos' ? 'active' : ''; ?>" href="<?php echo site_url('billing/eventos'); ?>">
      <i class="fa fa-calendar-alt"></i> Eventos
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo uri_string() == 'billing/codigos' ? 'active' : ''; ?>" href="<?php echo site_url('billing/codigos'); ?>">
      <i class="fa fa-barcode"></i> Códigos
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo uri_string() == 'billing/sucursales' ? 'active' : ''; ?>" href="<?php echo site_url('billing/sucursales'); ?>">
      <i class="fa fa-store"></i> Sucursales
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo uri_string() == 'billing/configuracion' ? 'active' : ''; ?>" href="<?php echo site_url('billing/configuracion'); ?>">
      <i class="fa fa-cogs"></i> Configuración
    </a>
  </li>
</ul>

<?php if (isset($nombre_empleado)): ?>
  <div class="row bg-light py-2 border-bottom">
    <div class="col-md-4 text-left">
      <strong>Empleado:</strong> <?= htmlspecialchars($nombre_empleado); ?>
    </div>
    <div class="col-md-4 text-center">
      <strong>Sucursal:</strong> <?= htmlspecialchars($nombre_sucursal); ?>
    </div>
    <div class="col-md-4 text-right">
      <strong>Punto de Venta:</strong> <?= htmlspecialchars($nombre_punto_venta); ?> (Nro <?= htmlspecialchars($nro_punto_venta); ?>)
    </div>
  </div>
<?php endif; ?>
<br>
