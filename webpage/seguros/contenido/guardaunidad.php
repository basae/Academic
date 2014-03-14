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
$descr=$_POST['descripcion'];
$modelo=$_POST['modelo'];
$placas_es=$_POST['placas_es'];
$placas_fe=$_POST['placas_fe'];
$motor=$_POST['motor'];
$serie=$_POST['serie'];
$socio=$_POST['socio'];
$origen=$_POST['origen'];
$color=$_POST['color'];
$puertas=$_POST['puertas'];
$ocupantes=$_POST['ocupantes'];
$reg_federal=$_POST['reg_federal'];
$reg_publico=$_POST['reg_publico'];
$uso=$_POST['uso'];
$servicio=$_POST['servicio'];
include("conexion.php");
$con=conex();
$consulta=mysql_query("select *from unidad where id=$id",$con);
if(!mysql_fetch_array($consulta)){
mysql_query("insert into unidad values($id,'$unidad','$marca','$modelo','$placas_es','$placas_fe','$motor','$serie',$socio,'$uso','$descr','$origen','$color',$puertas,$ocupantes,'$reg_federal','$reg_publico','$servicio')",$con) or die(header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&descripcion=$descr&origen=$origen&color=$color&puertas=$puertas&ocupantes=$ocupantes&reg_federal=$reg_federal&reg_publico=$reg_publico&servicio=$servicio&error=".mysql_error()));
echo "<script>alert('La unidad ha sido guardada');location.href='verunidades.php';</script>";
}
else{
	mysql_query("update unidad set unidad='$unidad',marca='$marca',modelo='$modelo',placas_estatales='$placas_es',placas_federales='$placas_fe',no_motor='$motor',no_serie='$serie',id_socio=$socio,uso='$uso',descripcion='$descr',origen='$origen',color='$color',no_puertas=$puertas,no_ocupantes=$ocupantes,registro_federal='$reg_federal',registro_publico='$reg_publico',servicio='$servicio' where id=$id")or die(header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&descripcion=$descr&origen=$origen&color=$color&puertas=$puertas&ocupantes=$ocupantes&reg_federal=$reg_federal&reg_publico=$reg_publico&servicio=$servicio&error=".mysql_error()));
echo "<script>alert('La unidad ha sido Actualizada');location.href='verunidades.php';</script>";
}
}
?>
</body>
</html>