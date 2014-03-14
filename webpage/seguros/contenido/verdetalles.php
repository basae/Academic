<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="general.css" />
</head>

<body>
<?php
session_start();
if((isset($_SESSION['user']))&&($_SESSION['user']=="user") ){
	$poliza="";
	$cobertura="";
	$forma_pago="";
	$fecha_inicio="";
	$fecha_vigencia="";
	$deducible=""; 
if(isset($_GET['id'])){
	include("conexion.php");
	$con=conex();
	$consulta=mysql_query("select poliza.id_poliza,poliza.cobertura,poliza.forma_pago,date_format(poliza.fecha_inicio,'%d/%m/%Y')as f1,date_format(poliza.fecha_vigencia,'%d/%m/%Y')as f2,poliza.deducible,poliza.foto,poliza.endoso,poliza.compania,poliza.observaciones,unidad.*,socio.nombre,socio.ap,socio.am,socio.direccion,socio.telefono,socio.email,socio.rfc from poliza inner join unidad on unidad.id=poliza.unidad inner join socio on unidad.id_socio=socio.id_socio where poliza.id_poliza='".$_GET['id']."'",$con)or die(mysql_error());
	if($dato=mysql_fetch_array($consulta)){
		//campos de poliza
		$poliza=$dato['id_poliza'];
		$cobertura=$dato['cobertura'];
		$forma_pago=verpago($dato['forma_pago']);
		$fecha_inicio=$dato['f1'];
		$fecha_vigencia=$dato['f2'];
		$deducible=$dato['deducible'];
		$foto=$dato['foto'];
		$endoso=$dato['endoso'];
		$compania=$dato['compania'];
		$observaciones=$dato['observaciones'];
		
		//campos para unidad
		$unidad=$dato['unidad'];
		$marca=$dato['marca'];
		$modelo=$dato['modelo'];
		$placas_es=$dato['placas_estatales'];
		$placas_fe=$dato['placas_federales'];
		$no_motor=$dato['no_motor'];
		$no_serie=$dato['no_serie'];
		$uso=$dato['uso'];
		$descripcion=$dato['descripcion'];
		$origen=$dato['origen'];
		$color=$dato['color'];
		$puertas=$dato['no_puertas'];
		$ocupantes=$dato['no_ocupantes'];
		$reg_federal=$dato['registro_federal'];
		$reg_publico=$dato['registro_publico'];
		$servicio=$dato['servicio'];
		//campos de tabla socio
		$propietario=$dato['nombre']." ".$dato['ap']." ".$dato['am'];
		$direccion=$dato['direccion'];
		$telefono=$dato['telefono'];
		$email=$dato['email'];
		$rfc=$dato['rfc'];
	}
}
?>

<div id="listadox" style="text-align:center">
<table class="aplicar" style="text-align:left;">
<caption align="left">Datos de Poliza</caption>
<tr>
	<th width="23%" nowrap="nowrap">No. de Poliza</th><td><?php echo $poliza ?></td>
    <td rowspan="7" width="38%"><a href="polizas/<?php echo $foto ?>" target="_NEW"><img src="polizas/<?php echo $foto ?>" width="100%" align="left" /></a></td>
</tr>
<tr>
	<th nowrap="nowrap">Endoso:</th><td><?php echo $endoso ?></td>
<tr>
<tr>
	<th nowrap="nowrap">Compañia:</th><td><?php echo $compania ?></td>
</tr>
<tr>
	<th nowrap="nowrap">Cobertura:</th><td><?php echo $cobertura ?></td>
</tr>
<tr>
	<th nowrap="nowrap">Forma de Pago:</th><td><?php echo $forma_pago ?></td>
</tr>
<tr>
	<th nowrap="nowrap">Fecha de Inicio:</th><td><?php echo $fecha_inicio ?></td>
</tr>
<tr>
	<th nowrap="nowrap">Fecha de Vigencia:</th><td><?php echo $fecha_vigencia ?></td>
    <td rowspan="2">
    <label>Observaciones:</label>
    <?php echo $observaciones ?>
    </td>
</tr>
<tr>
	<th nowrap="nowrap">Deducible:</th><td><?php echo $deducible."%" ?></td>
</tr>
</table>

<table style="float:left; text-align:left;" class="aplicar">
	<caption>Datos de la Unidad</caption>
    <tr>
    	<th nowrap="nowrap" width="25%">Unidad:</th><td nowrap="nowrap"><?php echo $unidad ?></td>
    	<th>Origen:</th>
        <td><?php echo $origen ?></td>
    </tr>
    <tr>
    	<th>No. Registro Federal de Vehículos:</th>
        <td><?php echo $reg_federal ?></td>
    	<th>Registro Público Vehicular:</th>
        <td><?php echo $reg_publico ?></td>
    </tr>
    	<th nowrap="nowrap">Marca:</th><td nowrap="nowrap"><?php echo $marca ?></td>
    	<th nowrap="nowrap">Modelo:</th><td nowrap="nowrap"><?php echo $modelo ?></td>
    </tr>
    <tr>
    	<th nowrap="nowrap">Placas Estatales:</th><td nowrap="nowrap"><?php echo $placas_es ?></td>

    	<th nowrap="nowrap">Placas Federales:</th><td nowrap="nowrap"><?php echo $placas_fe ?></td></tr>
<tr>
    	<th nowrap="nowrap">No. Motor:</th><td nowrap="nowrap"><?php echo $no_motor ?></td>

    	<th nowrap="nowrap">No. Serie:</th><td nowrap="nowrap"><?php echo $no_serie ?></td>
    </tr>
    <tr>
    	<th nowrap="nowrap">Uso:</th><td nowrap="nowrap"><?php echo $uso ?></td>
        <th>Servicio</th>
        <td><?php echo $servicio ?></td>
    </tr>
    <tr>
    	<th>Descripción</th>
        <td><?php echo $descripcion ?></td>

    	<th>Color:</th>
        <td><?php echo $color ?></td></tr>
        <tr>
        <th>No. de Puertas:</th>
        <td><?php echo $puertas ?></td>
 
    	<th>No. de Ocupantes:</th>
        <td><?php echo $ocupantes ?></td>
    </tr>
</table>
<table  class="aplicar" style="text-align:left;">
	<caption align="left">Datos del Propietario.</caption>
	<tr><th nowrap="nowrap">RFC:</th><td><?php echo $rfc ?></td></tr>
    <tr><th nowrap="nowrap">Propietario:</th><td><?php echo $propietario ?></td></tr>
    <tr><th nowrap="nowrap">Dirección:</th><td><?php echo $direccion ?></td></tr>
    <tr><th nowrap="nowrap">Telefono:</th><td><?php echo $telefono ?></td></tr>
    <tr><th nowrap="nowrap">Email:</th><td><?php echo $email ?></td></tr>
</table>
</div>
</body>
<?php
}
function verpago($val){
	switch($val){
		case "12-m":return "ANUAL";
		case "6-m":return "SEMESTRAL";
		case "3-m":return "TRIMESTRAL";
		case "1-m":return "MENSUAL";	
		case "15-d":return "QUINCENAL";
		case "14-d":return "CATORCENAL";
	}
}
?>
</html>