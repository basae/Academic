<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
session_start();
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){
$id=$_POST['ide'];
$unidad=$_POST['unidad'];
$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$placas_es=$_POST['placas_es'];
$placas_fe=$_POST['placas_fe'];
$motor=$_POST['motor'];
$serie=$_POST['serie'];
$socio=$_POST['socio'];
$uso=$_POST['uso'];
include("conexion.php");
$con=conex();
$consulta=mysql_query("select *from unidad where id=$id",$con);
if(!mysql_fetch_array($consulta)){
mysql_query("insert into unidad values($id,'$unidad','$marca','$modelo','$placas_es','$placas_fe','$motor','$serie',$socio,'$uso')",$con) or die(header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&error=".mysql_error()));
echo "<script>alert('La unidad ha sido guardada');location.href='agreunidad.php';</script>";
}
else{
	mysql_query("update unidad set unidad='$unidad',marca='$marca',modelo='$modelo',placas_estatales='$placas_es',placas_federales='$placas_fe',no_motor='$motor',no_serie='$serie',id_socio=$socio,uso='$uso' where id=$id")or die(header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas=$placas&tipo=$tipo&error=".mysql_error()));
echo "<script>alert('La unidad ha sido Actualizada');location.href='agreunidad.php';</script>";
}
}
?>
</body>
</html>