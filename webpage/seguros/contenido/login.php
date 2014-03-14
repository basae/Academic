<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>login</title>
</head>
<body>
<?php
$nick=$_POST['usuario'];
$pass=$_POST['pass'];
include("conexion.php");
$con=conex();
session_start();
$consulta=mysql_query("select *from usuario where nick='$nick' and password='$pass'",$con);
if($datos=mysql_fetch_array($consulta)){
	$_SESSION['user']=$datos['tipo'];
	echo "<script>top.location.href='../index.php';</script>";	
}
else{
	echo "<script>alert('El usuario o contraseña son Incorrectos');location.href='login1.html';</script>
	";
}
?>
</body>
</html>