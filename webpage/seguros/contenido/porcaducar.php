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
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){
include("conexion.php");
$con=conex();
if(isset($_GET['correos'])){
	$emails=explode(",",$_GET['correos']);
	if(count($emails)>0){
	for($i=0;$i<(count($emails)-1);$i++){
		aviso($emails[$i],$con);
	}
	}
}
$consulta=mysql_query("select poliza.id_poliza,unidad.unidad,poliza.cobertura,poliza.forma_pago,date_format(poliza.fecha_vigencia,'%d/%b/%Y'),poliza.deducible,poliza.foto,socio.nombre,socio.ap,socio.am from poliza inner join unidad on unidad.id=poliza.unidad inner join socio on socio.id_socio=unidad.id_socio where datediff(fecha_vigencia,'".date("Y/m/d")."')<=15 ",$con);
 ?>
<div id="listado">
<table width="100%" class="aplicar">
<tr>
    <th>No. Poliza</th>
    <th>Uni.</th>
    <th>Propietario</th>
    <th>Cobertura</th>
    <th>F. de Pago</th>
    <th>Vigencia</th>
	<th>Dedu.</th>
    <th>Imagen</th>
</tr>
<?php 
$todo="";
while($dato=mysql_fetch_array($consulta)){?>
<tr class="normal">
	<?php $todo.=$dato[0]."," ?>
    <td><?php echo $dato[0] ?></td>
    <td><?php echo $dato[1] ?></td>
    <td><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am'] ?></td>
    <td><?php echo $dato[2] ?></td>
    <td><?php echo verpago($dato[3]) ?></td>
    <td><?php echo $dato[4] ?></td>
    <td><?php echo $dato[5]." %" ?></td>
    <td><a href="polizas/<?php echo $dato[6] ?>" target="_new">Ver..</a></td>
</tr>
<?php } ?>


<tr>
	<td colspan="8"><input name="enviar" type="button" value="Enviar Emails de Aviso" onclick="accion()" class="boton" /></td>
</tr>
</table>
<?php }?>
<script language="javascript">
	function accion(){
		location.href="porcaducar.php?correos="+"<?php echo $todo ?>";	
	}
</script>
</body>
<?php
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
function aviso($id,$con){
	$consulta=mysql_query("select socio.email,poliza.id_poliza,unidad.unidad,date_format(poliza.fecha_vigencia,'%d/%b/%Y')as f1,unidad.marca,unidad.modelo,unidad.placas_estatales,unidad.placas_federales,unidad.no_motor,unidad.no_serie,unidad.uso from poliza inner join unidad on unidad.id=poliza.unidad inner join socio on socio.id_socio=unidad.id_socio where poliza.id_poliza='$id'",$con);
	if($dato=mysql_fetch_array($consulta)){
		echo "Email Enviado a ".$dato['email']."</br>";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente
$headers .= "From: Soc. Cop Aviso de Vencimiento de Poliza <soccoop_sistemabea@hotmail.com>\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente
$headers .= "Reply-To: soccoop_sistemabea@hotmail.com\r\n"; 
$texto='
<html>
<head>
<style>
	caption{font-family:"Courier New", Courier, monospace;
				font-variant:small-caps;
				font-weight:bold;
				font-size:25px;
				background-color:yellow;
	}
	th{text-align:left;border:1px solid black; background-color:#09C;color:white;}
	td{border:1px solid black;padding-left:10px;padding-right:10px;}
	table{padding:10px;font-size:16px;}
</style>
</head>
<body>
<p>
	Sociedad cooperativa de autotransporte de coatzacoalcos le informa del vencimiento de poliza.
</p>
<table>
	<caption>Su poliza Esta por Vencer</caption>
	<tr>
		<th>No. Poliza:</th><td>'.$dato["id_poliza"].'</td>
	</tr>
	<tr>
		<th nowrap="nowrap">Fecha de Vencimiento:</th><td bgcolor="red">'.$dato["f1"].'</td>
	</tr>
	<tr>
		<th>Unidad:</th><td>'.$dato["unidad"].'</td>
	</tr>
		<tr>
		<th>Marca:</th><td>'.$dato["marca"].'</td>
	</tr>
		<tr>
		<th>Modelo:</th><td>'.$dato["modelo"].'</td>
	</tr>
		<tr>
		<th>Placas Estatales:</th><td>'.$dato["placas_estatales"].'</td>
	</tr>
		<tr>
		<th>Placas Federales:</th><td>'.$dato["placas_federales"].'</td>
	</tr>
		<tr>
		<th>No. Motor:</th><td>'.$dato["no_motor"].'</td><th>No. Serie:</th><td>'.$dato['no_serie'].'</td>
	</tr>
		<tr>
		<th>Uso:</th><td>'.$dato["uso"].'</td>
	</tr>
	
</table>
<p>
SOCIEDAD COOPERATIVA DE AUTOTRANSPORTE DEL MPIO CD Y PTO DE COATZACOALCOS, VER, S.C.L.<br />
AV. PRINCIPAL No. 100 COL. TRANSPORTISTAS   TEL. 921 21 83162
</p>
</body>
</html>'
;
mail($dato['email'],"Aviso de Vencimiento de Poliza",$texto,$headers);	
	}
}
?>
</html>