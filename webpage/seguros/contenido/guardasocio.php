<!doctype html>
<html>
<head>
<meta charset="utf-8">
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
	$tipo_person=$_POST['repre_legal'];
	$rfc=$_POST['rfc'];
	$direccion=$_POST['direccion'];
	$telefono=$_POST['telefono'];
	$email=$_POST['email'];
	$id=$_POST['ide'];
	$consulta=mysql_query("select *from socio where id_socio=$id");
	if(!mysql_fetch_array($consulta)){
	$consulta=mysql_query("insert into socio(rfc,nombre,tipo_person,ap,am,direccion,telefono,email) values('$rfc','$nombre','$tipo_person','$ap','$am','$direccion','$telefono','$email')",$con)or die(
	header("location:agregarsocio.php?rfc=$rfc&nombre=$nombre&ap=$ap&am=$am&direccion=$direccion&telefono=$telefono&email=$email&error=".mysql_error())
	);
	echo "<script>alert('Se ha Guardado Correctamente');location.href='versocios.php' </script>";
	}
	else{
		mysql_query("update socio set rfc='$rfc',nombre='$nombre',tipo_person='$tipo_person',ap='$ap',am='$am',direccion='$direccion',telefono='$telefono',email='$email' where id_socio=$id")or die(
	header("location:agregarsocio.php?error=".mysql_error())
	);
	echo "<script>alert('Se ha Actualizado Correctamente');location.href='agregarsocio.php' </script>";
	}
}?>
</body>
</html>