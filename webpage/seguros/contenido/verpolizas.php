<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<link rel="stylesheet" type="text/css" href="general.css" />

<?php
session_start();
include("conexion.php");
$con=conex();
if(isset($_GET['busqueda'])){
	$sentencia=stripcslashes($_GET['busqueda']);
}
else{$sentencia="";}
if(isset($_GET['var'])){$vari=$_GET['var'];}else{$vari="";}
if(isset($_GET['sele'])){$sele=$_GET['sele'];}else{$sele="";}
if(isset($_GET['id'])){
$val=$_GET['id'];
$consulta=mysql_query("select id_poliza,unidad,forma_pago,cobertura,date_format(fecha_inicio,'%d/%m/%Y')as f1,date_format(poliza.fecha_vigencia,'%d/%m/%Y') as f2,deducible,foto,endoso,compania,observaciones from poliza where id_poliza='".$val."'",$con)or die(mysql_error());
if($dato=mysql_fetch_array($consulta)){
$poliza=$dato['id_poliza'];
$unidad=$dato['unidad'];
$pago=$dato['forma_pago'];
$cobertura=$dato['cobertura'];
$fecha_inicio=$dato['f1'];
$vigencia=$dato['f2'];
$deducible=$dato['deducible'];
$nombre=$dato['foto'];
$endoso=$dato['endoso'];
$compania=$dato['compania'];
$observaciones=$dato['observaciones'];
$retorno="crearpoliza.php?poliza=$poliza&unidad=$unidad&pago=$pago&cobertura=$cobertura&inicio=$fecha_inicio&vigencia=$vigencia&deducible=$deducible&archivo=$nombre&endoso=$endoso&compania=$compania&observaciones=$observaciones";	
echo "<script>location.href='".$retorno."';</script>";
}
}
?>
<script language="javascript">
	var sentencia="";
</script>
</head>

<body>
<div align="center">

Busqueda:
    <input name="cadena" type="text" id="cadena"  value="<?php echo $vari ?>"/>
    <select name="variable" id="variable">
    	<option value="1">x Unidad</option>
        <option value="2">x No de Poliza</option>
        <option value="3">x Propietario</option>
    </select>
    <input name="buscar1" type="button" value="Buscar" onclick="redir()" class="boton" />
    <br /><br />
    </div>
<table class="aplicar">
<caption>Polizas Registradas</caption>
<?php

if(isset($_GET['eliminar'])){
	$consulta=mysql_query("select foto from poliza where id_poliza='".$_GET['eliminar']."'",$con);
	if($dato=mysql_fetch_array($consulta)){
	unlink("polizas/".$dato[0])or die(mysql_error());
	}
	mysql_query("delete from poliza where id_poliza='".$_GET['eliminar']."'");
	echo "<script>alert('El registro ha sido Eliminado');location.href='verpolizas.php';</script>";	
}
$consulta=mysql_query("select poliza.id_poliza,unidad.unidad,poliza.cobertura,poliza.forma_pago,date_format(poliza.fecha_vigencia,'%d/%m/%Y') as f1,poliza.deducible,poliza.foto,socio.nombre,socio.ap,socio.am from poliza inner join unidad on unidad.id=poliza.unidad inner join socio on socio.id_socio=unidad.id_socio ".$sentencia." order by fecha_vigencia",$con)or die(mysql_error());

