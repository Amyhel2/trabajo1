<?php
error_reporting(0);
ob_start();
include_once('controlador/conexion.php');
include_once('controlador/utils.php');
$conexion = Conectar();
$idfact = $_REQUEST['idf'];

$c00 = "select * from siat_factura where id = '" . $idfact . "' ";
$q00 = mysqli_query($conexion, $c00);
$d00 = mysqli_fetch_array($q00);
$entero = explode(".", $d00["montoTotalSujetoIva"]);
if ($entero[0] == 0) {
	$zero = "cero";
}


$c01 = "SELECT * FROM siat_punto_de_venta WHERE id = '" . $d00["idPuntoVenta"] . "'";
$q01 = mysqli_query($conexion, $c01);
$d01 = mysqli_fetch_array($q01);

$date = date_create($d00["fecha"]);
$fecha1 = date_format($date, 'd/m/Y');

$c02 = "SELECT * FROM siat_sucursal WHERE nroSucursal = '" . $d01["nroSucursal"] . "'";
$q02 = mysqli_query($conexion, $c02);
$d02 = mysqli_fetch_array($q02);

if ($d00["tipoEmision"] == '1') {
	$leyenda = '“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido en una modalidad de facturación en línea”';
} else {
	$leyenda = '“Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido fuera de línea, verifique su envío con su proveedor o en la página web www.impuestos.gob.bo”.';
}
Desconectar($conexion);
?>
<html>

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</head>

