<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Se asume que el controlador pasó:
// $factura (array), $items (array de arrays), $zero (string), $leyenda (string)

?><!DOCTYPE html>
<html>
<head>
    <!-- Mantén el <link> a Bootstrap si el otro sistema lo usaba -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <style>
      /* Si tu plantilla original se imprimía sin CSS extra, puedes omitir. 
         Pero si necesitas medidas predefinidas, es posible que en el otro sistema 
         el navegador/impresora estaba configurado para imprimir en ticket. Aquí no forzamos ancho */
      /* Puedes agregar @page si deseas forzar ancho, pero indicas que no lo cambie: 
         si tu sistema anterior imprimía bien con configuración de impresora, 
         no incluyas @page, y deja que el usuario elija el tamaño correcto en diálogo de impresión */
    </style>
</head>
<body onload="imprimir();">
    <center>
        <p style="font-size:20px;"><b>FACTURA<br>CON DERECHO A CRÉDITO FISCAL</b><br></p>
        <p style="font-size:14px;">
            <?= htmlspecialchars($factura["razonSocialEmisor"] ?? '', ENT_QUOTES) ?><br>
            <?= htmlspecialchars($factura["nombreSucursal"] ?? '', ENT_QUOTES) ?><br>
            No. Punto de Venta : <?= htmlspecialchars($factura["nroPuntoVenta"] ?? '', ENT_QUOTES) ?><br>
            <?= htmlspecialchars($factura["direccionSucursal"] ?? '', ENT_QUOTES) ?><br>
            Telf :<?= htmlspecialchars($factura["telefonoSucursal"] ?? '', ENT_QUOTES) ?><br>
            <?= htmlspecialchars($factura["ciudadSucursal"] ?? '', ENT_QUOTES) ?><br>
        </p>
        <p>------------------------------------------------------------------------</p>
        <p style="font-size:14px;"><b>NIT :</b>
            <?= htmlspecialchars($factura["nitEmisor"] ?? '', ENT_QUOTES) ?>:<br>
            <b>FACTURA Nº</b>: <?= htmlspecialchars($factura["numeroFactura"] ?? '', ENT_QUOTES) ?><br>
            <b>CODIGO AUTORIZACION</b><br>
            <?= htmlspecialchars($factura["cuf"] ?? '', ENT_QUOTES) ?><br>
        </p>
        <p>------------------------------------------------------------------------</p>
    </center>
    <div class="row" style="font-size:12px;">
        <div class="col-xs-6"><b style="float:right;">NOMBRE/RAZÓN SOCIAL: </b></div>
        <div class="col-xs-6"><label style="float:left;"><?= htmlspecialchars($factura["nombreRazonSocial"] ?? '', ENT_QUOTES) ?></label></div>
        <div class="col-xs-6"><b style="float:right;">NIT/CI/CEX: </b></div>
        <div class="col-xs-6"><label style="float:left;"><?= htmlspecialchars(($factura["numeroDocumento"] ?? '') . ' ' . ($factura["complemento"] ?? ''), ENT_QUOTES) ?></label></div>
        <div class="col-xs-6"><b style="float:right;">COD.CLIENTE: </b></div>
        <div class="col-xs-6"><label style="float:left;"><?= htmlspecialchars($factura["codigoCliente"] ?? '', ENT_QUOTES) ?></label></div>
        <div class="col-xs-6"><b style="float:right;">FECHA DE EMISION: </b></div>
        <?php 
            $fecha1 = '';
            if (!empty($factura["fecha"])) {
                $dt = DateTime::createFromFormat('Y-m-d', $factura["fecha"]);
                if ($dt) {
                    $fecha1 = $dt->format('d/m/Y');
                }
            }
        ?>
        <div class="col-xs-6"><label style="float:left;"><?= $fecha1 . ' / ' . htmlspecialchars($factura["hora"] ?? '', ENT_QUOTES) ?></label></div>
    </div>
    <center>
        <p><b style="font-size:14px;">DETALLE<br>------------------------------------------------------------------------</p>
    </center>
    <table style="font-size: 11px;">
        <tbody>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $d03): ?>
                    <tr style="width:100%;">
                        <td>
                            <p><b><?= htmlspecialchars($d03["codigoProductoSin"] ?? '', ENT_QUOTES) ?> | <?= htmlspecialchars($d03["descripcion"] ?? '', ENT_QUOTES) ?> </b> <br>
                            <span> Unidad Medida: <?= htmlspecialchars($d03["unidadMedida"] ?? '', ENT_QUOTES) ?> </span><br>
                            <span> <?= htmlspecialchars($d03["cantidad"] ?? '', ENT_QUOTES) ?> x <?= htmlspecialchars($d03["precioUnitario"] ?? '', ENT_QUOTES) ?> - <?= htmlspecialchars($d03["montoDescuento"] ?? '', ENT_QUOTES) ?> </span>
                            <span style="float:right;"><?= htmlspecialchars($d03["subTotal"] ?? '', ENT_QUOTES) ?></span></p>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td>No hay ítems.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <center><p>------------------------------------------------------------------------</p></center>
    <div class="row" style="font-size:14px;">
        <?php
            $montoSujeto = floatval($factura["montoTotalSujetoIva"] ?? 0);
            $descuento   = floatval($factura["descuentoAdicional"] ?? 0);
            $gift        = floatval($factura["montoGiftCard"] ?? 0);
            $subtotal    = $montoSujeto + $descuento + $gift;
            $totalBs     = $montoSujeto + $gift;
        ?>
        <div class="col-xs-8"><b style="float:right;">SUBTOTAL Bs : </b></div>
        <div class="col-xs-4"><span style="float:right;"><?= number_format($subtotal, 2, ',', '.') ?></span></div>
        <div class="col-xs-8"><b style="float:right;">DESCUENTO Bs :</b></div>
        <div class="col-xs-4"><span style="float:right;"><?= number_format($descuento, 2, ',', '.') ?></span></div>
        <div class="col-xs-8"><b style="float:right;">TOTAL Bs : </b></div>
        <div class="col-xs-4"><span style="float:right;"><?= number_format($totalBs, 2, ',', '.') ?></span></div>
        <div class="col-xs-8"><b style="float:right;">MONTO GIFT CARD Bs :  </b></div>
        <div class="col-xs-4"><span style="float:right;"><?= number_format($gift, 2, ',', '.') ?></span></div>
        <div class="col-xs-8"><b style="float:right;">MONTO A PAGAR Bs :  </b></div>
        <div class="col-xs-4"><span style="float:right;"><?= number_format($montoSujeto, 2, ',', '.') ?></span></div>
        <div class="col-xs-8"><b style="float:right;">IMPORTE BASE CF Bs :  </b></div>
        <div class="col-xs-4"><span style="float:right;"><?= number_format($montoSujeto, 2, ',', '.') ?></span></div>
    </div>
    <br>
    <p style="font-size:14px;"><b>Son:</b> <?= htmlspecialchars(convertir_a_letras($montoSujeto, ''), ENT_QUOTES) ?></p>
    <center>
        <p>------------------------------------------------------------------------</p>
        <p style="font-size:14px;">ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS,<br>EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE<br>ACUERDO A LEY</p><br>
        <p style="font-size:14px;"><?= $leyenda ?></p><br>
        <?php if (!empty($factura["cuf"])): ?>
            <img src="<?= base_url("Siat/temp/factura-" . urlencode($factura["cuf"]) . ".png") ?>" width="180" height="180" alt="">
        <?php endif; ?>
        <p>------------------------------------------------------------------------</p>
        <?php 
            // $login lo omitimos si no aplica; si quieres reconstruirlo debes pasar desde controlador
            // por ejemplo $login = 'Su usuario es: ...'; y luego:
            // <p><?= $login ?></p>
        ?>
    </center>
</body>
<script language="javascript">
    function imprimir() {
        if ((navigator.appName == "Netscape")) {
            window.print();
        } else {
            // Este bloque IE antiguo; hoy normalmente basta window.print():
            window.print();
        }
    }
</script>
</html>