if((isset($_SESSION['user']))&&($_SESSION['user']=="user") ){ ?>
<tr>
	<th></th>
    <th>No. Poliza</th>
    <th>Uni.</th>
    <th>Propietario</th>
    <th>Vigencia</th>
    <th>Dias Rest.</th>
	<th>Dedu.</th>
    <th>Cobertura</th>
    <th>Img</th>
</tr>
<?php
while($dato=mysql_fetch_array($consulta)){?>
<tr class="normal">
	<td><a href="verdetalles.php?id=<?php echo $dato[0] ?>">Ver Detalles</a></td>
    <td><?php echo $dato[0] ?></td>
    <td><?php echo $dato[1] ?></td>
    <td><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am'] ?></td>
     <?php
$fech=explode("/",$dato["f1"]);
$fecha1=gregoriantojd ($fech[1],$fech[0],$fech[2]); 
$fecha2=gregoriantojd (date("n"), date("j"), date("Y")); 
$resultado_en_dias=$fecha1-$fecha2; 

if(($resultado_en_dias>0)&&($resultado_en_dias>60)){
	echo '<td>'.$dato[4].'</td>';
}
if(($resultado_en_dias>0)&&($resultado_en_dias>30)&&($resultado_en_dias<61)){
	echo '<td id="fase2">'.$dato[4].'</td>';
}
if(($resultado_en_dias>0)&&($resultado_en_dias<31)){
	echo '<td id="fase3">'.$dato[4].'</td>';
}
if($resultado_en_dias<=0){
	echo '<td id="fase4">'.$dato[4].'</td>';
}
	?>
    <td><?php echo $resultado_en_dias ?></td>
    <td><?php echo $dato[5]." %" ?></td>
    <td><?php echo $dato["cobertura"] ?></td>
    <td><a href="polizas/<?php echo $dato[6] ?>" target="_new">Ver..</a></td>
</tr>
<?php }} ?>

<?php
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){ ?>
<tr>
	<th></th>
    <th>No. Poliza</th>
    <th>Uni.</th>
    <th>Propietario</th>
    <th>Vigencia</th>
    <th>Dias Rest.</th>
	<th>Dedu.</th>
    <th>Cobertura</th>
    <th>Img</th>
</tr>
<?php 
while($dato=mysql_fetch_array($consulta)){?>
<tr>
	<td>
    	<a href="verpolizas.php?id=<?php echo $dato[0] ?>">Editar</a>|<a href="verpolizas.php?eliminar=<?php echo $dato[0] ?>" onclick="return confirm('¿Estas Seguro de Eliminar el Registro?');">Eliminar</a>
    </td>
    <td><?php echo $dato[0] ?></td>
    <td><?php echo $dato[1] ?></td>
    <td><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am'] ?></td>
     <?php
$fech=explode("/",$dato["f1"]);
$fecha1=gregoriantojd ($fech[1],$fech[0],$fech[2]); 
$fecha2=gregoriantojd (date("n"), date("j"), date("Y")); 
$resultado_en_dias=$fecha1-$fecha2;

if(($resultado_en_dias>0)&&($resultado_en_dias>60)){
	echo '<td>'.$dato["f1"].'</td>';
}
if(($resultado_en_dias>0)&&($resultado_en_dias>30)&&($resultado_en_dias<61)){
	echo '<td id="fase2">'.$dato["f1"].'</td>';
}
if(($resultado_en_dias>0)&&($resultado_en_dias<31)){
	echo '<td id="fase3">'.$dato["f1"].'</td>';
}
if($resultado_en_dias<=0){
	echo '<td id="fase4">'.$dato["f1"].'</td>';
}
	?>
    <td><?php echo $resultado_en_dias ?></td>
    <td><?php echo $dato[5]." %" ?></td>
    <td><?php echo $dato["cobertura"] ?></td>
    <td><a href="polizas/<?php echo $dato[6] ?>" target="_new">Ver..</a></td>
</tr>
<?php }} ?>
</table>
<script language="javascript">
var sentencia="";
function redir(){
	switch(document.getElementById("variable").value){
	case "1":
	sentencia="where unidad.unidad like '";
	break;
	case "2":
	sentencia="where poliza.id_poliza like '";
	break;
	case "3":
	sentencia="where socio.nombre like '"+document.getElementById("cadena").value+"%' or socio.ap like '"+document.getElementById("cadena").value+"%' or socio.am like '";
	break;
}
	location.href="verpolizas.php?busqueda="+sentencia+document.getElementById("cadena").value+"%'&var="+document.getElementById("cadena").value+"&sele="+document.getElementById("variable").value;
}
cargaCombos("<?php echo $sele ?>","variable");

function cargaCombos(val,campo){
var valor2=val;
if(valor2!=""){
	var maxi=document.getElementById(campo);
	for(var i=0;i<maxi.length;i++){
			if( maxi[i].value==valor2){
				maxi[i].selected=true;	
			}
	}
	}
}
</script>
</body>
<?php
function verpago($val){
	switch($val){
		case 12:return "Anual";
		case 6:return "Semestral";
		case 4:return "Cuatrimestral";
		case 3:return "trimestral";	
	}
}
?>
</html>