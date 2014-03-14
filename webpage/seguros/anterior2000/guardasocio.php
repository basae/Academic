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
	include("conexion.php");
	$con=conex();
	$nombre=$_POST['nombre'];
	$ap=$_POST['ap'];
	$am=$_POST['am'];
	$direccion=$_POST['direccion'];
	$telefono=$_POST['telefono'];
	$email=$_POST['email'];
	$id=$_POST['ide'];
	$consulta=mysql_query("select *from socio where id_socio=$id");
	if(!mysql_fetch_array($consulta)){
	$consulta=mysql_query("insert into socio(nombre,ap,am,direccion,telefono,email) values('$nombre','$ap','$am','$direccion','$telefono','$email')",$con)or die(
	header("location:agregasocio.php?nombre=$nombre&ap=$ap&am=$am&direccion=$direccion&telefono=$telefono&email=$email&error=".mysql_error())
	);
	echo "<script>alert('Se ha Guardado Correctamente');location.href='agregasocio.php' </script>";
	}
	else{
		mysql_query("update socio set nombre='$nombre',ap='$ap',am='$am',direccion='$direccion',telefono='$telefono',email='$email' where id_socio=$id")or die(
	header("location:agregasocio.php?error=".mysql_error())
	);
	echo "<script>alert('Se ha Actualizado Correctamente');location.href='agregasocio.php' </script>";
	}
}?>
</body>
</html>