<body onload="imprimir();" style="margin:30px; ">
	<table>
		<tbody>
			<tr>
				<td style="line-height: 10px; width:400px;">
					<table>
						<tr>
							<td style="font-size:12px; text-align: center; font-family: Calibri;"><b><?php echo $d00["razonSocialEmisor"]; ?></b></td>
						</tr>
						<tr>
							<td style="font-size:12px; text-align: center; font-family: Calibri;"><?php echo $d02["nombreSucursal"]; ?></td>
						</tr>
						<tr>
							<td style="font-size:12px; text-align: center; font-family: Calibri;">No. Punto de Venta : <?php echo $d01["nroPuntoVenta"]; ?></td>
						</tr>
						<tr>
							<td style="font-size:12px; text-align: center; font-family: Calibri;"><?php echo $d02["direccionSucursal"]; ?></td>
						</tr>
						<tr>
							<td style="font-size:12px; text-align: center; font-family: Calibri;">Telf :<?php echo $d02["telefonoSucursal"]; ?></td>
				</td>
			</tr>
			<tr>
				<td style="font-size:12px; text-align: center; font-family: Calibri;"><?php echo $d02["ciudadSucursal"]; ?></td>
			</tr>
	</table>
	</td>
	<td style="line-height: 10px; width:1050px;">
		<center>
			<p style="font-size:28px; font-family: Calibri;"><b>FACTURA</b> </p>
			<p style="font-size:12px; font-family: Calibri;">(CON DERECHO A CREDITO FISCAL)</p>
		</center>
	</td>
	<td style="line-height: 10px; width:500px;">
		<table style="font-size:12px; font-family: Calibri;">
			<tr>
				<td><b>NIT : </b></td>
				<td> <?php echo $d00["nitEmisor"]; ?></td>
			</tr>
			<tr>
				<td><b>FACTURA N° : </b></td>
				<td> <?php echo $d00["numeroFactura"]; ?></td>
			</tr>
			<tr>
				<td><b>COD. AUTORIZACION : </b></td>
				<td> <?php echo substr($d00["cuf"], 0, 20); ?> <br> <?php echo substr($d00["cuf"], 20, 20); ?> <br> <?php echo substr($d00["cuf"], 40, 20); ?></td>
			</tr>
		</table>
	</td>
	</tr>
	<tr>
		<table style="margin-top: 30px; font-size:12px; font-family: Calibri;">
			<tr>
				<td style="width:150px;"><b> Lugar y fecha : </b></td>
				<td style="width:350px;"> <?php echo "" . $fecha1 . " / " . $d00["hora"] . ""; ?></td>
				<td style="width:150px;"><b> NIT/CI/CEX : </b></td>
				<td style="width:250px;"> <?php echo $d00["numeroDocumento"] . " " . $d00["complemento"]; ?> </td>
			</tr>
			<tr>
				<td style="width:150px;"><b> Nombre/Razón Social : </b></td>
				<td style="width:350px;"> <?php echo $d00["nombreRazonSocial"]; ?></td>
				<td style="width:150px;"><b> Codigo Cliente : </b></td>
				<td style="width:250px;"><?php echo $d00["codigoCliente"]; ?></td>
			</tr>
		</table>
	</tr>
	<tr>
		<table style="border: 1px solid #dddddd; margin-top: 30px; font-size:12px; font-family: Calibri; min-width: 450px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">

			<thead>
				<tr style="background-color: #980081; color: #ffffff; text-align: middle;">
					<th style="padding: 12px 15px;">CODIGO SERVICIO</th>
					<th style="padding: 12px 15px;">CANTIDAD</th>
					<th style="padding: 12px 15px;">UNIDAD DE MEDIDA</th>
					<th style="padding: 12px 15px;">DESCRIPCION</th>
					<th style="padding: 12px 15px;">PRECIO UNITARIO</th>
					<th style="padding: 12px 15px;">DESCUENTO</th>
					<th style="padding: 12px 15px;">SUBTOTAL</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$conexion = Conectar();
				$c03 = "select * from siat_factura_item where idFactura ='" . $idfact . "' ";
				$q03 = mysqli_query($conexion, $c03);
				while ($d03 = mysqli_fetch_array($q03)) {
					echo "
										<tr style='border: 1px solid #dddddd;'><td style='padding: 12px 15px;'>" . $d03["codigoProducto"] . "</td><td style='padding: 12px 15px; text-align: right;'>" . $d03["cantidad"] . "</td><td style='padding: 12px 15px;'>" . $d03["unidadMedida"] . "</td><td style='padding: 12px 15px;'><p><b> " . $d03["codigoProductoSin"] . " | " . $d03["descripcion"] . " </b> </td><td style='padding: 12px 15px; text-align: right;'>" . $d03["precioUnitario"] . "</td><td style='padding: 12px 15px; text-align: right;'>" . $d03["montoDescuento"] . "</td><td style='padding: 12px 15px; text-align: right;'>" . $d03["subTotal"] . "</td></tr>
									";
				}
				Desconectar($conexion);
				?>
				<tr>
					<td colspan="6" style='padding: 1px 15px;'><b style="float:right;">SUBTOTAL Bs : </b></td>
					<td style='padding: 1px 15px;'><span style="float:right;"><?php echo number_format($d00["montoTotalSujetoIva"] + $d00["descuentoAdicional"] + $d00["montoGiftCard"], 2); ?></span></td>
				</tr>
				<tr>
					<td colspan="6" style='padding: 1px 15px;'><b style="float:right;">DESCUENTO Bs :</b></td>
					<td style='padding: 1px 15px;'><span style="float:right;"><?php echo $d00["descuentoAdicional"]; ?></span></td>
				</tr>
				<tr>
					<td colspan="6" style='padding: 1px 15px;'><b style="float:right;">TOTAL Bs : </b></td>
					<td style='padding: 1px 15px;'><span style="float:right;"><?php echo number_format($d00["montoTotalSujetoIva"] + $d00["montoGiftCard"], 2); ?></span></td>
				</tr>
				<tr>
					<td colspan="6" style='padding: 1px 15px;'><b style="float:right;">MONTO GIFT CARD Bs : </b></td>
					<td style='padding: 1px 15px;'><span style="float:right;"> <?php echo $d00["montoGiftCard"]; ?> </span></td>
				</tr>
				<tr>
					<td colspan="6" style='padding: 1px 15px;'><b style="float:right;">MONTO A PAGAR Bs : </b></td>
					<td style='padding: 1px 15px;'><span style="float:right;"><?php echo $d00["montoTotalSujetoIva"]; ?></span></td>
				</tr>
				<tr>
					<td colspan="6" style='padding: 1px 15px;'><b style="float:right;">IMPORTE BASE CREDITO FISCAL Bs : </b></td>
					<td style='padding: 1px 15px;'><span style="float:right;"><?php echo $d00["montoTotalSujetoIva"]; ?></span></td>
				</tr>
			</tbody>
		</table>
		<br>
		<p style="font-size:18px;"><b>Son:</b> <?php echo $zero; ?> <?php echo " " . convertir_a_letras($d00["montoTotalSujetoIva"], '') . " Bolivianos. "; ?></p>
	</tr>
	<tr>
		<table>
			<tr>
				<td style="width:1000px;">
					<p style="font-size:12px;">ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS,EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE ACUERDO A LEY</p>
					<p style="font-size:12px; font-family: Calibri;"><b><?php echo $d00["leyenda"]; ?></b></p>
					<p style="font-size:12px; font-family: Calibri;"><b><?php echo $leyenda; ?> </b></p>
				</td>
				<td style=" text-align: right; width:250px;">
					<img src='http://<?php echo $_SERVER["HTTP_HOST"]; ?>/api/Siat/temp/factura-<?php echo $d00["cuf"]; ?>.png' width='180' height='180' alt=''>
				</td>
			</tr>
		</table>
	</tr>
	</tbody>
	</table>
</body>

</html>
<script language="javascript">
	function imprimir() {
		if ((navigator.appName == "Netscape")) {
			window.print();
		} else {
			var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
			document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
			WebBrowser1.ExecWB(6, -1);
			WebBrowser1.outerHTML = "";
		}
	}
</script>