 <html xmlns="https://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

 <head>
 	<?php
		include('includes/cabecera.inc');
		?>
 	<style>
 		.select2-dropdown {
 			z-index: 9001;
 		}
 	</style>
 </head>

 <body class="skin-5 pace-done mini-navbar">

 	<div id="wrapper" class="ibox-content" style="padding: 0px;">
 		<div class="sk-spinner sk-spinner-wave">
 			<div class="sk-rect1"></div>
 			<div class="sk-rect2"></div>
 			<div class="sk-rect3"></div>
 			<div class="sk-rect4"></div>
 			<div class="sk-rect5"></div>
 		</div>
 		<?php
			include('includes/menu_izq.inc');
			?>
 		<div id="page-wrapper" class="gray-bg">
 			<div class="row border-bottom">
 				<?php
					include('includes/menu_top.inc');
					?>
 			</div>
 			<div class="row wrapper border-bottom white-bg page-heading">
 				<div class="col-lg-12">
 					<br>
 					<ol class="breadcrumb">
 						<li>
 							<a href="home">Inicio</a>
 						</li>
 						<li class="active">
 							<strong> Facturar Servicio </strong>
 						</li>
 					</ol>
 				</div>
 			</div>
 			<div class="wrapper wrapper-content ">
 				<div class="row">
 					<div class="col-lg-12">
 						<div class="ibox float-e-margins">
 							<div class="ibox-title">
 								<div class="row">
 									<div class="col-sm-2">
 										<h5>Punto Venta : <b id='nomPv'></b></h5>
 									</div>
 									<div class="col-sm-2">
 										<div style="display:none;" id="mostrartienda">
 											<select class="form-control" id="selectPuntoVenta" onchange="cargarFacturas();" required></select>
 										</div>
 									</div>
 									<div class="row form-group col-sm-7">
 										<label class="col-sm-1 control-label"> Mes:</label>
 										<div class="col-sm-3">
 											<input type="text" class="form-control input-sm" id='mes' onchange="cam_inifin(this.value);" required />
 										</div>
 										<label class="col-sm-1 control-label"> F.Inicio:</label>
 										<div class="col-sm-3">
 											<input type="text" class="form-control input-sm" id='finicio' required />
 										</div>
 										<label class="col-sm-1 control-label"> F.Fin:</label>
 										<div class="col-sm-3">
 											<input type="text" class="form-control input-sm" id='ffin' required />
 										</div>
 									</div>
 									<div class="col-sm-1">
 										<button class="btn btn-primary btn-sm btn-outline" onclick="cargarFacturas()"><i class="fa fa-filter"></i> Filtrar </button>
 									</div>
 								</div>
 							</div>
 						</div>

						<!--nav de opciones-->
 						<div class="ibox float-e-margins">
 							<div class="tabs-container">
 								<ul class="nav nav-tabs">
 									<li class="active "><a id="tablis" data-toggle="tab" onclick="cargarFacturas();" href="#tab-1"><label class="text-navy"> <i class="fa fa-list-ul"></i> Listado Facturas </a></label></li>
 									<li><a id="tabfac" data-toggle="tab" href="#tab-2"><label class="text-navy"> <i class="fa fa-calculator"></i> Facturar </a></label></li>
 									<li><a id="tabsinc" data-toggle="tab" href="#tab-3" onclick="cargarSincronizacion();"><label class="text-navy"><i class="fa fa-refresh"></i> Sincronizacion </a></label></li>
 									<li><a id="tabeven" data-toggle="tab" href="#tab-4" onclick="cargarEventos();"><label class="text-navy"><i class="fa fa-check-square-o"></i> Eventos </a></label></li>
 									<li><a id="tabcod" data-toggle="tab" href="#tab-5" onclick="cargarCodigos();"><label class="text-navy"><i class="fa fa-qrcode"></i> Codigos </a></label></li>
 									<li><a id="tabsuc" data-toggle="tab" href="#tab-6" onclick="cargarSucursales();"><label class="text-navy"><i class="fa fa-th-list"></i> Sucursales </a></label></li>
 									<li><a id="tabconf" data-toggle="tab" href="#tab-7" onclick="cargarConfiguracion();"><label class="text-navy"> <i class="fa fa-cogs"></i> Configuracion </a></label></li>
 								</ul>
 								<div class="tab-content">
 									<div id="tab-1" class="tab-pane active" style="font-size:12px;">
 										<div class="ibox-content">
 											<div class="row">
 												<div class="col-md-12">
 													<div class="ibox-title">
 														<h5> Facturas Emitidas </h5>
 														<div class="ibox-tools">
 														</div>
 													</div>
 													<div class="ibox-content">
 														<div id="toogle-columns"></div>
 														<div class="ibox cont-horizontal" style="font-size:10px;">
 															<table class="table table-striped table-bordered table-hover lisfacturas" style="font-size:12px;">
 															</table>
 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 									<div id="tab-3" class="tab-pane" style="font-size:12px;">
 										<div class="ibox-content">
 											<div class="row">
 												<div class="col-md-12">
 													<div class="ibox-title">
 														<h5> Sincronizacion SIAT</h5>
 														<div class="ibox-tools">
 															<button class="btn btn-info btn-sm btn-outline" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(14);"> <i class="fa fa-refresh"></i> Sincronizacion General</button>
 														</div>
 													</div>
 													<div class="ibox-content">
 														<div class="tabs-container">
 															<div class="tabs-left">
 																<ul class="nav nav-tabs">
 																	<li><a class="nav-link active" data-toggle="tab" style="color:#1ab394" href="#tab0"> Actividades</a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab1"> Actividades Documento Sector</a></li>
 																	<li><a class="nav-link " style="color:#1ab394" data-toggle="tab" href="#tab2"> Leyendas Factura </a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab3"> Productos y Servicios </a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab4"> Eventos Significativos </a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab5"> Motivos Anulacion </a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab6"> Tipos Documento Identidad</a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab7"> Tipos Documento Sector</a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab8"> Tipos Emision</a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab9"> Tipos Metodo de Pago</a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab10"> Tipos Moneda</a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab11"> Tipos Punto Venta</a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab12"> Tipos Factura</a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#tab13"> Unidades de Medida</a></li>
 																</ul>
 																<div class="tab-content ">
 																	<div id="tab0" class="tab-pane active">
 																		<div class="panel-body">
 																			<strong> Actividades <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(0);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(0);"> <i class="fa fa-trash"></i> </button></strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis0">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab1" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Actividades Documento Sector <button class="btn btn-info btn-xs" title="Sincronizar" 
																			style="margin-left:20px;" onclick="sincronizarSiat(1);"> <i class="fa fa-refresh"></i>
																		 </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(1);"> 
																			<i class="fa fa-trash"></i> </button></strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis1">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab2" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Leyendas Factura <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(2);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(2);"> <i class="fa fa-trash"></i> </button></strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis2">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab3" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Productos y Servicios <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(3);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(3);"> <i class="fa fa-trash"></i> </button></strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis3">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab4" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Eventos Significativos <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(4);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(4);"> <i class="fa fa-trash"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis4">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab5" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Motivos Anulacion <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(5);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(5);"> <i class="fa fa-trash"></i> </button></strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis5">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab6" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Tipos Documento Identidad <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(6);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(6);"> <i class="fa fa-trash"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis6">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab7" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Tipos Documento Sector <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(7);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(7);"> <i class="fa fa-trash"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis7">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab8" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Tipos Emision <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(8);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(8);"> <i class="fa fa-trash"></i> </button></strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis8">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab9" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Tipos Metodo de Pago <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(9);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(9);"> <i class="fa fa-trash"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis9">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab10" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Tipos Moneda <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(10);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(10);"> <i class="fa fa-trash"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis10">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab11" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Tipos Punto Venta <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(11);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(11);"> <i class="fa fa-trash"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis11">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab12" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Tipos Factura <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(12);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(12);"> <i class="fa fa-trash"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis12">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="tab13" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Unidades de Medida <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarSiat(13);"> <i class="fa fa-refresh"></i> </button> <button class="btn btn-danger btn-outline btn-xs" title="Vaciar Tabla" onclick="deleteSiat(13);"> <i class="fa fa-trash"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lis13">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																</div>
 															</div>
 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 									<div id="tab-4" class="tab-pane" style="font-size:12px;">
 										<div class="ibox-content">
 											<div class="row">
 												<div class="col-md-12">
 													<div class="ibox-title">
 														<h5> Listado de Eventos </h5>
 														<div class="ibox-tools">
 															<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#newEvento" title="Nuevo Evento">
 																<i class="fa fa-plus" aria-hidden="true"></i>
 															</button>
 														</div>
 													</div>
 													<div class="ibox-content">
 														<div class="ibox cont-horizontal">
 															<table class="table table-striped table-bordered table-hover lisevento" style="font-size:12px;">
 															</table>
 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 									<div id="tab-5" class="tab-pane" style="font-size:12px;">
 										<div class="ibox-content">
 											<div class="row">
 												<div class="col-md-12">
 													<div class="ibox-title">
 														<h5> Codigos Siat</h5>
 													</div>
 													<div class="ibox-content">
 														<div class="tabs-container">
 															<div class="tabs-left">
 																<ul class="nav nav-tabs">
 																	<li><a class="nav-link active" style="color:#1ab394" data-toggle="tab" href="#ntab0"> Codigos CUFD </a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#ntab1"> Codigos CUIS </a></li>
 																</ul>
 																<div class="tab-content ">
 																	<div id="ntab0" class="tab-pane active">
 																		<div class="panel-body">
 																			<strong> Listado de Codigos CUFD <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarCufd();"> <i class="fa fa-refresh"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover liscufd">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="ntab1" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Listado de Codigos CUIS <button class="btn btn-info btn-xs" title="Sincronizar" style="margin-left:20px;" onclick="sincronizarCuis();"> <i class="fa fa-refresh"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover liscuis">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																</div>
 															</div>
 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 									<div id="tab-6" class="tab-pane" style="font-size:12px;">
 										<div class="ibox-content">
 											<div class="row">
 												<div class="col-md-12">
 													<div class="ibox-title">
 														<h5> Sucursales - Puntos de Venta</h5>
 													</div>
 													<div class="ibox-content">
 														<div class="tabs-container">
 															<div class="tabs-left">
 																<ul class="nav nav-tabs">
 																	<li><a class="nav-link active" style="color:#1ab394" data-toggle="tab" href="#mtab0"> Sucursales </a></li>
 																	<li><a class="nav-link" style="color:#1ab394" data-toggle="tab" href="#mtab1"> Puntos de Venta </a></li>
 																</ul>
 																<div class="tab-content ">
 																	<div id="mtab0" class="tab-pane active">
 																		<div class="panel-body">
 																			<strong> Listado Sucursales <button class="btn btn-primary btn-xs" title="Nueva Sucursal" style="margin-left:20px;" data-toggle="modal" data-target="#newSucursal"> <i class="fa fa-plus"></i> </button></strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lissucursal">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																	<div id="mtab1" class="tab-pane">
 																		<div class="panel-body">
 																			<strong> Listado Puntos de Venta <button class="btn btn-primary btn-xs" title="Nuevo Punto De Venta" style="margin-left:20px;" data-toggle="modal" data-target="#newPos"> <i class="fa fa-plus"></i> </button><button class="btn btn-info btn-xs" onclick="sincronizarPos();" title="Sincronizar Puntos de Venta" style="margin-left:2px;"> <i class="fa fa-refresh"></i> </button> </strong>
 																			<hr>
 																			<p>
 																			<div class="cont-horizontal" style="font-size:12px; ">
 																				<table class="table table-striped table-bordered table-hover lispuntoventa">
 																				</table>
 																			</div>
 																			</p>
 																		</div>
 																	</div>
 																</div>
 															</div>
 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 									<div id="tab-7" class="tab-pane" style="font-size:12px;">
 										<div class="ibox-content">
 											<div class="row">
 												<div class="col-md-12">
 													<div class="ibox-title">
 														<h5> Dosificacion </h5>
 														<div class="ibox-tools">
 															<button class="btn btn-info btn-xs" style="display:none" title="Guardar Datos" onclick="guardarDatos();" id="btnguardar">
 																<i class="fa fa-save" aria-hidden="true"></i>
 															</button>
 															<button class="btn btn-success btn-xs" title="Editar Datos" onclick="habilitarDatos();" id="btneditar">
 																<i class="fa fa-edit" aria-hidden="true"></i>
 															</button>
 														</div>
 													</div>
 													<div class="ibox-content">
 														<div class="row">
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Nombre Sistema</label>
 																<input type="text" disabled class="form-control edit" id="nomsistema">
 																<input type="hidden" id="idsiat">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Codigo Sistema</label>
 																<input type="text" disabled class="form-control edit" id="codsistema">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>NIT</label>
 																<input type="text" disabled class="form-control edit" id="nitsistema">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Razon Social</label>
 																<input type="text" disabled class="form-control edit" id="rzssistema">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Modalidad</label>
 																<select class="form-control edit" id="modsistema" style="width:100%" disabled>
 																	<option value="1"> Electronica en Linea </option>
 																	<option value="2"> Computarizada en Linea </option>
 																</select>
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Ambiente</label>
 																<select class="form-control edit" id="ambsistema" style="width:100%" disabled>
 																	<option value="1"> Produccion </option>
 																	<option value="2"> Pruebas y Piloto </option>
 																</select>
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Tipo Factura</label>
 																<select class="form-control edit" id="facsistema" style="width:100%" disabled>
 																	<option value="1"> FACTURA CON DERECHO A CREDITO FISCAL </option>
 																	<option value="2"> FACTURA SIN DERECHO A CREDITO FISCAL </option>
 																	<option value="3"> DOCUMENTO DE AJUSTE </option>
 																	<option value="4"> DOCUMENTO EQUIVALENTE </option>
 																</select>
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Tipo Documento Sector</label>
 																<select class="form-control edit" id="docsectorsistema" style="width:100%" disabled>
 																	<option value="1"> FACTURA COMPRA-VENTA </option>
 																	<option value="2"> FACTURA DE ALQUILER DE BIENES INMUEBLES </option>
 																	<option value="17"> FACTURA DE HOSPITALES/CLÍNICAS </option>
 																	<option value="13"> SERVICIOS BASICOS </option>
 																	<option value="11"> SECTOR EDUCATIVO </option>
 																</select>
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Tipo Moneda</label>
 																<select class="form-control edit" id="monsistema" style="width:100%" disabled>
 																	<option value="1"> BOLIVIANO </option>
 																	<option value="2"> DOLAR </option>
 																</select>
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 																<label>Token</label>
 																<textarea id="toksistema" disabled class="form-control edit"></textarea>
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Ciudad</label>
 																<input type="text" disabled class="form-control edit" id="ciusistema">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Telefono</label>
 																<input type="text" disabled class="form-control edit" id="telsistema">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Tipo Impresion</label>
 																<select class="form-control edit" id="impsistema" style="width:100%" disabled>
 																	<option value="1"> Media Pagina </option>
 																	<option value="2"> Ticket/Rollo </option>
 																</select>
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>CAFC</label>
 																<input type="text" disabled class="form-control edit" id="cafcsistema">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Inicio CAFC</label>
 																<input type="text" disabled class="form-control edit" id="inicafcsistema">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Fin CAFC</label>
 																<input type="text" disabled class="form-control edit" id="fincafcsistema">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Email Envio</label>
 																<input type="text" disabled class="form-control edit" id="emailsistema">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Contraseña Email</label>
 																<input type="text" disabled class="form-control edit" id="pwdemailsistema">
 															</div>
															 <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>SMTP Email</label>
 																<input type="text" disabled class="form-control edit" id="smtpemailsistema">
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Llave Publica</label>
 																<div class="input-group">
 																	<input type="text" id="pubsistema" class="form-control input-sm edit" disabled><span class="input-group-btn"> <button type="button" data-toggle="modal" data-target="#modalPublica" class="btn btn-info btn-sm ecit" disabled><i class="fa fa-upload"></i></button></span>
 																</div>
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Llave Privada</label>
 																<div class="input-group">
 																	<input type="text" id="privsistema" class="form-control input-sm edit" disabled><span class="input-group-btn"> <button type="button" data-toggle="modal" data-target="#modalPublica" class="btn btn-info btn-sm edit" disabled><i class="fa fa-upload"></i></button></span>
 																</div>
 															</div>
 															<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 																<label>Tipo Metodo Pago</label>
 																<select class="form-control edit" id="metsistema" style="width:100%" disabled>
 																	<option value="1"> EFECTIVO </option>
 																	<option value="2"> TARJETA </option>
 																	<option value="3"> CHEQUE </option>
 																	<option value="4"> VALES </option>
 																	<option value="5"> OTROS </option>
 																</select>
 															</div>

 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 									<div id="tab-2" class="tab-pane">
 										<div class="ibox-title">
 											<div class="row">
 												<div class="col-md-2">
 													<div class="btn-group" id="enlinea">
 														<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm btn-outline"> <i class="fa fa-spinner fa-spin"></i> En Linea <i class="fa fa-sort-desc"></i> </button>
 														<ul class="dropdown-menu">
 															<li><a class="dropdown-item" onclick="newEventoSignificativo(1)"> 1. CORTE DEL SERVICIO DE INTERNET</a></li>
 															<li><a class="dropdown-item" onclick="newEventoSignificativo(2)">2. INACCESIBILIDAD AL SERVICIO WEB DE LA ADMINISTRACIÓN TRIBUTARIA </a></li>
 															<li><a class="dropdown-item" onclick="newEventoSignificativo(3)">3. INGRESO A ZONAS SIN INTERNET POR DESPLIEGUE DE PUNTO DE VENTA EN VEHICULOS AUTOMOTORES</a></li>
 															<li><a class="dropdown-item" onclick="newEventoSignificativo(4)">4. VENTA EN LUGARES SIN INTERNET</a></li>
 														</ul>
 													</div>
 													<div class="btn-group" id="fueralinea" style="display:none;">
 														<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle btn-sm btn-outline"> <i class="fa fa-spinner fa-spin"></i> Fuera de Linea <i class="fa fa-sort-desc"></i> </button>
 														<ul class="dropdown-menu">
 															<li><a class="dropdown-item" onclick="finEventoSignificativo()"> VOLVER A EN LINEA</a></li>
 														</ul>
 													</div>
 													<div class="btn-group" id="fueralineacafc" style="display:none;">
 														<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle btn-sm btn-outline"> <i class="fa fa-spinner fa-spin"></i> Fuera de Linea CAFC <i class="fa fa-sort-desc"></i> </button>
 														<ul class="dropdown-menu">
 															<li><a class="dropdown-item" onclick="finEventoSignificativoCafc()"> VOLVER A EN LINEA</a></li>
 														</ul>
 													</div>
 												</div>
 												<div class="col-md-7">
 													<div class="alert alert-warning" id="divevento">
 														<span class="alert-link" id="tituloevento"> </span> <span id="avisoevento"> </span>.
 													</div>
 												</div>
 												<div class="col-md-3">

 												</div>
 											</div>
 										</div>
 										<div class="ibox-content" id="dfac">
 											<div class="row">
 												<div class="col-md-9">
 													<div class="ibox-content">
 														<div class="row">
 															<div class="col-md-6">
 																<label>Adicionar<small>(Item)</small> : </label>
 																<select class="form-control" id="selectProducto" onchange="agregarItemSelect(this.value)" style="width: 100%;" required></select>
 															</div>
 															<div class="col-md-3">
 																<label>Codigo<small>(Barras)</small> : </label>
 																<div class="input-group">
 																	<input type="text" id="codbar" placeholder="Ingrese codigo de Producto" onkeypress="ingresarCodigo(event)" class="form-control input-sm cmp"><span class="input-group-btn"> <button type="button" style="width:35px;" onclick="buscarCodigoBarras()" class="btn btn-info btn-sm"><i class="fa fa-search"></i></button></span>
 																</div>
 															</div>
 															<div class="col-md-3">
 																<label>Tipo Documento : </label>
 																<select class="form-control frm" id="selectTipoDoc" style="width:100%" disabled>
 																</select>
 															</div>
 														</div>
 														<div class="row">
 															<div class="col-md-3">
 																<label>NIT/CI : </label>
 																<div class="input-group">
 																	<input type="text" id="nit" class="form-control frm input-sm" disabled onkeypress="ingresarNit(event)" placeholder="Introduzca nit o razon social"><span class="input-group-btn"> <button type="button" disabled id="buscarNit" onclick="buscarNit()" class="btn btn-info btn-sm frm"><i class="fa fa-search"></i></button> </span>
 																</div>
 															</div>
 															<div class="col-md-3">
 																<label>Complemento <small>(CI)</small> : </label>
 																<input type="text" id="cmp" class="form-control frm input-sm" disabled>
 															</div>
 															<div class="col-md-3">
 																<label>Nombres <small>(Razon social)</small> : </label>
 																<input type="text" id="rzs" class="form-control frm input-sm" disabled>
 															</div>
 															<div class="col-md-3">
 																<label>Correo <small>(electronico)</small> : </label>
 																<input type="text" id="mail" class="form-control frm input-sm" disabled>
 															</div>
 														</div>
 														<div class="row" id="faccafc" style="display:none;">
 															<div class="col-md-3">
 																<label>Nro Factura <small>(cafc)</small> : </label>
 																<input type="text" id="nrofaccafc" class="form-control frm input-sm" disabled>
 															</div>
 															<div class="col-md-3">
 																<label>Fecha <small>(cafc)</small> : </label>
 																<input type="date" id="fcafc" class="form-control frm input-sm" disabled>
 															</div>
 															<div class="col-md-3">
 																<label>Hora <small>(cafc)</small> : </label>
 																<input type="time" id="hcafc" step="1" class="form-control frm input-sm" disabled>
 															</div>
 														</div>

 													</div>
 													<div class="ibox-content">
 														<div class="row">
 															<div class="col-md-12">
 																<h3 class="text-navy"> Ventas <small>(Detalle)</small> </h3>
 																<hr style="border-top: 1px solid white;">
 																<table class="table table-striped table-bordered table-hover lisDetalleFactura">
 																</table>
 															</div>

 														</div>
 													</div>
 												</div>
 												<div class="col-md-3">
 													<div class="ibox-content">
 														<div class="row">
 															<h3 class="text-navy">Facturar Venta<small>( TC : <span id="tcempresa"></span> )</small></h3>
 															<label>Sub-Total<small>(Bs)</small> : </label>
 															<input type="number" readonly id="stbs" class="form-control frm input-sm">
 															<label>Descuento <small>(Bs)</small> : </label>
 															<input type="text" id="dtbs" onchange="recalcularDescuento(this.value)" value="0" class="form-control frm input-sm" disabled>
 															<label>Total <small>(Bs)</small> : </label>
 															<input type="text" id="ttbs" class="form-control frm input-sm" disabled>
 															<div style="display:none;" id="giftcard"><label>Monto <small>(Gift Card)</small> : </label>
 																<input type="text" id="gift" value="0" class="form-control frm input-sm" onchange="recalcularGiftCard(this.value)" disabled>
 															</div>
 															<div style="display:none;" id="tarjeta"><label>Codigo <small>(Tarjeta)</small> : </label>
 																<input type="hidden" value="0" id="tarjetacred">
 																<input type="text" class="form-control frm" id="nrotarjeta" maxlength="16" placeholder="************9999" onkeydown="setTimeout('mascaraTarjeta(\'nrotarjeta\',\'tarjetacred\',false);',10)" autocomplete="off">
 															</div>
 															<label>Total Base Credito Fiscal<small>(Bs)</small> : </label>
 															<input type="number" readonly id="tbs" class="form-control frm input-sm">
 															<label>Credito Fiscal<small>(Bs)</small> : </label>
 															<input type="text" readonly id="tcf" class="form-control frm input-sm" disabled>
 															<label>Metodo Pago : </label>
 															<select class="form-control frm" id="selectMetodoPago" onchange="mostrarGiftCard()" style="width:100%" disabled>
 															</select>
 															<div id="procesarF" style="display:none; margin-top:10px;">
 																<button class="btn btn-block btn-primary btn-sm" onclick="procesarFactura()"><i class="fa fa-usd"></i> Facturar </button>
 															</div>
 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>

 			<div class="modal inmodal" id="modalAnular" tabindex="-1" role="dialog" aria-hidden="true">
 				<div class="modal-dialog">
 					<div class="modal-content animated bounceInRight">
 						<div class="modal-header">
 							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
 							<h4 class="modal-title"> <i class="fa fa-close"></i> Anular Factura </h4>
 							<small> Indique el motivo de anulacion de la factura.</small>
 						</div>
 						<div class="modal-body">
 							<div class="form-horizontal form-label-left">
 								<div class="form-group">
 									<label class="control-label col-md-4 col-sm-4 col-xs-12"> Motivo:
 									</label>
 									<div class="col-md-8 col-sm-8 col-xs-12">
 										<select class="form-control" id="selectTipoAnulacion" style="width: 100%;" required></select>
 										<input class="form-control input-sm " type="hidden" id="idanul">
 									</div>
 								</div>
 							</div>
 						</div>
 						<div class="modal-footer">
 							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 							<button onclick="anularFactura();" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Anular Factura</button>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="modal inmodal" id="newPos" tabindex="-1" role="dialog" aria-hidden="true">
 				<div class="modal-dialog">
 					<div class="modal-content animated bounceInRight">
 						<div class="modal-header">
 							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
 							<h4 class="modal-title"> <i class="fa fa-plus"></i> Nuevo Punto de Venta </h4>
 							<small> Registro de un nuevo Punto de Venta</small>
 						</div>
 						<div class="modal-body">
 							<div class="form-horizontal form-label-left">
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Sucursal :
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<select class="form-control" id="selectSucursal" style="width: 100%;" required></select>
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Tipo Punto de Venta :
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<select class="form-control" id="selectTipoPV" style="width: 100%;" required></select>
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Nombre Punto Venta:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="nompv" class="form-control col-md-7 col-xs-12 pvs">
 									</div>
 								</div>
 								<div class="modal-footer">
 									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 									<button onclick="newPos();" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Insertar Datos</button>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="modal inmodal" id="newEvento" tabindex="-1" role="dialog" aria-hidden="true">
 				<div class="modal-dialog">
 					<div class="modal-content animated bounceInRight">
 						<div class="modal-header">
 							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
 							<h4 class="modal-title"> <i class="fa fa-plus"></i> Nuevo Evento Significativo </h4>
 							<small> Registro de un nuevo evento significativo.</small>
 						</div>
 						<div class="modal-body">
 							<div class="form-horizontal form-label-left">
 								<div class="form-group">
 									<div class="col-xs-12">
 										<label class="control-label"> Punto de Venta : </label>
 										<select class="form-control" id="eveSelectPuntoVenta" onchange="eveSelectCufd(this.value)" style="width: 100%;" required></select>
 									</div>
 								</div>
 								<div class="form-group">
 									<div class="col-xs-12">
 										<label class="control-label"> Tipo Evento : </label>
 										<select class="form-control" id="eveSelectEvento" onchange="habilitarCafc(this.value)" style="width: 100%;" required></select>
 									</div>
 								</div>
 								<div id="datesevento" style="display:none;">
 									<div class="form-group">
 										<div class="col-xs-12">
 											<label class="control-label"> CUFD : </label>
 											<select class="form-control" id="eveSelectCufd" style="width: 100%;" required></select>
 										</div>
 									</div>
 									<div class="alert alert-warning">
 										<span class="alert-link"> Aviso Importante ! </span> <span> La fecha y hora seleccionada tiene que estar en el rango de la cufd Seleccionada.</span>.
 									</div>
 									<div class="form-group">
 										<div class="col-xs-6">
 											<label class="control-label"> Fecha Inicio : </label>
 											<input type="date" id="evefini" class="form-control">
 										</div>
 										<div class="col-xs-6">
 											<label class="control-label"> Hora Inicio : </label>
 											<input type="time" id="evehini" class="form-control" step="1">
 										</div>
 									</div>
 									<div class="form-group">
 										<div class="col-xs-6">
 											<label class="control-label"> Fecha Fin : </label>
 											<input type="date" id="eveffin" class="form-control">
 										</div>
 										<div class="col-xs-6">
 											<label class="control-label"> Hora Fin : </label>
 											<input type="time" id="evehfin" class="form-control" step="1">
 										</div>
 									</div>

 								</div>
 								<div class="modal-footer">
 									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 									<button onclick="newEvento();" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Insertar Datos</button>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="modal inmodal" id="updSucursal" role="dialog" aria-hidden="true">
 				<div class="modal-dialog">
 					<div class="modal-content animated bounceInRight">
 						<div class="modal-header">
 							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
 							<h4 class="modal-title"> <i class="fa fa-edit"></i> Actualizar Sucursal </h4>
 							<small> Actualizar Datos Sucursal. </small>
 						</div>
 						<div class="modal-body">
 							<div class="form-horizontal form-label-left">
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Sucursal:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="updsucsuc" class="form-control col-md-7 col-xs-12 sucs">
 										<input type="hidden" id="updidsuc">
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Responsable:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="updressuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Direccion:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="upddirsuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Telefono:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="updtelsuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Celular:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="updcelsuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 							</div>
 						</div>
 						<div class="modal-footer">
 							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 							<button onclick="updSucursal();" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i> Actualizar Datos</button>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="modal inmodal" id="newSucursal" role="dialog" aria-hidden="true">
 				<div class="modal-dialog">
 					<div class="modal-content animated bounceInRight">
 						<div class="modal-header">
 							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
 							<h4 class="modal-title"> <i class="fa fa-edit"></i> Actualizar Sucursal </h4>
 							<small> Recuerde que se tiene que habilitar la sucursal en Impuestos Nacionales. </small>
 						</div>
 						<div class="modal-body">
 							<div class="form-horizontal form-label-left">
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12">Nro Sucursal:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="number" id="nrosuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12">Codigo Sucursal:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="codsuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Sucursal:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="sucsuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Responsable:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="ressuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Direccion:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="dirsuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Telefono:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="telsuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 								<div class="form-group">
 									<label class="control-label col-md-3 col-sm-3 col-xs-12"> Celular:
 									</label>
 									<div class="col-md-9 col-sm-9 col-xs-12">
 										<input type="text" id="celsuc" class="form-control col-md-7 col-xs-12 sucs">
 									</div>
 								</div>
 							</div>
 						</div>
 						<div class="modal-footer">
 							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 							<button onclick="newSucursal();" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i> Registrar Datos</button>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="footer">
 				<?php
					include('includes/footer.inc');
					?>
 			</div>

 		</div>
 	</div>
 	<?php
		include('includes/pie.inc');
		?>
 	<script>
 		var date = new Date();
 		var mes = date.getFullYear() + "-" + Empresa.agregarCero(date.getMonth() + 1);
 		var primerDia = new Date(date.getFullYear(), date.getMonth(), 1).getDate();
 		var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
 		var fecini = mes + "-" + Empresa.agregarCero(primerDia);
 		var fecfin = mes + "-" + Empresa.agregarCero(ultimoDia);
 		var fechoy = mes + "-" + date.getDate();

 		var ids = "<?php echo $ids; ?>";
 		var usr = "<?php echo $usr; ?>";
 		var idu = "<?php echo $idu; ?>";
 		var idr = "<?php echo $idr; ?>";
 		var aps = "<?php echo $aps; ?>";
 		var nom = "<?php echo $nom; ?>";
 		var rol = "<?php echo $rol; ?>";
 		var ico = "<?php echo $ico; ?>";
 		var emp = "<?php echo $emp; ?>";
 		var foto = "<?php echo $foto; ?>";
 		var logo = "<?php echo $logo; ?>";
 		var tc = "<?php echo $tc; ?>";
 		var nomSuc = "<?php echo $suc; ?>";
 		var nomPv = "<?php echo $suc; ?>";
 		var sig = "<?php echo $sig; ?>";
 		var dir = "<?php echo $dir; ?>";
 		var telf = "<?php echo $telf; ?>";
 		var cel = "<?php echo $cel; ?>";
 		var loc = "<?php echo $loc; ?>";
 		var ciu = "<?php echo $ciu; ?>";

 		var lisDetalleFactura = [];
 		var lisNewFactura = [];
 		var tcambio = 0;

 		function initializer() {
 			cargarDatosWeb();
 			menuNotificaciones();
 			menuNotificaciones();
 			document.getElementById('nomPv').innerHTML = nomPv;
 			if (idr === '2') {
 				var y = document.getElementById('mostrartienda');
 				y.style.display = 'block';
 			}
 			document.getElementById('nomUser').innerHTML = nom + ' ' + aps;
 			document.getElementById('rolUser').innerHTML = rol;
 			document.getElementById("fotousr").src = "img/Usuario/" + foto + "";
 			document.getElementById('tcempresa').innerHTML = tc;
 			cargarFechas();
 			selectProducto();
 			selectMetodoPago();
 			selectSocio();
 			selectPuntosVenta();
 			selectTiposDoc();
 			selectActividad();
 			selectTipoAnulacion();
 			selectTipoPV();
 			selectSucursal();
 			eveSelectPuntosVenta();
 			eveSelectEvento();
 			eveSelectCufd(1);
 			headerDetalleFactura();
 			cargarFacturas();
 			verificarEvento();
 		}
 		// -------------------------- Cargar Selects ---------------------------- //
 		function selectPuntosVenta() {
 			Empresa.actualizarSelect({
 				selector: "#selectPuntoVenta",
 				sql: "Select id, nombrePuntoVenta as etiqueta FROM siat_punto_de_venta",
 				callback: function(data) {
 					$('#selectPuntoVenta').val(1);
 					$("#selectPuntoVenta").select2();
 				}
 			});
 		}

 		function eveSelectPuntosVenta() {
 			Empresa.actualizarSelect({
 				selector: "#eveSelectPuntoVenta",
 				sql: "Select id, nombrePuntoVenta as etiqueta FROM siat_punto_de_venta",
 				callback: function(data) {
 					$('#eveSelectPuntoVenta').val(1);
 					$("#eveSelectPuntoVenta").select2();
 				}
 			});
 		}

 		function eveSelectEvento() {
 			Empresa.actualizarSelect({
 				selector: "#eveSelectEvento",
 				sql: "Select codigo as id, concat(codigo,'.- ',descripcion) as etiqueta FROM siat_sinc_eventos_significativos",
 				callback: function(data) {
 					$("#eveSelectEvento").select2();
 				}
 			});
 		}

 		function eveSelectCufd(valor) {
 			Empresa.actualizarSelect({
 				selector: "#eveSelectCufd",
 				sql: "Select id, concat(fechaRegistro, '-' , fechaVigencia ) as etiqueta FROM siat_cufd where idPuntoVenta='" + valor + "'AND fechaRegistro >= DATE_SUB(NOW(),INTERVAL 72 HOUR) order by fechaRegistro desc ;",
 				callback: function(data) {
 					$("#eveSelectCufd").select2();
 				}
 			});
 		}

 		function selectTiposDoc() {
 			Empresa.actualizarSelect({
 				selector: "#selectTipoDoc",
 				sql: "select codigo as id, descripcion as etiqueta from siat_sinc_tipos_documento_identidad",
 				callback: function(data) {
 					$('#selectTipoDoc').val(1);
 					$('#selectTipoDoc').select2();
 				}
 			});
 		}

 		function selectMetodoPago() {
 			Empresa.actualizarSelect({
 				selector: "#selectMetodoPago",
 				sql: "select codigo as id, descripcion as etiqueta from siat_sinc_metodo_pago order by descripcion ",
 				callback: function(data) {
 					$('#selectMetodoPago').val(1);
 					$('#selectMetodoPago').select2();
 				}
 			});
 		}

 		function selectActividad() {
 			Empresa.actualizarSelect({
 				selector: "#actividad",
 				sql: "select codigo as id, descripcion as etiqueta from siat_sinc_actividades",
 				callback: function(data) {
 					$('#actividad').select2();
 				}
 			});
 		}

 		function selectTipoAnulacion() {
 			Empresa.actualizarSelect({
 				selector: "#selectTipoAnulacion",
 				sql: "select codigo as id, descripcion as etiqueta from siat_sinc_motivos_anulacion",
 				callback: function(data) {
 					$('#selectTipoAnulacion').select2();
 				}
 			});
 		}

 		function selectProducto() {
 			Empresa.actualizarSelect({
 				selector: "#selectProducto",
 				sql: "select id_producto as id, concat(codigo,'-',nombre) as etiqueta from producto",
 				callback: function(data) {
 					$("#selectProducto").select2({
 						placeholder: "Seleccione un producto del inventario."
 					});
 				}
 			});
 		}

 		function selectTipoPV() {
 			Empresa.actualizarSelect({
 				selector: "#selectTipoPV",
 				sql: "select codigo as id, descripcion as etiqueta from siat_sinc_tipos_punto_venta",
 				callback: function(data) {
 					$('#selectTipoPV').select2();
 				}
 			});
 		}

 		function selectSucursal() {
 			Empresa.actualizarSelect({
 				selector: "#selectSucursal",
 				sql: "select nroSucursal as id, nombreSucursal as etiqueta from siat_sucursal",
 				callback: function(data) {
 					$('#selectSucursal').val(0);
 					$('#selectSucursal').select2();
 				}
 			});
 		}

 		function selectSocio() {
 			Empresa.actualizarSelect({
 				selector: "#selectSocio",
 				sql: "select id, concat('(',id,') ', razonSocial ) as etiqueta from cliente",
 				callback: function(data) {
 					$('#selectSocio').select2();
 				}
 			});
 		}

 		function cargarFechas() {
 			$("#fec_comp").val(fechoy);
 			$("#fechoy").val(fechoy);
 			$("#mes").val(mes);
 			$("#finicio").val(fecini);
 			$("#ffin").val(fecfin);
 			var date0 = $('input[id="mes"]');
 			var date1 = $('input[id="finicio"]');
 			var date2 = $('input[id="ffin"]');
 			var date3 = $('input[id="fechoy"]');
 			date0.datepicker({
 				format: 'yyyy-mm',
 				startView: 'months',
 				minViewMode: 'months',
 				todayHighlight: true,
 				autoclose: true,
 			});
 			date1.datepicker({
 				format: 'yyyy-mm-dd',
 				todayHighlight: true,
 				autoclose: true,
 			});
 			date2.datepicker({
 				format: 'yyyy-mm-dd',
 				todayHighlight: true,
 				autoclose: true,
 			});
 			date3.datepicker({
 				format: 'yyyy-mm-dd',
 				todayHighlight: true,
 				autoclose: true,
 			});
 		}

 		function cam_inifin(dato) {
 			Empresa.cambiarFechas(dato, "#finicio", "#ffin");
 			mes = $("#mes").val();
 			fecini = $("#finicio").val();
 			fecfin = $("#ffin").val();
 		}

 		function mostrarGiftCard() {
 			var x = document.getElementById("giftcard");
 			var y = document.getElementById("tarjeta");
 			var combo = document.getElementById("selectMetodoPago");
 			var cadena = combo.options[combo.selectedIndex].text;
 			let gift = "GIFT-CARD";
 			let gift1 = "GIFT CARD";
 			let tarj = "TARJETA";
 			// para buscar la palabra hacemos
 			let posicion = cadena.indexOf(gift);
 			let posicion1 = cadena.indexOf(gift1);
 			let pos = cadena.indexOf(tarj);
 			if (posicion !== -1 || posicion1 !== -1) {
 				x.style.display = "block";
 				if (pos !== -1) {
 					y.style.display = "block";
 				} else {
 					y.style.display = "none";
 				}
 			} else {
 				x.style.display = "none";
 				if (pos !== -1) {
 					y.style.display = "block";
 				} else {
 					y.style.display = "none";
 				}
 			}
 		}

 		function modoLectura() {
 			Empresa.mostrarDiv('mdlectura');
 			Empresa.ocultarDiv('mdfactura');
 		}

 		function modoFactura() {
 			Empresa.mostrarDiv('mdfactura');
 			Empresa.ocultarDiv('mdlectura');

 		}

 		function verDeudasSocio(idcli) {
 			Empresa.mostrarDiv('mddirecto');
 			var columnsName = [{
 				title: "#"
 			}, {
 				title: "Periodo"
 			}, {
 				title: "Costo Agua"
 			}, {
 				title: "OTB"
 			}, {
 				title: "Afcoop-Fecoapac"
 			}, {
 				title: "Multa Reunion"
 			}, {
 				title: "Multa mora"
 			}, {
 				title: "Total a PAgar"
 			}, {
 				title: ""
 			}];
 			var body = {
 				funcion: "verDeudasSocio",
 				idcliente: idcli
 			};
 			var lisdeudasocio = [];
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/mantenimiento/funcionesMantenimiento.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					Empresa.hideSpinner();
 					var meses = respuesta.meses.data;
 					var sumaDeuda = 0;
 					for (var i = 0; i < meses.length; i++) {
 						var ttotal = parseFloat(meses[i].MONTO_A_PAGAR) + parseFloat(meses[i].MULTA_REUNION) + parseFloat(meses[i].OTB) + parseFloat(meses[i].MULTA) + parseFloat(meses[i].TASAS);
 						sumaDeuda += parseFloat(ttotal);
 						lisdeudasocio.push([
 							i + 1,
 							meses[i].GESTION + '-' + meses[i].PERIODO,
 							meses[i].COSTO_AGUA,
 							meses[i].OTB,
 							meses[i].TASAS,
 							meses[i].MULTA_REUNION,
 							meses[i].MULTA,
 							Empresa.financial(ttotal, 2),
 							crearButtonRellenar(meses[i].ID_LECTURA)
 						]);

 					}
 					lisdeudasocio.push(['', '', '', '', '', '', '<b>Deuda Total</b>', Empresa.financial(sumaDeuda, 2), '']);
 					Empresa.inicializarTablaPrint({
 						selector: ".lisdeudasocio",
 						data: lisdeudasocio,
 						columnas: columnsName
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lisdeudasocio",
 						data: lisdeudasocio
 					});
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			})
 		}

 		function headerDetalleFactura() {
 			var columnsName = [{
 					title: "#"
 				},
 				{
 					title: "Codigo"
 				},
 				{
 					title: "Cantidad"
 				},
 				{
 					title: "Descripcion"
 				},
 				{
 					title: "PrecioUnitario"
 				},
 				{
 					title: "Descuento"
 				},
 				{
 					title: "Subtotal"
 				},
 				{
 					title: "O"
 				}
 			];
 			Empresa.inicializarTablaPrint({
 				selector: ".lisDetalleFactura",
 				data: lisDetalleFactura,
 				columnas: columnsName
 			});
 		}

 		function cargarFacturas() {
 			Empresa.showSpinner();
 			$('#tablis').tab('show');
 			if (idr === '2') { 						 	//Aca se visualiza la identifacion de registro
 				ids = $("#selectPuntoVenta").val(); 	//IDS es el identificador del sistema
 			}
 			if (ids == null || ids == "") {
 				ids = 1;
 			}
 			lisfacturas = [];
 			var columnsName = [{
 					title: "#"
 				},
 				{
 					title: "Fecha"
 				},
 				{
 					title: "Hora"
 				},
 				{
 					title: "N° Factura"
 				},
 				{
 					title: "NIT"
 				},
 				{
 					title: "Razon Social"
 				},
 				{
 					title: "SubTotal"
 				},
 				{
 					title: "Descuento "
 				},
 				{
 					title: "Total Sujeto a Iva"
 				},
 				{
 					title: "Emision"
 				},
 				{
 					title: "Estado"
 				},
 				{
 					title: ""
 				}
 			];

 			var fecini = document.getElementById("finicio").value;
 			var fecfin = document.getElementById("ffin").value;
 			var body = {
 				funcion: "listarFacturas",
 				ids: ids,
 				fechainicio: fecini,
 				fechafin: fecfin
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					Empresa.hideSpinner();
 					var facturas = respuesta.facturas;
 					for (var i = 0; i < facturas.length; i++) {
 						if (facturas[i].tipoEmision == '1') {
 							var emision = 'EN LINEA';
 						} else {
 							var emision = 'FUERA DE LINEA'
 						}
 						lisfacturas.push([
 							"" + (i + 1),
 							facturas[i].fecha,
 							facturas[i].hora,
 							facturas[i].numeroFactura,
 							facturas[i].numeroDocumento,
 							facturas[i].nombreRazonSocial,
 							Empresa.financial(parseFloat(facturas[i].montoTotalSujetoIva) + parseFloat(facturas[i].descuentoAdicional) + parseFloat(facturas[i].montoGiftCard), 2),
 							facturas[i].descuentoAdicional,
 							facturas[i].montoTotalSujetoIva,
 							emision,
 							facturas[i].estado,
 							createButtonsFactura(facturas[i].id, facturas[i].estado, facturas[i].cuf, facturas[i].email, facturas[i].numeroDocumento, facturas[i].nombreRazonSocial, facturas[i].numeroFactura, facturas[i].nitEmisor)
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lisfacturas",
 						data: lisfacturas,
 						columnas: columnsName
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lisfacturas",
 						data: lisfacturas,
 					});
 				},
 				funcionError: function(e) {
 					Empresa.notificationError("No se cargo correctamente el Listado.");
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function modalAnularFactura(idf) {
 			$("#modalAnular").modal("show");
 			$("#idanul").val(idf);
 		}

 		function anularFactura() {
 			Empresa.showSpinner();
 			var idf = document.getElementById("idanul").value;
 			var motivo = document.getElementById("selectTipoAnulacion").value;
 			var combo = document.getElementById("selectTipoAnulacion");
			 if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			if (ids == null || ids == "") {
 				ids = 1;
 			}
 			var selected = combo.options[combo.selectedIndex].text;
 			var body = {
 				funcion: "anularFactura",
 				ids: ids,
 				idf: idf,
 				motivo: motivo
 			};
 			swal({
 					title: "Anular Factura",
 					text: "Se procedera a anular la Factura",
 					type: "error",
 					showCancelButton: true,
 					confirmButtonClass: "btn-danger",
 					confirmButtonText: "Anular",
 					cancelButtonText: "Cancelar",
 					closeOnConfirm: false,
 					closeOnCancel: false
 				},
 				function(isConfirm) {
 					if (isConfirm) {
 						swal.close();
 						Empresa.rest({
 							verbo: 'POST',
 							url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 							data: body,
 							funcionExito: function(respuesta) {
 								Empresa.hideSpinner();
 								var mail = respuesta.correo;
 								var rzs = respuesta.rzs;
 								var cuf = respuesta.cuf;
 								var nit = respuesta.nit;
 								var nro = respuesta.nro;
 								cargarFacturas();
 								if (mail != "") {
 									setTimeout(enviarMailFacturaAnulada(mail, rzs, cuf, nit, nro, motivo, selected), 1500);
 								}
 								swal({
 									title: "Exito",
 									type: "success",
 									text: "Factura Anulada Correctamente"
 								});
 								$("#modalAnular").modal("hide");
 							},
 							funcionError: function(e) {
 								Empresa.notificationError(e.mensaje);
 								Empresa.hideSpinner();
 							}
 						})
 					} else {
 						swal.close();
 					}
 				});
 		}

 		function enviarMailFacturaAnulada(mail, rzs, cuf, nit, nro, motivo, selected) {
 			var body = {
 				funcion: "enviarMailFacturaAnulada",
 				mail: mail,
 				rzs: rzs,
 				cuf: cuf,
 				nit: nit,
 				nro: nro,
 				motivo: motivo,
 				selected: selected
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					console.log('se envio correctamente el mail');
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function revertirFactura(idf) {
 			Empresa.showSpinner();
 			var body = {
 				funcion: "revertirFactura",
 				ids: ids,
 				idf: idf
 			};
 			swal({
 					title: "Revertir Factura Anulada",
 					text: "Se procedera a revertir la Factura anulada",
 					type: "error",
 					showCancelButton: true,
 					confirmButtonClass: "btn-danger",
 					confirmButtonText: "Revertir",
 					cancelButtonText: "Cancelar",
 					closeOnConfirm: false,
 					closeOnCancel: false
 				},
 				function(isConfirm) {
 					if (isConfirm) {
 						swal.close();
 						Empresa.rest({
 							verbo: 'POST',
 							url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 							data: body,
 							funcionExito: function(respuesta) {
 								Empresa.hideSpinner();
 								var mail = respuesta.correo;
 								var rzs = respuesta.rzs;
 								var cuf = respuesta.cuf;
 								var nit = respuesta.nit;
 								var nro = respuesta.nro;
 								cargarFacturas();
 								if (mail != "") {
 									setTimeout(enviarMailFacturaRevertida(mail, rzs, cuf, nit, nro), 1500);
 								}
 								swal({
 									title: "Exito",
 									type: "success",
 									text: "Factura Anulada Correctamente"
 								});
 							},
 							funcionError: function(e) {
 								Empresa.notificationError(e.mensaje);
 								Empresa.hideSpinner();
 							}
 						})
 					} else {
 						swal.close();
 					}
 				});
 		}

 		function enviarMailFacturaRevertida(mail, rzs, cuf, nit, nro) {
 			var body = {
 				funcion: "enviarMailFacturaRevertida",
 				mail: mail,
 				rzs: rzs,
 				cuf: cuf,
 				nit: nit,
 				nro: nro
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					console.log('Se envio correctamente el mail');
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function agregarItemSelect(id) {
 			Empresa.showSpinner();
 			var funcion = "editProducto";
 			var body = {
 				funcion: funcion,
 				idproducto: id
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/inventario/funcionesInventario.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var producto = respuesta.producto;
 					Empresa.hideSpinner();
 					agregarItem(producto.ID_PRODUCTO, producto.CODIGO, producto.NOMBRE, producto.PRECIO_VENTA, producto.CODIGO_SIN, producto.CODIGO_ACTIVIDAD, producto.UNIDAD_MEDIDA);
 					selectProducto();
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function buscarCodigoBarras() {
 			Empresa.showSpinner();
 			var idsucursal = document.getElementById("selectSucursal").value;
 			if (idsucursal == "") {
 				idsucursal = ids;
 			}
 			var codigob = document.getElementById("codbar").value;
 			var funcion = "buscarCodigoBarras";
 			var body = {
 				funcion: funcion,
 				codigob: codigob,
 				idsucursal: idsucursal
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/inventario/funcionesInventario.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var producto = respuesta.producto;
 					Empresa.hideSpinner();
 					agregarItem(producto.ID_PRODUCTO, producto.CODIGO, producto.NOMBRE, producto.PRECIO_VENTA, producto.CODIGO_SIN, producto.CODIGO_ACTIVIDAD, producto.UNIDAD_MEDIDA);
 					$("#codbar").val("");
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function ingresarCodigo(e) {
 			var keycode = (e.keyCode ? e.keyCode : e.which);
 			if ((keycode >= 48 && keycode <= 57) || (keycode > 64 && keycode < 91) || (keycode >= 96 && keycode <= 123) || keycode == 8 || keycode == 45) {

 			} else if (keycode == '13') {
 				e.preventDefault();
 				buscarCodigoBarras();
 			} else {
 				e.preventDefault();
 			}
 		}

 		function agregarItem(idp, codigo, producto, precio, codsin, codact, unimed) {
 			lisDetalleFactura = [];
 			var cantidad = 1;
 			var descuento = 0;
 			var precbs = Math.floor(precio * cantidad * 100) / 100;
 			var preciobs = Empresa.financial(precbs, 2);
 			var item = {
 				actividad: codact,
 				codigosin: codsin,
 				codigop: codigo,
 				producto: producto,
 				idproducto: idp,
 				preciounitario: precio,
 				cantidad: cantidad,
 				unidadmedida: unimed,
 				preciobs: preciobs,
 				descuento: descuento
 			};
 			var sumtcantidad = 0;
 			var sumtprecio = 0;
 			lisNewFactura.push(item);
 			var x = document.getElementById('procesarF');
 			x.style.display = 'block';
 			$('.frm').prop('disabled', false);
 			for (var i = 0; i < lisNewFactura.length; i++) {
 				sumtprecio = parseFloat(sumtprecio) + parseFloat(lisNewFactura[i].preciobs);
 				sumtcantidad = parseFloat(sumtcantidad) + parseFloat(lisNewFactura[i].cantidad);
 				lisDetalleFactura.push([
 					i + 1,
 					lisNewFactura[i].codigop,
 					crearInputCantidad(i, lisNewFactura[i].cantidad),
 					lisNewFactura[i].producto,
 					crearInputPrecio(i, lisNewFactura[i].preciobs) + " Bs.",
 					crearInputDescuento(i, lisNewFactura[i].descuento, lisNewFactura[i].preciobs) + " Bs.",
 					lisNewFactura[i].preciobs,
 					crearButtonQuitar(i)
 				]);
 			};
 			Empresa.refrescarTablaDeDatos({
 				selector: ".lisDetalleFactura",
 				data: lisDetalleFactura
 			});
 			$("#stbs").val(Empresa.financial(sumtprecio, 2));
 			$("#ttbs").val(Empresa.financial(sumtprecio, 2));
 			$("#tbs").val(Empresa.financial(sumtprecio, 2));
 			$("#tcf").val(Empresa.financial(sumtprecio * 0.13, 2));
 			recalcularTotales();

 		}

 		function quitarArticulo(idp) {
 			var existeItems = lisNewFactura == null ? [] : lisNewFactura;
 			lisDetalleFactura = [];
 			var sumtprecio = 0;
 			var sumtcantidad = 0;
 			var subtotal = 0;
 			for (var i = 0; i < existeItems.length; i++) {
 				var deleteprod = i;
 				if (idp == deleteprod) {
 					existeItems.splice(i, 1);
 				}
 			}
 			for (var i = 0; i < existeItems.length; i++) {
 				subtotal = Empresa.financial(parseFloat(existeItems[i].cantidad) * parseFloat(existeItems[i].preciobs), 2) - parseFloat(existeItems[i].descuento);
 				sumtprecio = parseFloat(sumtprecio) + parseFloat(subtotal);
 				sumtcantidad = parseFloat(sumtcantidad) + parseFloat(existeItems[i].cantidad);
 				lisDetalleFactura.push([
 					i + 1,
 					existeItems[i].codigop,
 					crearInputCantidad(i, existeItems[i].cantidad),
 					existeItems[i].producto,
 					crearInputPrecio(i, existeItems[i].preciobs) + " Bs.",
 					crearInputDescuento(i, existeItems[i].descuento, existeItems[i].preciobs) + " Bs.",
 					Empresa.financial(subtotal, 2),
 					crearButtonQuitar(i)
 				]);
 			};
 			Empresa.refrescarTablaDeDatos({
 				selector: ".lisDetalleFactura",
 				data: lisDetalleFactura
 			});
 			$("#stbs").val(Empresa.financial(sumtprecio, 2));
 			$("#ttbs").val(Empresa.financial(sumtprecio, 2));
 			$("#tbs").val(Empresa.financial(sumtprecio, 2));
 			$("#tcf").val(Empresa.financial(sumtprecio * 0.13, 2));
 			recalcularTotales();
 			if (existeItems.length == 0) {
 				var x = document.getElementById('procesarF');
 				x.style.display = 'none';
 			}
 		}

 		function itemsCarrito(id, valor) {
 			var existeItems = lisNewFactura == null ? [] : lisNewFactura;
 			lisDetalleFactura = [];
 			var sumtprecio = 0;
 			var sumtcantidad = 0;
 			var subtotal = 0;
 			for (var j = 0; j < existeItems.length; j++) {
 				if (j == id) {
 					existeItems[j].cantidad = valor;
 				}
 			}
 			for (var i = 0; i < existeItems.length; i++) {
 				subtotal = Empresa.financial(parseFloat(existeItems[i].cantidad) * parseFloat(existeItems[i].preciobs), 2) - parseFloat(existeItems[i].descuento);
 				sumtprecio = parseFloat(sumtprecio) + parseFloat(subtotal);
 				sumtcantidad = parseFloat(sumtcantidad) + parseFloat(existeItems[i].cantidad);

 				lisDetalleFactura.push([
 					i + 1,
 					existeItems[i].codigop,
 					crearInputCantidad(i, existeItems[i].cantidad),
 					existeItems[i].producto,
 					crearInputPrecio(i, existeItems[i].preciobs) + " Bs.",
 					crearInputDescuento(i, existeItems[i].descuento, existeItems[i].preciobs) + " Bs.",
 					Empresa.financial(subtotal, 2),
 					crearButtonQuitar(i)
 				]);
 			};
 			Empresa.refrescarTablaDeDatos({
 				selector: ".lisDetalleFactura",
 				data: lisDetalleFactura
 			});
 			$("#ttbs").val(Empresa.financial(sumtprecio, 2));
 			$("#stbs").val(Empresa.financial(sumtprecio, 2));
 			$("#tbs").val(Empresa.financial(sumtprecio, 2));
 			$("#tcf").val(Empresa.financial(sumtprecio * 0.13, 2));
 			recalcularTotales();
 		}

 		function actualizarPrecio(e, actual, id) {
 			var sumtprecio = 0;
 			var keycode = (e.keyCode ? e.keyCode : e.which);
 			var bool = e.isTrusted;
 			if (keycode >= 46 && keycode <= 57 || keycode == 8) {

 			} else if (keycode == '13' || bool == true) {
 				var existeItems = lisNewFactura == null ? [] : lisNewFactura;
 				lisDetalleFactura = [];
 				var sumtprecio = 0;
 				var sumtcantidad = 0;
 				var subtotal = 0;
 				for (var j = 0; j < existeItems.length; j++) {
 					if (j == id) {
 						existeItems[j].preciobs = actual;
 					}
 				}
 				for (var i = 0; i < existeItems.length; i++) {
 					subtotal = Empresa.financial(parseFloat(existeItems[i].cantidad) * parseFloat(existeItems[i].preciobs), 2) - parseFloat(existeItems[i].descuento);
 					sumtprecio = parseFloat(sumtprecio) + parseFloat(subtotal);
 					sumtcantidad = parseFloat(sumtcantidad) + parseFloat(existeItems[i].cantidad);

 					lisDetalleFactura.push([
 						i + 1,
 						existeItems[i].codigop,
 						crearInputCantidad(i, existeItems[i].cantidad),
 						existeItems[i].producto,
 						crearInputPrecio(i, existeItems[i].preciobs) + " Bs.",
 						crearInputDescuento(i, existeItems[i].descuento, existeItems[i].preciobs) + " Bs.",
 						Empresa.financial(subtotal, 2),
 						crearButtonQuitar(i)
 					]);
 				};
 				Empresa.refrescarTablaDeDatos({
 					selector: ".lisDetalleFactura",
 					data: lisDetalleFactura
 				});
 				$("#ttbs").val(Empresa.financial(sumtprecio, 2));
 				$("#stbs").val(Empresa.financial(sumtprecio, 2));
 				$("#tbs").val(Empresa.financial(sumtprecio, 2));
 				$("#tcf").val(Empresa.financial(sumtprecio * 0.13, 2));
 				recalcularTotales();
 			} else {
 				e.preventDefault();
 			}
 		}

 		function actualizarDescuento(e, actual, id, precioant) {
 			var sumtprecio = 0;
 			var keycode = (e.keyCode ? e.keyCode : e.which);
 			var bool = e.isTrusted;
 			if (keycode >= 46 && keycode <= 57 || keycode == 8) {

 			} else if (keycode == '13' || bool == true) {
 				var nprecio = precioant - actual;
 				if (nprecio > 0) {
 					var existeItems = lisNewFactura == null ? [] : lisNewFactura;
 					lisDetalleFactura = [];
 					var sumtprecio = 0;
 					var sumtcantidad = 0;
 					var subtotal = 0;
 					for (var j = 0; j < existeItems.length; j++) {
 						if (j == id) {
 							existeItems[j].descuento = actual;
 						}
 					}
 					for (var i = 0; i < existeItems.length; i++) {
 						subtotal = Empresa.financial(parseFloat(existeItems[i].cantidad) * parseFloat(existeItems[i].preciobs), 2) - parseFloat(existeItems[i].descuento);
 						sumtprecio = parseFloat(sumtprecio) + parseFloat(subtotal);
 						sumtcantidad = parseFloat(sumtcantidad) + parseFloat(existeItems[i].cantidad);

 						lisDetalleFactura.push([
 							i + 1,
 							existeItems[i].codigop,
 							crearInputCantidad(i, existeItems[i].cantidad),
 							existeItems[i].producto,
 							crearInputPrecio(i, existeItems[i].preciobs) + " Bs.",
 							crearInputDescuento(i, existeItems[i].descuento, existeItems[i].preciobs) + " Bs.",
 							Empresa.financial(subtotal, 2),
 							crearButtonQuitar(i)
 						]);
 					}
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lisDetalleFactura",
 						data: lisDetalleFactura
 					});
 					$("#ttbs").val(Empresa.financial(sumtprecio, 2));
 					$("#stbs").val(Empresa.financial(sumtprecio, 2));
 					$("#tbs").val(Empresa.financial(sumtprecio, 2));
 					$("#tcf").val(Empresa.financial(sumtprecio * 0.13, 2));
 					recalcularTotales();
 				} else {
 					Empresa.notificationError("No puede haber una rebaja mayor o igual al precio de venta");
 					$('#desc' + id).val("0");
 					$('#desc' + id).focus();
 				}
 			} else {
 				e.preventDefault();
 			}

 		}

 		function buscarNit() {
 			var nit = document.getElementById("nit").value;
 			if (nit === "") {
 				$('#nit').val('').focus();
 				Empresa.notificationError("No ingreso ningun nit es obligatorio el campo.");
 				Empresa.hideSpinner();
 				return;
 			}
 			var body = {
 				funcion: "buscarNit",
 				cinit: nit
 			};
 			Empresa.showSpinner();
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var cliente = respuesta.cliente;
 					Empresa.hideSpinner();
 					if (cliente == null) {
 						toastr.warning('no se encontro ningun nombre relacionado al nit.', '¡Ingrese un nombre por favor!');
 					} else {
 						document.getElementById('rzs').value = cliente.razonSocial;
 						document.getElementById('mail').value = cliente.email;
 						document.getElementById('cmp').value = cliente.complemento;
 					}

 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			})

 		}

 		function ingresarNit(e) {
 			var keycode = (e.keyCode ? e.keyCode : e.which);
 			if (keycode >= 48 && keycode <= 57 || keycode == 8) {

 			} else if (keycode == '13') {
 				e.preventDefault();
 				buscarNit();
 			} else {
 				e.preventDefault();
 			}
 		}

 		function buscarNro() {
 			var nro = document.getElementById("nromed").value;
 			if (nro === "") {
 				$('#nromed').val('').focus();
 				Empresa.notificationError("No ingreso ningun numero de medidor es obligatorio el campo.");
 				Empresa.hideSpinner();
 				return;
 			}
 			var body = {
 				funcion: "buscarNro",
 				nromed: nro
 			};
 			Empresa.showSpinner();
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var cliente = respuesta.cliente;
 					Empresa.hideSpinner();
 					if (cliente == null) {
 						toastr.warning('no se encontro ningun nombre relacionado al nit.', '¡Ingrese un nombre por favor!');
 					} else {
 						document.getElementById('rzs').value = cliente.razonSocial;
 						document.getElementById('mail').value = cliente.email;
 						document.getElementById('ciben').value = cliente.nitCi;
 						document.getElementById('cmp').value = cliente.complemento;
 						document.getElementById('nit').value = cliente.nitCi;
 						document.getElementById('dom').value = cliente.domicilioCliente;
 						document.getElementById('zna').value = cliente.zona;
 						document.getElementById('ciu').value = cliente.ciudad;
 					}

 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			})

 		}

 		function ingresarNro(e) {
 			var keycode = (e.keyCode ? e.keyCode : e.which);
 			if (keycode >= 48 && keycode <= 57 || keycode == 8) {

 			} else if (keycode == '13') {
 				e.preventDefault();
 				buscarNro();
 			} else {
 				e.preventDefault();
 			}
 		}

 		function recalcularGiftCard(valor) {
 			var stbs = document.getElementById("stbs").value;
 			var dtbs = document.getElementById("dtbs").value;
 			var tbs = document.getElementById("tbs").value;
 			var stot = Empresa.financial(stbs - valor - dtbs, 2);
 			document.getElementById('tbs').value = stot;
 			//recalcularTotales();

 		}

 		function recalcularDescuento(valor) {
 			var stbs = document.getElementById("stbs").value;
 			var gift = document.getElementById("gift").value;
 			var tbs = document.getElementById("tbs").value;
 			var stot = Empresa.financial(stbs - valor - gift, 2);
 			var stot1 = Empresa.financial(stbs - valor, 2);
 			if (stot > 0) {
 				document.getElementById('tbs').value = stot;
 				document.getElementById('ttbs').value = stot;
 			} else {
 				$('#tbs').val(Empresa.financial(stbs - 0 - gift, 2));
 				Empresa.notificationError("No puede haber un descuento mayor al precio total de la venta.");
 				$('#dtbs').val("0");
 				$('#dtbs').focus();
 			}
 			recalcularTotales();
 		}

 		function recalcularTotales() {
 			var stbs = document.getElementById("stbs").value;
 			var dtbs = document.getElementById("dtbs").value;

 			var ntotal = parseFloat(stbs) - parseFloat(dtbs);
 			var ctotal = parseFloat(stbs) - parseFloat(dtbs);

 			document.getElementById('tbs').value = ctotal;
 			document.getElementById('ttbs').value = ntotal;
 			document.getElementById('tcf').value = Empresa.financial(ctotal * 0.13, 2);

 		}

 		function procesarFactura() {
 			Empresa.showSpinner();
 			var rzs = document.getElementById("rzs").value;
 			var nit = document.getElementById("nit").value;
 			var cmp = document.getElementById("cmp").value;
 			var mail = document.getElementById("mail").value;
 			var tipodoc = document.getElementById("selectTipoDoc").value

 			if (rzs === "") {
 				$('#rzs').focus();
 				Empresa.notificationError("El campo Razon Social es necesario.");
 				Empresa.hideSpinner();
 				return;
 			}
 			if (nit === "") {
 				$('#nit').focus();
 				Empresa.notificationError("El campo NIT es necesario.");
 				Empresa.hideSpinner();
 				return;
 			}
 			if (mail === "") {
 				mail = "smgfacturacioncomp@gmail.com";
 			}
 			var x = document.getElementById('procesarF');
 			x.style.display = 'none';
 			var ttbs = document.getElementById("ttbs").value;
 			var tbs = document.getElementById("tbs").value;
 			var stbs = document.getElementById("stbs").value;
 			var dtbs = document.getElementById("dtbs").value;
 			var gift = document.getElementById("gift").value;
 			var tarjeta = document.getElementById("tarjetacred").value;
 			var metodopago = document.getElementById("selectMetodoPago").value;
 			var nrocafc = document.getElementById("nrofaccafc").value;
 			var fcafc = document.getElementById("fcafc").value;
 			var hcafc = document.getElementById("hcafc").value;
 			ids = document.getElementById("selectPuntoVenta").value;
 			if (ids == null || ids == "") {
 				ids = 1;
 			}
 			var maestro = {
 				ids: ids,
 				iduser: idu,
 				usr: usr,
 				tbs: tbs,
 				ttbs: ttbs,
 				stbs: stbs,
 				dtbs: dtbs,
 				gift: gift,
 				tarjeta: tarjeta,
 				metodopago: metodopago,
 				rzs: rzs,
 				nit: nit,
 				cmp: cmp,
 				tipodoc: tipodoc,
 				mail: mail,
 				nrocafc: nrocafc,
 				fcafc: fcafc,
 				hcafc: hcafc
 			};
 			var body = {
 				funcion: "procesarFactura",
 				maestro: maestro,
 				detalle: lisNewFactura,
 				idven: 0
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					Empresa.hideSpinner();
 					var idfac = respuesta.idfac;
 					var idcmp = respuesta.idcmp;
 					var cuf = respuesta.cuf;
 					var tipoEmision = respuesta.tipoEmision;
 					var idcli = respuesta.idcli;
 					var cdevento = respuesta.cdevento;

 					generarFacturaPdf(idfac);
 					if (tipoEmision == '1') {
 						enviarMailFactura(mail, rzs, nit, cuf);
 					} else {
 						if (cdevento == '2' || cdevento == '5' || cdevento == '6' || cdevento == '7') {
 							enviarMailFactura(mail, rzs, nit, cuf);
 						}
 					}
 					imprimirFacturaTicket(idfac);
 					resetFactura();
 				},
 				funcionError: function(e) {
 					Empresa.hideSpinner();
 					Empresa.notificationError(e.mensaje);
 					x.style.display = 'block';
 				}
 			});
 		}

 		function generarFacturaPdf(idfac) {
 			var body = {
 				funcion: "generarFacturaPdf",
 				idfac: idfac
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var nrofac = respuesta.nrofac;
 					Empresa.notificationSuccess('Exito Se genero correctamente el pdf de la factura nro: ' + nrofac);
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function enviarMailFactura(mail, rzs, nit, cuf) {
 			var body = {
 				funcion: "enviarMailFactura",
 				mail: mail,
 				rzs: rzs,
 				nit: nit,
 				cuf: cuf
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					Empresa.notificationSuccess('Se envio correctamente los datos de la factura al correo: ' + mail + ' del cliente: ' + rzs);
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function reEnviarMailFactura(mail, rzs, nit, cuf) {
 			swal({
 					title: "Reenviar Factura",
 					text: "Desea reenviar correo de esta factura.",
 					type: "warning",
 					showCancelButton: true,
 					confirmButtonClass: "btn-warning",
 					confirmButtonText: "Enviar",
 					cancelButtonText: "Cancelar",
 					closeOnConfirm: false,
 					closeOnCancel: false
 				},
 				function(isConfirm) {
 					if (isConfirm) {
 						swal.close();
 						enviarMailFactura(mail, rzs, nit, cuf);
 					} else {
 						swal.close();
 					}
 				});
 		}

 		function cargarSincronizacion() {
 			Empresa.showSpinner();
 			var lis0 = [];
 			var lis1 = [];
 			var lis2 = [];
 			var lis3 = [];
 			var lis4 = [];
 			var lis5 = [];
 			var lis6 = [];
 			var lis7 = [];
 			var lis8 = [];
 			var lis9 = [];
 			var lis10 = [];
 			var lis11 = [];
 			var lis12 = [];
 			var lis13 = [];
 			var columnsName1 = [{
 				title: "#"
 			}, {
 				title: "Codigo"
 			}, {
 				title: "Descripcion"
 			}, {
 				title: "Tipo"
 			}, {
 				title: "Fecha"
 			}];
 			var columnsName2 = [{
 				title: "#"
 			}, {
 				title: "Codigo Actividad"
 			}, {
 				title: "Cod. Doc. Sector"
 			}, {
 				title: "Tipo. Doc. Sector"
 			}, {
 				title: "Fecha"
 			}];
 			var columnsName3 = [{
 				title: "#"
 			}, {
 				title: "Codigo Actividad"
 			}, {
 				title: "Codigo Producto"
 			}, {
 				title: "Descripcion"
 			}, {
 				title: "Fecha"
 			}];
 			var columnsName4 = [{
 				title: "#"
 			}, {
 				title: "Codigo"
 			}, {
 				title: "Descripcion"
 			}, {
 				title: "Fecha"
 			}];
 			var body = {
 				funcion: "listarSincronizacion"
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					Empresa.hideSpinner();
 					var datos0 = respuesta.datos0.data;
 					var datos1 = respuesta.datos1.data;
 					var datos2 = respuesta.datos2.data;
 					var datos3 = respuesta.datos3.data;
 					var datos4 = respuesta.datos4.data;
 					var datos5 = respuesta.datos5.data;
 					var datos6 = respuesta.datos6.data;
 					var datos7 = respuesta.datos7.data;
 					var datos8 = respuesta.datos8.data;
 					var datos9 = respuesta.datos9.data;
 					var datos10 = respuesta.datos10.data;
 					var datos11 = respuesta.datos11.data;
 					var datos12 = respuesta.datos12.data;
 					var datos13 = respuesta.datos13.data;
 					for (var i = 0; i < datos0.length; i++) {
 						lis0.push([
 							"" + (i + 1),
 							datos0[i].codigo,
 							datos0[i].descripcion,
 							datos0[i].tipo,
 							datos0[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis0",
 						data: lis0,
 						columnas: columnsName1
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis0",
 						data: lis0,
 					});
 					for (var i = 0; i < datos1.length; i++) {
 						lis1.push([
 							"" + (i + 1),
 							datos1[i].codigoActividad,
 							datos1[i].codDocSector,
 							datos1[i].tipoDocSector,
 							datos1[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis1",
 						data: lis1,
 						columnas: columnsName2
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis1",
 						data: lis1,
 					});
 					for (var i = 0; i < datos2.length; i++) {
 						lis2.push([
 							"" + (i + 1),
 							datos2[i].codigoActividad,
 							datos2[i].descripcion,
 							datos2[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis2",
 						data: lis2,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis2",
 						data: lis2,
 					});
 					for (var i = 0; i < datos3.length; i++) {
 						lis3.push([
 							"" + (i + 1),
 							datos3[i].codigoActividad,
 							datos3[i].codigoProducto,
 							datos3[i].descripcion,
 							datos3[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis3",
 						data: lis3,
 						columnas: columnsName3
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis3",
 						data: lis3,
 					});
 					for (var i = 0; i < datos4.length; i++) {
 						lis4.push([
 							"" + (i + 1),
 							datos4[i].codigo,
 							datos4[i].descripcion,
 							datos4[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis4",
 						data: lis4,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis4",
 						data: lis4,
 					});
 					for (var i = 0; i < datos5.length; i++) {
 						lis5.push([
 							"" + (i + 1),
 							datos5[i].codigo,
 							datos5[i].descripcion,
 							datos5[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis5",
 						data: lis5,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis5",
 						data: lis5,
 					});
 					for (var i = 0; i < datos6.length; i++) {
 						lis6.push([
 							"" + (i + 1),
 							datos6[i].codigo,
 							datos6[i].descripcion,
 							datos6[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis6",
 						data: lis6,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis6",
 						data: lis6,
 					});
 					for (var i = 0; i < datos7.length; i++) {
 						lis7.push([
 							"" + (i + 1),
 							datos7[i].codigo,
 							datos7[i].descripcion,
 							datos7[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis7",
 						data: lis7,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis7",
 						data: lis7,
 					});
 					for (var i = 0; i < datos8.length; i++) {
 						lis8.push([
 							"" + (i + 1),
 							datos8[i].codigo,
 							datos8[i].descripcion,
 							datos8[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis8",
 						data: lis8,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis8",
 						data: lis8,
 					});
 					for (var i = 0; i < datos9.length; i++) {
 						lis9.push([
 							"" + (i + 1),
 							datos9[i].codigo,
 							datos9[i].descripcion,
 							datos9[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis9",
 						data: lis9,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis9",
 						data: lis9,
 					});
 					for (var i = 0; i < datos10.length; i++) {
 						lis10.push([
 							"" + (i + 1),
 							datos10[i].codigo,
 							datos10[i].descripcion,
 							datos10[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis10",
 						data: lis10,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis10",
 						data: lis10,
 					});
 					for (var i = 0; i < datos11.length; i++) {
 						lis11.push([
 							"" + (i + 1),
 							datos11[i].codigo,
 							datos11[i].descripcion,
 							datos11[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis11",
 						data: lis11,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis11",
 						data: lis11,
 					});
 					for (var i = 0; i < datos12.length; i++) {
 						lis12.push([
 							"" + (i + 1),
 							datos12[i].codigo,
 							datos12[i].descripcion,
 							datos12[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis12",
 						data: lis12,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis12",
 						data: lis12,
 					});
 					for (var i = 0; i < datos13.length; i++) {
 						lis13.push([
 							"" + (i + 1),
 							datos13[i].codigo,
 							datos13[i].descripcion,
 							datos13[i].fecha
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lis13",
 						data: lis13,
 						columnas: columnsName4
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lis13",
 						data: lis13,
 					});
 				},
 				funcionError: function(e) {
 					Empresa.notificationError("No se cargo correctamente el Listado.");
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function sincronizarSiat(valor) {
 			if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			var valor = valor;
 			var body = {
 				funcion: "sincronizarSiat",
 				valor: valor,
 				ids: ids
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					Empresa.notificationSuccess('Exito Se Sincronizo Correctamente los catalogos');
 					cargarSincronizacion();
 					$('#tab' + valor).tab('show');
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function verificarEvento() {
 			if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			if (ids == null) {
 				ids = 1;
 			}
 			var body = {
 				funcion: "verificarEvento",
 				ids: 1
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var evento = respuesta.evento;
 					var nomevento = respuesta.nomevento;
 					if (evento == '0') {
 						$('#fueralinea').hide();
 						$('#fueralineacafc').hide();
 						$('#divevento').hide();
 						$('#faccafc').hide();
 						$('#enlinea').show();
 					} else {
 						$('#enlinea').hide();
 						if (evento.codigoEvento == '1' || evento.codigoEvento == '2' || evento.codigoEvento == '3' || evento.codigoEvento == '4') {
 							$('#fueralineacafc').hide();
 							$('#faccafc').hide();
 							$('#fueralinea').show();
 							$('#divevento').show();
 							document.getElementById('tituloevento').innerHTML = " Evento : " + nomevento.descripcion + " | ";
 							document.getElementById('avisoevento').innerHTML = " Inicio : " + evento.fechaInicioEvento + " el evento finalizara cuando cambie de estado en linea.";
 						}
 						if (evento.codigoEvento == '5' || evento.codigoEvento == '6' || evento.codigoEvento == '7') {
 							$('#fueralineacafc').show();
 							$('#faccafc').show();
 							$('#fueralinea').hide();
 							$('#divevento').show();
 							document.getElementById('tituloevento').innerHTML = " Evento : " + nomevento.descripcion + " | ";
 							document.getElementById('avisoevento').innerHTML = " Inicio : " + evento.fechaInicioEvento + " Fin: " + evento.fechaFinEvento + " solo puede ingresar facturas en ese lapso de tiempo.";

 						}
 					}
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e);
 					Empresa.hideSpinner();
 				}
 			})

 		}

 		function deleteSiat(valor) {
 			if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			var valor = valor;
 			var body = {
 				funcion: "deleteSiat",
 				valor: valor,
 				ids: ids
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					Empresa.notificationSuccess('Exito Se Sincronizo Correctamente');
 					cargarSincronizacion();
 					$('#tab' + valor).tab('show');
 				},
 				funcionError: function(e) {
 					Empresa.notificationError("No se elimino correctamente los items.");
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function cargarCodigos() {
 			Empresa.showSpinner();
 			if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			var liscufd = [];
 			var liscuis = [];
 			var columnsName1 = [{
 				title: "#"
 			}, {
 				title: "Fecha Registro"
 			}, {
 				title: "Fecha Vigencia"
 			}, {
 				title: "Sucursal"
 			}, {
 				title: "Punto de Venta"
 			}, {
 				title: "Codigo CUIS"
 			}, {
 				title: "Estado"
 			}];
 			var columnsName2 = [{
 				title: "#"
 			}, {
 				title: "Fecha Registro"
 			}, {
 				title: "Fecha Vigencia"
 			}, {
 				title: "Sucursal"
 			}, {
 				title: "Punto de Venta"
 			}, {
 				title: "Codigo CUFD"
 			}, {
 				title: "Codigo Control"
 			}, {
 				title: "Estado"
 			}];
 			var body = {
 				funcion: "listarCodigos",
 				ids: ids
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var cuiss = respuesta.cuiss.data;
 					var cufds = respuesta.cufds.data;
 					Empresa.hideSpinner();
 					for (var i = 0; i < cuiss.length; i++) {
 						liscuis.push([
 							"" + (i + 1),
 							cuiss[i].fechaRegistro,
 							cuiss[i].fechaVigencia,
 							cuiss[i].nroSucursal,
 							cuiss[i].nroPuntoVenta,
 							cuiss[i].codigoCuis,
 							cuiss[i].estado
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".liscuis",
 						data: liscuis,
 						columnas: columnsName1
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".liscuis",
 						data: liscuis,
 					});
 					for (var i = 0; i < cufds.length; i++) {
 						liscufd.push([
 							"" + (i + 1),
 							cufds[i].fechaRegistro,
 							cufds[i].fechaVigencia,
 							cufds[i].nroSucursal,
 							cufds[i].nroPuntoVenta,
 							cufds[i].codigoCufd,
 							cufds[i].codigoControl,
 							cufds[i].estado
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".liscufd",
 						data: liscufd,
 						columnas: columnsName2
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".liscufd",
 						data: liscufd,
 					});

 				},
 				funcionError: function(e) {
 					Empresa.notificationError("No se cargo correctamente el Listado.");
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function cargarEventos() {
 			Empresa.showSpinner();
 			if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			var lisevento = [];
 			var columnsName = [{
 				title: "#"
 			}, {
 				title: "Fecha/Hora Inicio"
 			}, {
 				title: "Fecha/Hora Fin"
 			}, {
 				title: "Descripcion"
 			}, {
 				title: "Sucursal"
 			}, {
 				title: "Punto de Venta"
 			}, {
 				title: "Codigo Recepcion"
 			}];
 			var body = {
 				funcion: "listarEventos",
 				ids: ids
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var eventos = respuesta.eventos.data;
 					Empresa.hideSpinner();
 					for (var i = 0; i < eventos.length; i++) {
 						lisevento.push([
 							"" + (i + 1),
 							eventos[i].fechaInicioEvento,
 							eventos[i].fechaFinEvento,
 							eventos[i].descripcion,
 							eventos[i].nroSucursal,
 							eventos[i].nroPuntoVenta,
 							eventos[i].codigoRecepcion
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lisevento",
 						data: lisevento,
 						columnas: columnsName
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lisevento",
 						data: lisevento
 					});

 				},
 				funcionError: function(e) {
 					Empresa.notificationError("No se cargo correctamente el Listado.");
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function cargarSucursales() {
 			var lissucursal = [];
 			Empresa.showSpinner();
 			var columnsName = [{
 				title: "#"
 			}, {
 				title: "Sucursal"
 			}, {
 				title: "Responsable"
 			}, {
 				title: "Telefono"
 			}, {
 				title: "Celular"
 			}, {
 				title: "Direccion"
 			}, {
 				title: ""
 			}];
 			var body = {
 				funcion: "listarSucursales"
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var sucursales = respuesta.sucursales.data;
 					Empresa.hideSpinner();
 					for (var i = 0; i < sucursales.length; i++) {
 						lissucursal.push([
 							"" + (i + 1),
 							sucursales[i].nombreSucursal,
 							sucursales[i].responsableSucursal,
 							sucursales[i].telefonoSucursal,
 							sucursales[i].celularSucursal,
 							sucursales[i].direccionSucursal,
 							Empresa.createButtonsEdit(sucursales[i].id, "Sucursal")
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lissucursal",
 						data: lissucursal,
 						columnas: columnsName
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lissucursal",
 						data: lissucursal
 					});

 				},
 				funcionError: function(e) {
 					Empresa.notificationError("No se cargo correctamente el Listado.");
 					Empresa.hideSpinner();
 				}
 			});
 			cargarPuntosVenta();
 		}

 		function newSucursal() {
 			Empresa.showSpinner();
 			var codsucursal = document.getElementById("codsuc").value;
 			var nrosucursal = document.getElementById("nrosuc").value;
 			var sucursal = document.getElementById("sucsuc").value;
 			var responsable = document.getElementById("ressuc").value;
 			var direccion = document.getElementById("dirsuc").value;
 			var telefono = document.getElementById("telsuc").value;
 			var celular = document.getElementById("celsuc").value;
 			var funcion = "newSucursal";
 			var body = {
 				funcion: funcion,
 				nrosucursal: nrosucursal,
 				codsucursal: codsucursal,
 				sucursal: sucursal,
 				direccion: direccion,
 				responsable: responsable,
 				telefono: telefono,
 				celular: celular
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					$("#newSucursal").modal("hide");
 					$('.sucs').val('');
 					cargarSucursales();
 					Empresa.hideSpinner();
 					Empresa.notificationSuccess("Se Ingreso correctamente el registro.");
 				},
 				funcionError: function(e) {
 					Empresa.hideSpinner();
 					Empresa.notificationError("No se ingreso el nuevo registro intente de nuevo por favor");
 				}
 			});
 		}

 		function modalEditSucursal(id) {
 			Empresa.showSpinner();
 			var funcion = "editSucursal";
 			var body = {
 				funcion: funcion,
 				idsucursal: id
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var sucursal = respuesta.sucursal;
 					Empresa.hideSpinner();
 					$("#updSucursal").modal("show");
 					$("#updidsuc").val(sucursal.id);
 					$("#updsucsuc").val(sucursal.nombreSucursal);
 					$("#updressuc").val(sucursal.responsableSucursal);
 					$("#upddirsuc").val(sucursal.direccionSucursal);
 					$("#updtelsuc").val(sucursal.telefonoSucursal);
 					$("#updcelsuc").val(sucursal.celularSucursal);
 				},
 				funcionError: function(e) {
 					Empresa.notificationError("No se cargo correctamente los datos.");
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function updSucursal() {
 			Empresa.showSpinner();
 			var idsucursal = document.getElementById("updidsuc").value;
 			var sucursal = document.getElementById("updsucsuc").value;
 			var responsable = document.getElementById("updressuc").value;
 			var direccion = document.getElementById("upddirsuc").value;
 			var telefono = document.getElementById("updtelsuc").value;
 			var celular = document.getElementById("updcelsuc").value;
 			var funcion = "updSucursal";
 			var body = {
 				funcion: funcion,
 				idsucursal: idsucursal,
 				sucursal: sucursal,
 				direccion: direccion,
 				responsable: responsable,
 				telefono: telefono,
 				celular: celular
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					$("#updSucursal").modal("hide");
 					$('.sucs').val('');
 					cargarSucursales();
 					Empresa.hideSpinner();
 					Empresa.notificationSuccess("Se actualizo correctamente el registro.");
 				},
 				funcionError: function(e) {
 					Empresa.hideSpinner();
 					Empresa.notificationError("No se actualizo correctamente los Datos");
 				}
 			});
 		}

 		function cargarPuntosVenta() {
 			var lispuntoventa = [];
 			var columnsName = [{
 				title: "#"
 			}, {
 				title: "Nro Sucursal"
 			}, {
 				title: "Nro Punto Venta"
 			}, {
 				title: "Nombre PV"
 			}, {
 				title: "Tipo PV"
 			}, {
 				title: "Emision"
 			}];
 			var body = {
 				funcion: "listarPos"
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var pos = respuesta.pos.data;

 					for (var i = 0; i < pos.length; i++) {
 						lispuntoventa.push([
 							"" + (i + 1),
 							pos[i].nroSucursal,
 							pos[i].nroPuntoVenta,
 							pos[i].nombrePuntoVenta,
 							pos[i].tipoPuntoVenta,
 							pos[i].tipoEmision
 						]);
 					}
 					Empresa.inicializarTablaDeDatos({
 						selector: ".lispuntoventa",
 						data: lispuntoventa,
 						columnas: columnsName
 					});
 					Empresa.refrescarTablaDeDatos({
 						selector: ".lispuntoventa",
 						data: lispuntoventa
 					});

 				},
 				funcionError: function(e) {
 					Empresa.notificationError("No se cargo correctamente el Listado.");
 				}
 			});
 		}

 		function newPos() {
 			Empresa.showSpinner();
 			var sucursal = document.getElementById("selectSucursal").value;
 			var tipopv = document.getElementById("selectTipoPV").value;
 			var nombrepv = document.getElementById("nompv").value;
 			var funcion = "newPos";
 			var body = {
 				funcion: funcion,
 				sucursal: sucursal,
 				tipopv: tipopv,
 				nombrepv: nombrepv
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					$("#newPos").modal("hide");
 					$('.pvs').val('');
 					cargarPuntosVenta();
 					selectSucursal();
 					selectTipoPV();
 					Empresa.hideSpinner();
 					Empresa.notificationSuccess("Se ingreso correctamente el registro.");
 				},
 				funcionError: function(e) {
 					Empresa.hideSpinner();
 					Empresa.notificationError("No se ingreso el nuevo registro intente de nuevo por favor");
 				}
 			});
 		}

 		function sincronizarPos() {
 			var nroSucursal = 0;
 			var body = {
 				funcion: "sincronizarPos",
 				nroSucursal: nroSucursal
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var res = respuesta.res;
 					$('#mtab1').tab('show');
 					cargarPuntosVenta();
 					Empresa.notificationSuccess("Se sincronizo correctamente los puntos de venta.");
 				},
 				funcionError: function(e) {
 					Empresa.notificationError("No se cargo correctamente el listado");
 				}
 			});
 		}

 		function cargarConfiguracion() {
 			var body = {
 				funcion: "configuracionSiat"
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					$('#tab-7').tab('show');
 					var configuracion = respuesta.configuracion;
 					$("#ambsistema").val(configuracion.ambiente);
 					$("#nomsistema").val(configuracion.nombreSistema);
 					$("#codsistema").val(configuracion.codigoSistema);
 					$("#rzssistema").val(configuracion.razonSocial);
 					$("#nitsistema").val(configuracion.nitCi);
 					$("#modsistema").val(configuracion.modalidad);
 					$("#cafcsistema").val(configuracion.cafc);
 					$("#monsistema").val(configuracion.tipoMoneda);
 					$("#docsectorsistema").val(configuracion.tipoDocumentoSector);
 					$("#facsistema").val(configuracion.tipoFactura);
 					$("#metsistema").val(configuracion.tipoMetodoPago);
 					$("#toksistema").val(configuracion.token);
 					$("#ciusistema").val(configuracion.ciudad);
 					$("#telsistema").val(configuracion.telefono);
 					$("#impsistema").val(configuracion.tipoImpresion);
 					$("#emailsistema").val(configuracion.email);
 					$("#pwdemailsistema").val(configuracion.pwd_email);
					$("#smtpemailsistema").val(configuracion.smtp_email);
 					$("#inicafcsistema").val(configuracion.inicioNroCafc);
 					$("#fincafcsistema").val(configuracion.finNroCafc);
 					$("#pubsistema").val(configuracion.pubCert);
 					$("#privsistema").val(configuracion.privCert);
 				}
 			});
 		}

 		function habilitarDatos() {
 			$('#btneditar').hide();
 			$('#btnguardar').show();
 			Empresa.habilitarCampos("edit");
 		}

 		function guardarDatos() {
 			Empresa.showSpinner();
 			$('#btnguardar').hide();
 			$('#btneditar').show();
 			var nomsistema = document.getElementById("nomsistema").value;
 			var metsistema = document.getElementById("metsistema").value;
 			var codsistema = document.getElementById("codsistema").value;
 			var rzssistema = document.getElementById("rzssistema").value;
 			var nitsistema = document.getElementById("nitsistema").value;
 			var modsistema = document.getElementById("modsistema").value;
 			var ambsistema = document.getElementById("ambsistema").value;
 			var cafcsistema = document.getElementById("cafcsistema").value;
 			var monsistema = document.getElementById("monsistema").value;
 			var docsectorsistema = document.getElementById("docsectorsistema").value;
 			var facsistema = document.getElementById("facsistema").value;
 			var toksistema = document.getElementById("toksistema").value;
 			var ciusistema = document.getElementById("ciusistema").value;
 			var telsistema = document.getElementById("telsistema").value;
 			var impsistema = document.getElementById("impsistema").value;
 			var emailsistema = document.getElementById("emailsistema").value;
 			var pwdemailsistema = document.getElementById("pwdemailsistema").value;
			 var smtpemailsistema = document.getElementById("smtpemailsistema").value;
 			var inicafcsistema = document.getElementById("inicafcsistema").value;
 			var fincafcsistema = document.getElementById("fincafcsistema").value;
 			var pubsistema = document.getElementById("pubsistema").value;
 			var privsistema = document.getElementById("privsistema").value;
 			var funcion = "updConfiguracion";
 			var body = {
 				funcion: funcion,
 				nomsistema: nomsistema,
 				codsistema: codsistema,
 				rzssistema: rzssistema,
 				nitsistema: nitsistema,
 				modsistema: modsistema,
 				cafcsistema: cafcsistema,
 				monsistema: monsistema,
 				docsectorsistema: docsectorsistema,
 				facsistema: facsistema,
 				toksistema: toksistema,
 				metsistema: metsistema,
 				ciusistema: ciusistema,
 				telsistema: telsistema,
 				impsistema: impsistema,
 				ambsistema: ambsistema,
 				inicafcsistema: inicafcsistema,
 				fincafcsistema: fincafcsistema,
 				pubsistema: pubsistema,
 				privsistema: privsistema,
 				emailsistema: emailsistema,
				pwdemailsistema: pwdemailsistema,
 				smtpemailsistema: smtpemailsistema
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					cargarConfiguracion();
 					Empresa.deshabilitarCampos("edit");
 					Empresa.hideSpinner();
 					Empresa.notificationSuccess("Se Actualizo correctamente el registro.");
 				},
 				funcionError: function(e) {
 					Empresa.hideSpinner();
 					Empresa.notificationError("No se actualizo el registro intente de nuevo por favor");
 				}
 			});
 		}

 		function sincronizarCuis() {
 			if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			var body = {
 				funcion: "sincronizarCuis",
 				ids: ids
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					cargarCodigos();
 					var msj = respuesta.msj;
 					Empresa.notificationInfo(msj);
 					$('#ntab1').tab('show');

 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function sincronizarCufd() {
 			if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			var body = {
 				funcion: "sincronizarCufd",
 				ids: ids
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					cargarCodigos();
 					var msj = respuesta.msj;
 					Empresa.notificationInfo(msj);
 					$('#ntab0').tab('show');
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function habilitarCafc(valor) {
 			if (valor > 4) {
 				$('#datesevento').show();
 			} else {
 				$('#datesevento').hide();
 			}

 		}

 		function newEvento() {
 			var pv = $("#eveSelectPuntoVenta").val();
 			var evento = $("#eveSelectEvento").val();
 			if (evento > 4) {
 				var idcufd = $("#eveSelectCufd").val();
 				var fini = $("#evefini").val() + ' ' + $("#evehini").val();
 				var ffin = $("#eveffin").val() + ' ' + $("#evehfin").val();
 				var body = {
 					funcion: "newEventoSignificativoCafc",
 					ids: pv,
 					evento: evento,
 					idcufd: idcufd,
 					fini: fini,
 					ffin: ffin
 				};
 			} else {
 				var body = {
 					funcion: "newEventoSignificativo",
 					ids: pv,
 					evento: evento
 				};
 			}

 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					cargarEventos();
 					$("#newEvento").modal("hide");
 					var msj = respuesta.msj;
 					Empresa.notificationInfo(msj);
 					eveSelectEvento();
 					verificarEvento();
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function newEventoSignificativo(evento) {
 			var evento = evento;
 			if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			var body = {
 				funcion: "newEventoSignificativo",
 				ids: ids,
 				evento: evento
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					cargarEventos();
 					var msj = respuesta.msj;
 					Empresa.notificationInfo(msj);
 					verificarEvento();
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function finEventoSignificativo() {
 			Empresa.showSpinner();
 			if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			var body = {
 				funcion: "finEventoSignificativo",
 				ids: ids
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					var msj = respuesta.msj;
 					var datos = respuesta.datos;
 					var codevento = respuesta.codevento;
 					Empresa.notificationInfo(msj);
 					verificarEvento();
 					if (codevento != '2') {
 						for (var i = 0; i < datos.length; i++) {
 							enviarMailFactura(datos[i].email, datos[i].cliente, datos[i].nit, datos[i].cuf);
 						}
 					}
 					Empresa.hideSpinner();
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function finEventoSignificativoCafc() {
 			Empresa.showSpinner();
 			if (idr === '2') {
 				ids = $("#selectPuntoVenta").val();
 			}
 			var body = {
 				funcion: "finEventoSignificativoCafc",
 				ids: ids
 			};
 			Empresa.rest({
 				verbo: 'POST',
 				url: Empresa.armarUrl("/api/factura/funcionesFactura.php"),
 				data: body,
 				funcionExito: function(respuesta) {
 					Empresa.hideSpinner();
 					var msj = respuesta.msj;
 					var datos = respuesta.datos;
 					Empresa.notificationInfo(msj);
 					verificarEvento();
 				},
 				funcionError: function(e) {
 					Empresa.notificationError(e.mensaje);
 					Empresa.hideSpinner();
 				}
 			});
 		}

 		function resetFactura() {
 			lisDetalleFactura = [];
 			lisNewFactura = [];
 			$('.frm').val('0');
 			$('.frm').prop('disabled', true);
 			var x = document.getElementById('tarjeta');
 			x.style.display = "none";
 			var y = document.getElementById('giftcard');
 			y.style.display = "none";
 			selectTiposDoc();
 			selectMetodoPago();
 			selectProducto();
 			Empresa.refrescarTablaDeDatos({
 				selector: ".lisDetalleFactura",
 				data: lisDetalleFactura
 			});
 		}
 		// ---------------- Botones  ------------- //
 		function crearInputCantidad(id, cantidad) {
 			return "<input class='form-control'  style='width: 80px;' id='num" + id + "' onchange='itemsCarrito(\"" + id + "\",this.value)' type=''  step='1' min='1' value='" + cantidad + "' >";
 		}

 		function crearInputPrecio(i, precio) {
 			return "<input class='form-control' id='prec" + i + "' size='6' type='text' value='" + precio + "'  onfocusout='actualizarPrecio(event,this.value,\"" + i + "\")'>";;
 		}

 		function crearInputDescuento(i, descuento, precio) {
 			return "<input class='form-control' id='desc" + i + "' size='6' type='text' value='" + descuento + "'  onfocusout='actualizarDescuento(event,this.value,\"" + i + "\",\"" + precio + "\")'>";;
 		}

 		function crearButtonQuitar(id) {
 			return "<button class='btn btn-danger btn-xs btn-outline' style='font-size:8px' title='Quitar Articulo' onclick='quitarArticulo(\"" + id + "\")'><i class='fa fa-trash'></i></button>";
 		}

 		function crearButtonRellenar(id) {
 			return "<button class='btn btn-info btn-xs btn-outline' style='font-size:8px' title='Cargar Factura' onclick='rellenarFactura(\"" + id + "\")'><i class='fa fa-check'></i></button>";
 		}

 		function createButtonsFactura(idf, estado, cuf, email, nit, rzs, nro, nt) {
            var btns = "";
            var baseUrl = window.location.origin; // Obtiene la URL base (por ejemplo, http://localhost/minimarket)
            
            if (estado == "ANULADO") {
                btns = "<a class='btn btn-default btn-xs' title='Ver Factura en Impuestos' style='font-size:8px' target='_blank' href='https://pilotosiat.impuestos.gob.bo/consulta/QR?nit=" + nt + "&cuf=" + cuf + "&numero=" + nro + "&t=1' ><i class='fa fa-external-link'></i> </a><button class='btn btn-danger btn-xs' style='font-size:8px' title='Anular Factura-Venta' onclick='revertirFactura(\"" + idf + "\")'><i class='fa fa-refresh'></i></button>";
            }
            if (estado == "VALIDO") {
                btns = "<a class='btn btn-info btn-xs' title='Ver Factura en Impuestos' style='font-size:8px' target='_blank' href='https://pilotosiat.impuestos.gob.bo/consulta/QR?nit=" + nt + "&cuf=" + cuf + "&numero=" + nro + "&t=1' ><i class='fa fa-external-link'></i> </a> <button class='btn btn-default btn-xs' style='font-size:8px' title='Imprimir Rollo/Ticket' onclick='imprimirFacturaTicket(\"" + idf + "\")'><i class='fa fa-print'></i> </button> <button class='btn btn-info btn-outline btn-xs' style='font-size:8px' title='Imprimir Media Pagina' onclick='imprimirFacturaPagina(\"" + idf + "\")'><i class='fa fa-print'></i></button> <a href='" + baseUrl + "/api/Siat/temp/factura-" + cuf + ".xml' title='Ver XML' class='btn btn-success btn-outline btn-xs' target='_blank' style='font-size:8px'> <i class='fa fa-file-excel-o'></i> </a> <button class='btn btn-warning btn-outline btn-xs' style='font-size:8px' title='Enviar Email' onclick='reEnviarMailFactura(\"" + email + "\",\"" + rzs + "\",\"" + nit + "\",\"" + cuf + "\")'><i class='fa fa-send'></i> </button> <button class='btn btn-danger btn-outline btn-xs' style='font-size:8px' title='Anular Factura-Venta' onclick='modalAnularFactura(\"" + idf + "\")'><i class='fa fa-close'></i></button>";
            }
            if (estado == "REVERTIDO") {
                btns = "<a class='btn btn-info btn-xs' title='Ver Factura en Impuestos' style='font-size:8px' target='_blank' href='https://pilotosiat.impuestos.gob.bo/consulta/QR?nit=" + nt + "&cuf=" + cuf + "&numero=" + nro + "&t=1' ><i class='fa fa-external-link'></i> </a> <button class='btn btn-default btn-xs' style='font-size:8px' title='Imprimir Rollo/Ticket' onclick='imprimirFacturaTicket(\"" + idf + "\")'><i class='fa fa-print'></i> </button> <button class='btn btn-info btn-outline btn-xs' style='font-size:8px' title='Imprimir Media Pagina' onclick='imprimirFacturaPagina(\"" + idf + "\")'><i class='fa fa-print'></i></button> <a href='" + baseUrl + "/api/Siat/temp/factura-" + cuf + ".xml' title='Ver XML' class='btn btn-success btn-outline btn-xs' target='_blank' style='font-size:8px'> <i class='fa fa-file-excel-o'></i> </a>";
            }
            return btns;
        }


 		function imprimirFacturaTicket(idf) {
 			Empresa.PopupCenter('imprimirticket.php?idf=' + idf + '', 'IMPRIMIR FACTURA', 400, 700);
 		}

 		function imprimirFacturaPagina(idf) {
 			Empresa.PopupCenter('imprimirpagina.php?idf=' + idf + '', 'IMPRIMIR FACTURA', 900, 800);
 		}
 		this.initializer();

 		$(document).ready(function() {
 			$('#nrotarjeta').keydown(function(event) {
 				var validarNumer = /^([0-9*]{16,16})*$/;
 				if (!$('#tarjetacred').val().match(validarNumer)) {
 					this.value = (this.value + '').replace(/[^0-9*]/g, '');
 				}
 			});
 		});

 		function mascaraTarjeta(CampoMask, CampoHidd, bolDes) {
 			var iniAnt, mskCar;
 			var tempBull = "1999";
 			var objCMask = document.getElementById(CampoMask);
 			var objCHidd = document.getElementById(CampoHidd);
 			var tempValIni = "";
 			var tempValFin = "";
 			var LognMask = objCMask.value.length;
 			var CaulBol = bolDes ? LognMask : (LognMask - 1);
 			var tamMask = objCMask.getAttribute("maxlength") > 4 ? ((objCMask.getAttribute("maxlength")) - 4) : 2000000;
 			for (x = 0; x < LognMask; x++) {
 				mskCar = objCMask.value.charAt(x);
 				iniAnt = objCHidd.value.charAt(x);
 				if (mskCar != unescape('%2A')) {
 					tempValIni += mskCar;
 					if (x < tamMask && x != CaulBol) {
 						tempValFin += unescape('%2A');
 					} else {
 						tempValFin += mskCar;
 					}
 				} else {
 					tempValIni += iniAnt;
 					if (iniAnt != "") {
 						if (x < tamMask) {
 							tempValFin += unescape('%2A');
 						} else {
 							tempValFin += iniAnt;
 						}
 					}
 				}
 			}
 			objCHidd.value = tempValIni;
 			objCMask.value = "";
 			objCMask.value = tempValFin;
 		}
 	</script>
 </body>

 </html>